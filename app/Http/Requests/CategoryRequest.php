<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
    public function rules(Category $category)
    {
        $roles = [];
        foreach(config('translatable.locales') as $local){
            $roles += [$local . '.name' => ['Required',Rule::unique('category_translations','name')->ignore($category->id,'category_id')]];
        }
        return $roles;
    }
}
