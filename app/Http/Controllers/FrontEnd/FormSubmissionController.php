<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormSubmittedData;

use Illuminate\Validation\ValidationException;

class FormSubmissionController extends Controller
{
    public function viewForm($id)
    {
        try {
            $formData = Form::with('formfields.formFieldMultipleOptions')->where(['id' => $id, 'is_active' => 1])->first();
            
            if (empty($formData)) {
                return redirect()->route('dashboard');
            } else {
                $formData = $formData->toArray();
            }
            return view('front-end.view_form', compact('formData'));
        } catch (Exception $e) {
            return redirect()->route('dashboard');
        }
    }

    public function submitForm(Request $request, $id)
    {
        try {
            $form = Form::with('formfields')->where('id', $id)->firstOrFail();

            $rules = [];

            foreach ($form->formfields as $field) {

                $rule = $field->is_required ? 'required' : 'nullable';
                
                if ($field->field_type === 'email') $rule .= '|email';
                if ($field->field_type === 'number') $rule .= '|numeric';

                $rules[str_replace(' ', '_', strtolower($field->field_label))] = $rule;
            }
            
            $validated = $request->validate($rules, [
                                '*.required' => 'This field is required',
                                '*.email' => 'Please enter a valid email address',
                                '*.numeric' => 'Please enter a valid number.',
                            ]);


            FormSubmittedData::create([
                'form_id' => $form->id,
                'submitted_data' => json_encode($validated),
            ]);

            return redirect()->back()->with('success', 'Form submitted successfully!');
        }  catch (ValidationException $e) {
            // Return back with validation errors
            return redirect()->back()
                            ->withErrors($e->validator)
                            ->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }
}
