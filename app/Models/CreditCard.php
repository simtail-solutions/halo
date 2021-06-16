<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;
    protected $table = 'credit_cards';
    protected $fillable = [
        'application_id',
        'financeCompany',
        'creditLimit',
        'consolidate'
    ];


    public function applications() 
    {
        return $this->belongsTo(Application::class);
    }
}
