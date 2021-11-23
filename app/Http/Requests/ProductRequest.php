<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Product $product)
    {
        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale.'.name' => 'Required',Rule::unique('name')->ignore($product->id)];
            $rules += [$locale.'.description' => 'Required',Rule::unique('description')->ignore($product->id)];
        }
        $rules += ['category_id' => 'Required'];
        $rules += ['purchase_price' => 'Required'];
        $rules += ['sale_price' => 'Required'];
        $rules += ['stock' => 'Required'];

        return $rules;
    }
}
