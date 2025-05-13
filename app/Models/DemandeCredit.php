<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DemandeCredit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'membre_id',
        'type_credit',
        'montant',
        'duree',
        'description_projet',
        'date_demande',
        'statut',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'membre_id' => 'integer',
        'montant' => 'decimal:2',
        'date_demande' => 'date',
    ];

    public function membre(): BelongsTo
    {
        return $this->belongsTo(Membre::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(DocumentDemande::class, 'demande_credit_id');
    }

    public function annotations()
    {
        return $this->hasMany(Annotation::class);
    }
}
