<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'businessName',
        'phone',
        'email',
        'password',
        'activated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin() 
    {
        return $this->role==='admin';
        //return $this->belongsTo(User::where('role', 'admin')->first('id'));
        
    }

    public function siteAdmin()
    {
        return $this->belongsTo(User::find(1)->role->isAdmin());
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function scopeMatched($query)
    {
        $matched = request()->query('matched');

        if(!$matched) {
            return null;
        }

        return $query->Application::where('user_id', 'LIKE', 'id');
    }
}
