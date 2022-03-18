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
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'birth_day' => 'numeric',
            'birth_month',
            'birth_year' => 'numeric',
            'DLnumber' => 'numeric',
            'MCnumber' => 'numeric'
        ];
    }
}


