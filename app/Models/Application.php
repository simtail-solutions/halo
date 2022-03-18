<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;



class Application extends Model
{
    use HasFactory, SoftDeletes;
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

    public function hasUser($userId)
    {
        /**
         * check for referrer user details
         */
        //$user = User::find(auth()->user()->id);
        //return in_array($userId, $this->user->pluck('id')->toArray());
    }

    public function hasCategory($categoryId)
    {
        /**
         * check for category of application
         */
        //return in_array($categoryId, $this->categories->pluck('id')->toArray());
        
    }

    // public function latestCategory($categoryId)
    // {
    //     /**
    //      * check for category of application
    //      */
    //     return $this->categories->pluck('id')->last();
        
    // }

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

    // 
    // public function scopeSearched($query) {
        
    //     if (!$search) {
    //       return $query;
    //     }

    //     return $query->whereHas('applicant', function ($query) use($search){
    //         $query->where('lastname', 'LIKE', '%' . $search . '%');
    //     })
    //     // ->orWhereHas('applicant', function ($query) use($search){
    //     //     $query->where('phone', 'LIKE', '%'.preg_replace('/\s+/', '', $search).'%')->limit(100);
    //     // }) // this breaks after implementing the updated phone format on the forms
    //     ->orWhereHas('applicant', function ($query) use($search){
    //         $query->where('phone', 'LIKE', '%' . $search . '%');
    //     })
    //     ->orWhereHas('applicant', function ($query) use($search){
    //         $query->where('email', 'LIKE', '%' . $search . '%');
    //     })
    //     ->orWhereHas('user', function ($query) use($search){
    //         $query->where('businessName', 'LIKE', '%' . $search . '%');
    //     })
    //     ->orWhereHas('category', function ($query) use($search){
    //         $query->where('name', 'LIKE', '%' . $search . '%');
    //     })->orderBy('id', 'desc');


    // }

    public function mostRecentCategory(Category $category) 
    {
        $this->update([
            'category_id' => $category->id
        ]);
    }

}
