<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderStoreRequest extends FormRequest
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
             'type'      => ['string' , 'max:200'],
             'title'     => ['string' , 'max:200'],
             'starting_price'   => ['max:200'],
             'btn_url'   => ['url'],
             'serial'    => ['required','integer'],
             'status'    => ['required'],
             'banner'    => ['required', 'image', 'max:2000']
        ];
    }
}
