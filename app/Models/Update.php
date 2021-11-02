<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    use HasFactory;
    protected $table = 'updates';
    protected $fillable = [
        'application_id',
        'category_id',
        'reasonDe',
        'reasonWd',
        'notes'

    ];

    public function applications() 
    {
        return $this->hasMany(Application::class);
    }

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
}
