<?php

namespace App\Repositories\Form;

use App\Repositories\BaseRepositoryInterface;
use App\Repositories\BaseRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use DB;
use Auth;

use App\Models\FormField;
use App\Models\Form;
use App\Http\Requests\NewFormRequest;
use App\Models\FormFieldMultipleOption;

use App\Jobs\SendFormCreatedNotification;
use App\Mail\FormCreatedMail;

class FormRepository extends BaseRepository implements BaseRepositoryInterface
{
    protected $forms, $formField, $formFieldMultipleOption;

    public function __construct(Form $form, FormField $formField, FormFieldMultipleOption $formFieldMultipleOption)
    {
        $this->forms = new Form();
        $this->formField = new FormField();
        $this->formFieldMultipleOption = new FormFieldMultipleOption();
    }

    public function createNew($data)
    {

        if ($data instanceof Request) {
            $data = $data->all();
        }

        $inputData = Arr::only($data, $this->forms->getFillable());
        $createForm = $this->forms->create($inputData);

        if(isset($data['field']) && $data['field']) {
            foreach ($data['field'] as $field) {
                $fields = $createForm->formfields()->create([
                        'field_label' => $field['field_label'],
                        'field_name' => $field['field_name'], //strtolower(str_replace(' ', '_' , $field['field_name'])),
                        'field_type' => $field['field_type'],
                        'is_required' => isset($field['is_required']) ? true : false,
                        ]);
                                
                if (in_array($field['field_type'], ['radio', 'checkbox', 'select'])) {
                $optionArray = explode(',',$field['options']);
                foreach($optionArray as $options) {
                    $fields->formFieldMultipleOptions()->create([
                        'options_value' => $options,
                        'options_text'   => $options
                        ]);
                }
                
                }
            }
        }
        if($createForm) {
            
            SendFormCreatedNotification::dispatch([
                'email' => Auth::guard('admin')->user()->email,
                'name' => $createForm->form_name,
                'id' => $createForm->id
            ]);

            return ['status' => true, 'msg' => 'Form created successfully', 'data' => []];
        } else {
            return ['status' => false, 'msg' => 'Something went wrong! Try again later', 'data' => []];
        }
    }

    public function update($id, $request)
    {
        $form = Form::with('formfields.formFieldMultipleOptions')->findOrFail($id);

        $form->update(['form_name' => $request['form_name'], 'is_active' => $request['is_active']]);

        $existingFieldIds = $form->formfields->pluck('id')->toArray();

        $submittedFieldIds = [];
        
        foreach ($request['field'] as $fieldData) {
            $submittedFieldIds[] = $fieldData['field_id'] ?? null;

            // Check if existing field or new
            if (isset($fieldData['field_id'])) {
                $formField = $form->formfields->firstWhere('id', $fieldData['field_id']);
                if ($formField) {
                    $formField->update([
                        'field_label' => $fieldData['field_label'],
                        'field_name' => $fieldData['field_name'],
                        'field_type' => $fieldData['field_type'],
                        'is_required' => isset($fieldData['is_required']) ? 1 : 0,
                    ]);

                    $formField->formFieldMultipleOptions()->delete();

                    if (in_array($fieldData['field_type'], ['radio', 'checkbox', 'select'])) {
                        $optionArray = explode(',',$fieldData['options']);
                        foreach($optionArray as $options) {
                            $formField->formFieldMultipleOptions()->create([
                                'options_value' => $options,
                                'options_text'   => $options
                                ]);
                        }
                        
                    }
                }
            } else {
                $formField = $form->formfields()->create([
                    'field_label' => $fieldData['field_label'],
                    'field_name' => $fieldData['field_name'],
                    'field_type' => $fieldData['field_type'],
                    'is_required' => isset($fieldData['is_required']) ? 1 : 0,
                ]);
            }
            
        }

        // Delete removed fields
        $fieldsToDelete = array_diff($existingFieldIds, array_filter($submittedFieldIds));
        if (!empty($fieldsToDelete)) {
            FormField::whereIn('id', $fieldsToDelete)->delete();
        }

        return ['status' => true, 'msg' => 'Form updated successfully', 'data' => []];
    }

    public function delete($id)
    {
        // 
    }
}