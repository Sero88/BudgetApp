<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecurringTransactionRequest extends FormRequest
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
            'amount' => 'required|numeric|min:0.01|',
            'transaction_type' => 'required',
            'budget_cat_id' => 'required',
            'sub_budget_category_id' => 'nullable|numeric',
            'description' => 'nullable',
            'day_of_month' => 'required|date',
            'interval_id' => 'required|numeric',
            'payment_type_id' => 'required|numeric'
        ];
    }
}
