<?php

namespace App\Models;
use App\Models\Application;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Application
{
    use HasFactory;
    protected $table = 'applications';
    protected $fillable = [
        'applicant_id',
        'user_id',  
        'loanAmount',
        'employment',
        'residentialType',
        'resTimeY',
        'resTimeM',
        'otherAddress',
        'empTimeY',
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
        'rentFreq',
        'rentShared',
        'referenceName',
        'referencePhone',
        'referenceSuburb',
        'category_id',
        'api_token'
    ];

    public function getRouteKeyName() 
    {
        return 'api_token';
    }
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function siteAdmin(User $user) {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function updates()
    {
        return $this->hasMany(Update::class);
    }
}
