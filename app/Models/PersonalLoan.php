<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalLoan extends Model
{
    use HasFactory;
    protected $fillable = [
        'financeCompany',
        'balance',
        'repayment',
        'frequency', 
        'consolidate',
        'joint'
    ];

    public function applications() 
    {
        return $this->belongsToMany(Application::class);
    }
}
