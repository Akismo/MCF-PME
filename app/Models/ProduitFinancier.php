<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProduitFinancier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'description',
        'conditions',
        'avantages',
        'date_creation',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date_creation' => 'timestamp',
    ];

    public function getDateCreationAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');  // Formatage de la date en 'd/m/Y'
    }
}

