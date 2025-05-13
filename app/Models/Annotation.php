<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annotation extends Model
{
    protected $fillable = ['demande_credit_id', 'user_id', 'contenu', 'is_important'];

    public function demandeCredit()
    {
        return $this->belongsTo(DemandeCredit::class);
    }

    public function user()
    {
        return $this->belongsTo(Administrateur::class, 'user_id'); // Ou Administrateur selon votre structure
    }
}
