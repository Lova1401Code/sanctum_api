<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;
    protected $table = "projets";
    protected $fillable = [
        'etudiant_id',
        'name',
        'duree',
        'description'
    ]
}