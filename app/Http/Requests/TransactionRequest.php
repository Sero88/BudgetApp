<?php

namespace App\Http\Requests;

use App\BudgetCategory;
use App\Transaction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        $budgetCategory = BudgetCategory::find( request('budget_cat_id') );

        if( Auth::user()->id  == $budgetCategory->balance->owner_id ){
            return true;
        }

        return false;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required|numeric|min:0.01|',
            'type_id' => 'required',
            'budget_cat_id' => 'required',
            'description' => 'nullable',
            'payment_type_id' => 'required|numeric',
            'date_made' => 'required|date'
        ];
    }
}
