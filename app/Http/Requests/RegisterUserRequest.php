<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;


class RegisterUserRequest extends FormRequest
{

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
            'account.name' => ['required', 'string'],
            'account.email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'account.password' => ['required', 'confirmed', Rules\Password::defaults()],

            "personal.first_name" =>  ['required'],
            "personal.middle_name" =>  [],
            "personal.last_name" =>  ['required'],
            "personal.nationality" =>  ['required', 'exists:nationalities,name'],
            "personal.gender" =>  ['required', 'in:' . implode(',', $genders)],
            "personal.age" =>  ['required'],
            "personal.civil_status" =>  ['required', 'in:' . implode(',', $civil_statuses)],
            "personal.birthday" =>  ['required'],

            'contact.mobile_number' => ['required'],
            'contact.home_number' => ['nullable'],
            'contact.work_number' => ['nullable'],
            'contact.address' => ['required'],
            'contact.region' => ['required'],
            'contact.city' => ['required'],
            'contact.postal_code' => ['nullable'],
            'contact.facebook' => ['nullable'],
            'contact.twitter' => ['nullable'],
            'contact.linkedin' => ['nullable'],
        ];
    }

    public function prepareForValidation(){
        $this->merge([
            'account' => [
                ...$this->account,
                'name' => $this->personal['first_name'] && $this->personal['last_name'] ? $this->personal['first_name'] . " " . $this->personal['last_name'] : '',
            ]
        ]);
    }
}
