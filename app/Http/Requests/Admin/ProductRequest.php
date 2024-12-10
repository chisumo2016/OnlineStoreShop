<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'thumb_image' => 'required|image|max:2048', // Path or URL
            'category_id' => 'required',
            'brand_id' => 'required',
            'short_description' => 'required|max:600',
            'long_description' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'is_top' => 'required',
            'is_best' => 'required',
            'is_featured' => 'required',
            'seo_title' => 'nullable|string|max:200',
            'seo_description' => 'nullable|string|max:255',
            'status' => 'required',

            //'vendor_id' => 'required|exists:vendors,id',

        ];
    }
}
