<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $table = 'applicants';
    protected $fillable = [
        'apptitle', 
        'firstname', 
        'middlename', 
        'lastname', 
        'status', 
        'phone', 
        'email', 
        'dependants', 
        'streetaddress', 
        'suburb', 
        'state', 
        'postcode', 
        'birth_day', 
        'birth_month', 
        'birth_year', 
        'currentDL', 
        'DLnumber', 
        'DLimage', 
        'MCnumber', 
        'MCimage', 
        'occupation', 
        'employername', 
        'employercontactnumber'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */


    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    // public function showApplicationID($applicant)
    // {
    //     $applicant = Application::find(1)->applicant;
    // }
        
}
