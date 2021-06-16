<?php

namespace App\Http\Requests\Applicants;

use Illuminate\Foundation\Http\FormRequest;

class CreateApplicantRequest extends FormRequest
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
            'firstname' => 'required',
            'middlename',
            'lastname' => 'required',
            // 'status' => 'required',
            // 'dependants' => 'required',
            // 'streetaddress' => 'required',
            // 'suburb' => 'required',
            // 'state' => 'required',
            // 'postcode' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required',
            'birth_day' => 'required|numeric',
            'birth_month' => 'required|numeric',
            'birth_year' => 'required|numeric',
            // 'DOB'/* => 'required'*/,
            // 'currentDL'/* => 'required'*/,
            // 'DLnumber'/* => 'numeric'*/,
            'DLimage' => 'image',
            // 'MCnumber' => 'required|numeric',
            'MCimage' => 'image',
            // 'occupation' => 'required',
            // 'employername' => 'required',
            // 'employercontactnumber' => 'required'
        ];
    }
}


