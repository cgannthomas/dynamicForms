<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Exception;

class NewFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $inputList = $this->all();

        $rules = [
            'form_name' => 'required|string|min:2|max:50|unique:forms,form_name',
        ];
        
        if((bool)$inputList['is_active'] || isset($inputList['field'])) {
            $rules = array_merge($rules, [
                                            'field' => 'required|array|bail',
                                            'field.*.field_label' => 'required|string|min:2|max:50',
                                            'field.*.field_name' => 'required|string',
                                            'field.*.field_type' => 'required|string',
                                        ]
                                );
            if(isset($inputList['field'])) {       
                foreach ($inputList['field'] as $index => $fields) {
                    if (isset($fields['field_type']) && in_array($fields['field_type'], ['radio', 'checkbox', 'select'])) {
                        $rules["field.$index.options"] = 'required|string';
                    }
                }
            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'field.required' => 'At least one field is required for an active form.',
            '*.required'    => 'This field is required'
        ];
    }
}
