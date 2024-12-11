<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'thumb_image' => 'required|image|max:2048', // Path or URL11
            'category_id' => 'required',
            'brand_id' => 'required',
            'short_description' => 'required|max:600',
            'long_description' => 'required',
            'price' => 'required',
            'offer_price' => 'required',
            'offer_start_date' => 'required',
            'offer_end_date' => 'required',
            'sku' => 'required',
            'video_link' => 'required',
            'qty' => 'required',
            'product_type'=> 'required',
            'seo_title' => 'nullable|string|max:200',
            'seo_description' => 'nullable|string|max:255',
            'status' => 'required',
            'sub_category_id' => 'required',
            'child_category_id' => 'required',
        ];
    }
}
