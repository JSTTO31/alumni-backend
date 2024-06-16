<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PictureRequest extends FormRequest
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
            'styles.scale' => ['required', 'integer'],
            'selected_frame' => ['required', 'integer'],
        ];
    }


    public function prefereForValidation(){
        $this->merge([
            'style' => json_decode($this->file('styles')),
            'selected_frame' => $this->file('selected_frame')
        ]);
    }
}
