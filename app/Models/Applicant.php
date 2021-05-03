<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $table = 'applicants';
    protected $fillable = [
        'apptitle', 'firstname', 'middlename', 'lastname', 'status', 'phone', 'email', 'dependants', 'streetaddress', 'suburb', 'state', 'postcode', 'DOB', 'currentDL', 'DLnumber', 'MCnumber', 'occupation', 'employername', 'employercontactnumber'
    ];


    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    // public function showApplicationID($applicant)
    // {
    //     $applicant = Application::find(1)->applicant;
    // }
        
}
