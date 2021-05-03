<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return transliterator_create_from_rules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'loanAmount' => 'required',
            'loanTerm' => 'required',
            'frequency' => 'required',
            'employment' => 'required',
            'residentialType' => 'required',
            'resTimeY' => 'required',
            'resTimeM' => 'required',
            'otherAddress' => 'required',
            'empTimeY' => 'required',
            'empTimeM' => 'required',
            'prevEmployer' => 'required',
            'prevEmployerTimeY' => 'required',
            'prevEmployerTimeM' => 'required',
            'income' => 'required',
            'incomeFreq' => 'required',
            'partnerIncome' => 'required',
            'partnerIncomeFreq' => 'required',
            'rentMortgageBoard' => 'required',
            'rentFreq' => 'required',
            'rentShared' => 'required',
            'referenceName' => 'required',
            'referencePhone' => 'required',
            'referenceSuburb' => 'required'
        ];
    }
}
