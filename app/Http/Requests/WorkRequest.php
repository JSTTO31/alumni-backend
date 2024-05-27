<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkRequest extends FormRequest
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
        return [
            'company_name' => ['required'],
            'company_website' => ['nullable'],
            'position_title' => ['required'],
            'position_level' => ['required'],
            'industry' => ['required'],
            'specialization' => ['required'],
            'description' => ['nullable'],
            'current' => ['required', 'boolean'],
            'from' => ['required', 'date'],
            'to' => ['nullable', 'date'],
        ];
    }
}
