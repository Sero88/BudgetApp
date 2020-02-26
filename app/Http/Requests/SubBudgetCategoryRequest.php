<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubBudgetCategoryRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required',
            'budget' => 'required|numeric|min:0.01',
            'description' => 'nullable'
        ];
    }

    public function messages(){
        return [
            'name' => 'Subcategory name is required.',
            'budget' => 'A minimum amount of 0.01 is required.',
        ];
    }
}
