<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class Administrateur extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guard = 'administrateur';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function setPassordAttribute($value)
    {
        $this->attributes['password'] =  password_hash($value, PASSWORD_DEFAULT);
    }
}
