<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'montant',
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
        'date_demande' => 'timestamp',
    ];

    public function membre(): BelongsTo
    {
        return $this->belongsTo(Membre::class);
    }
}
