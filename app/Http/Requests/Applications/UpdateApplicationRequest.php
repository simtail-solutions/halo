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
            'employment' => 'required',
            'residentialType' => 'required',
            'resTimeY' => 'required',
            'resTimeM',
            'otherAddress',
            'empTimeY' ,
            'empTimeM',
            'prevOccupation',
            'prevEmployer',
            'prevEmployerTimeY',
            'prevEmployerTimeM',
            'income',
            'incomeFreq',
            'partnerIncome',
            'partnerIncomeFreq',
            'rentMortgageBoard',
            'rentFreq' => 'required',
            'rentShared' => 'required',
            'category_id',
            // 'api_token'
        ];
    }
}
