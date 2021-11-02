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
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'dependants' => 'required',
            'streetaddress' => 'required',
            'suburb' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required',
            'DOB' => 'required',
            'currentDL' => 'required',
            //'DLnumber' => 'required',
            'MCnumber' => 'required',
            'occupation' => 'required',
            'employername' => 'required',
            'employercontactnumber' => 'required',
            'api_token'
        ];
    }
}
