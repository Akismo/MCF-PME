<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'auteur_id',
        'administrateur_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date_publication' => 'timestamp',
        'auteur_id' => 'integer',
        'administrateur_id' => 'integer',
    ];

    public function administrateur(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function auteur(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
