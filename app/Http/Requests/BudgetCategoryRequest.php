<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetCategoryRequest extends FormRequest
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
            'budget_cat.*' => 'required',
            'budget_cat_description.*' => 'nullable'
        ];
    }

    public function messages(){
        return [
            'budget_cat.*' => 'Category name is required.',
        ];
    }

    /**
     * Transforms validated data into the correct db fields. Conforms to db field names
     * @return array of validated conformed data
     */
    public function conformValidatedData(){
        $validated_data = $this->validated();
        $budget_cat = [];
        $budget_cat['name'] = $validated_data['budget_cat'][0];
        $budget_cat['description'] = $validated_data['budget_cat_description'][0];

        return $budget_cat;
    }
}
