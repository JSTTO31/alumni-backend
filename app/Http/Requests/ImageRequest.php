<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class ImageRequest extends FormRequest
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
            "title" => ['required'],
            "image" => ['required', File::image()->max(12 * 1024)],
        ];
    }

    public function prepareForValidation() : void{
        $this->merge([
            "title" => $this->title ?? $this->file("title"),
            "image" => $this->image ?? $this->file("image"),
        ]);
    }
}
