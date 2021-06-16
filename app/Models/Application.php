<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Application extends Model
{
    use HasFactory;
    protected $table = 'applications';
    protected $fillable = [
        'applicant_id',
        'user_id',  
        'loanAmount',
        'loanTerm',
        'frequency',
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
        'category'
    ];


    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creditCards()
    {
        return $this->hasMany(CreditCard::class);
    }

    public function personalLoans()
    {
        return $this->hasMany(PersonalLoan::class);
    }

    public function mortgages()
    {
        return $this->hasMany(Mortgage::class);
    }

    // public function hasApplicant($applicantId)
    // {
    //     /**
    //      * check for applicant details
    //      */
    //     //return in_array($applicantId, $this->applicant->pluck('id')->toArray());
    //    return $applicantId = $this->applicant->id->get();
    // }

    // // public function showApplicationID($applicantId)
    // // {
    // //     return $this->applicant->id;
    // // }

    public function hasUser($userId)
    {
        /**
         * check for referrer user details
         */
        return in_array($userId, $this->user->pluck('id')->toArray());
    }

    public function hasCategory($categoryId)
    {
        /**
         * check for category of application
         */
        return in_array($categoryId, $this->category->pluck('id')->toArray());
    }

    public function hasCreditCard($creditcardId)
    {
        /**
         * check for credit card details
         */
        return in_array($creditcardId, $this->creditCards->pluck('id')->toArray());
    }

    public function hasPersonalLoan($personalLoanId)
    {
        /**
         * check for personal loan details
         */
        return in_array($personalLoanId, $this->personalLoans->pluck('id')->toArray());
    }

    public function hasMortgage($mortgageId)
    {
        /**
         * check for personal loan details
         */
        return in_array($mortgageId, $this->mortgages->pluck('id')->toArray());
    }

    public function scopeSearched($query) {
        
        $search = request()->query('search');

        if (!$search) {
            return $query;
        }

        return $query->where('lastname', 'LIKE', "%($search");
    }

}
