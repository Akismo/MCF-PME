<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Membre extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guard = 'membre';

    protected $fillable = [
        'numAdherent',
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'date_inscription',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date_inscription' => 'timestamp',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function setPassordAttribute($value)
    {
        $this->attributes['password'] =  password_hash($value, PASSWORD_DEFAULT);
    }

    public function demandeCredits(): HasMany
    {
        return $this->hasMany(DemandeCredit::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($membre) {
            $membre->numAdherent = self::generateUniqueNumAdherent();
        });
    }

    private static function generateUniqueNumAdherent()
    {
        do {
            $num = 'ADH-' . strtoupper(Str::random(8)); // Exemple: ADH-XK9D7F3A
        } while (self::where('numAdherent', $num)->exists());

        return $num;
    }
}
