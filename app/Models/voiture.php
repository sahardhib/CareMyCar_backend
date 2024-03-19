<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voiture extends Model
{
    use HasFactory;
    protected $fillable = [
        'marque',
        'modele',
        'type',
        'matricule',
        'VIN',
        'image',
        'date_de_vignette',
        'date_d_assurance',
         ];


}
