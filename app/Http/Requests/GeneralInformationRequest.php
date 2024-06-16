<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralInformationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'department' => ['required', 'exists:departments,id'],
            'school_branch' => ['required', 'exists:school_branches,id'],
            'student_number' => ['required'],
            'graduation_year' => ['required'],
        ];
    }

    public function passedValidation(){
        $this->merge(['department_id' => $this->department, 'branch_id' => $this->school_branch]);
    }

}
