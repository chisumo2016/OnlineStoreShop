<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateRequest extends FormRequest
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
            'type' => 'required|string',
            'title' => 'required|string',
            'starting_price' => 'required|numeric',
            'btn_url' => 'nullable|url',
            'serial' => 'nullable|string',
            'status' => 'required|in:1,0',
            'banner' => 'nullable|image|max:2048', // Optional image upload
        ];
    }
}
