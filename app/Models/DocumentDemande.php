<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentDemande extends Model
{
    use HasFactory;

    protected $fillable = [
        'demande_credit_id',
        'type_document',
        'chemin_fichier',
        'nom_original'
    ];

    public function demandeCredit()
    {
        return $this->belongsTo(DemandeCredit::class);
    }
}