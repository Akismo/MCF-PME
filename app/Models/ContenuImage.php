<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContenuImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenu_id',
        'chemin',
        'alt_text',
        'is_principal',
    ];

    protected $casts = [
        'is_principal' => 'boolean',
    ];

    public function contenu()
    {
        return $this->belongsTo(Contenu::class);
    }
}