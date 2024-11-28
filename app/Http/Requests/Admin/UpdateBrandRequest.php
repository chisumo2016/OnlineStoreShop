<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
            'logo' => ['nullable', 'image', 'max:2000'], // Optional but valid image
            'name' => ['required', 'string', 'max:200', 'unique:brands,name,' . $this->brand->id],
            'is_featured' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
        ];
    }
}
