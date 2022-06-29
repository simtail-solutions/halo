<?php

namespace App\Http\Requests\Applicants;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicantRequest extends FormRequest
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
            'apptitle' => 'required',
            'gender' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'status' => 'required',
            'dependants' => 'required',
            'streetaddress' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required',
            'birth_day' => 'numeric',
            'birth_month',
            'birth_year' => 'numeric',
            'currentDL',
            'DLnumber' => 'numeric',
            'MCnumber' => 'numeric|required',
            'DLimage',
            'MCimage',
            'occupation' => 'required',
            'employername' => 'required',
            'employercontactnumber' => 'required',
            'payslip1',
            'payslip2',
            'api_token'            
        ];
    }
}
