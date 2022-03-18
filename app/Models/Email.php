<?php

namespace App\Models;
use App\Models\Applicant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Email extends Applicant
{
    use HasFactory, Notifiable;

    protected $table = 'applicants';
    protected $fillable = [ 
        'firstname', 
        'lastname', 
        'phone', 
        'email'
    ];

    public function applicant() {
        return $this->belongsTo(Applicant::class);
    }
}
