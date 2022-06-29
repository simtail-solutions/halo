<?php

namespace App\Http\Requests\CreditCards;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCreditCardRequest extends FormRequest
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
            'creditLimit' => 'required',
            'consolidate' => 'required',
            'amount_owing' => 'required'
        ];
    }
}
