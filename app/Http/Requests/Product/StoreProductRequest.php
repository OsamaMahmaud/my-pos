<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        $rules = [
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'purchase_price'=>'required',
             "sale_price"=>'required',
             "stock"=>'required',
        ];

        foreach(config('translatable.locales') as $locale)
        {
            $rules+=[$locale.'.name' => 'required|unique:products_traslations,name'];

            $rules+=[$locale.'.description'=> 'required'];
        }
        return $rules;

    }
}
