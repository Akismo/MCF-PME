<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contenu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titre',
        'type',
        'contenu',
        'date_publication',
        'administrateur_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date_publication' => 'date',
        'administrateur_id' => 'integer',
    ];

    public function administrateur(): BelongsTo
    {
        return $this->belongsTo(Administrateur::class);
    }

    public function auteur(): BelongsTo
    {
        return $this->administrateur();
    }

    public function images(): HasMany
    {
        return $this->hasMany(ContenuImage::class);
    }

    public function getImagePrincipaleAttribute()
    {
        return $this->images()->where('is_principal', true)->first();
    }
}
