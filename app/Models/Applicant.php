<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Applicant extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'applicants';
    protected $fillable = [
        'apptitle', 
        'firstname', 
        'lastname', 
        'status', 
        'phone', 
        'email', 
        'dependants', 
        'streetaddress', 
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
        'employercontactnumber',
        'payslip1',
        'payslip2'
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

    public function applicantEmail() {       
        return $this->belongsTo(Applicant::class, 'applicant_id');
        //return $this->belongsTo(User::class, 'user_id');
    }

    
    // public function showApplicationID($applicant)
    // {
    //     $applicant = Application::find(1)->applicant;
    // }
        
}
