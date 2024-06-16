<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PersonalInformationRequest extends FormRequest
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

        $civil_statuses = [
            "Single",
            "Married",
            "Divorced",
            "Widowed",
            "Separated",
            "Engaged",
            "In a civil partnership",
            "In a domestic partnership",
            "Annulled",
            "Common-Law"
        ];

        $genders = ['male', 'female', 'non binary'];

        return [
            "first_name" =>  ['required'],
            "middle_name" =>  [],
            "last_name" =>  ['required'],
            "nationality" =>  ['required', 'exists:nationalities,name'],
            "gender" =>  ['required', 'in:' . implode(',', $genders)],
            "age" =>  ['required'],
            "civil_status" =>  ['required', 'in:' . implode(',', $civil_statuses)],
            "birthday" =>  ['required'],
        ];
    }

    protected function prepareForValidation() : void{
        $this->merge([
            'gender' => Str::lower($this->gender),
            'nationality' => Str::ucfirst(Str::lower($this->nationality)),
            'civil_status' => Str::ucfirst(Str::lower($this->civil_status)),
        ]);
    }
}
