<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;

class CreateApplicationRequest extends FormRequest
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
            'applicant_id',
            'user_id' => 'required',  
            'loanAmount' => 'required',
            'loanTerm' => 'required',
            'frequency' => 'required',
            'employment' => 'required',
            'residentialType' => 'required',
            'resTimeY' => 'required',
            'resTimeM' => 'required',
            'otherAddress',
            'empTimeY' => 'required',
            'empTimeM' => 'required',
            'prevOccupation',
            'prevEmployer',
            'prevEmployerTimeY',
            'prevEmployerTimeM',
            'income' => 'required',
            'incomeFreq' => 'required',
            'partnerIncome',
            'partnerIncomeFreq',
            'rentMortgageBoard',
            'rentFreq' => 'required',
            'rentShared' => 'required',
            'category_id'
        ];
    }
}
