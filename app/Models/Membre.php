<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Membre extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $guard = 'membre';

    protected $fillable = [
        'numAdherent',
        'name',
        'prenom',
        'email',
        'password',
        'date_inscription',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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

