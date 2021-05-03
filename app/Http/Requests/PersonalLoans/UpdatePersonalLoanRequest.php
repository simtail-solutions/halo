<?php

namespace App\Http\Requests\PersonalLoans;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalLoanRequest extends FormRequest
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
            'consolidate' => 'required',
            'joint' => 'required'
        ];
    }
}
