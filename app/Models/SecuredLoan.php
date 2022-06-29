<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecuredLoan extends Model
{
    use HasFactory;
    protected $fillable = [
        'financeCompany',
        'balance',
        'repayment',
        'frequency', 
        'asset_value'
    ];

    public function applications() 
    {
        return $this->belongsToMany(Application::class);
    }
}
