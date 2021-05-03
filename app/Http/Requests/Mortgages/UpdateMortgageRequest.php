<?php

namespace App\Http\Requests\Mortgages;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMortgageRequest extends FormRequest
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
            'financeCompany' => 'required',
            'balance' => 'required',
            'repayment' => 'required',
            'frequency' => 'required',
            'joint' => 'required',
            'investmentProperty' => 'required'
        ];
    }
}
