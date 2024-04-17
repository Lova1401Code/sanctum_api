<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Projet extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = "projets";
    protected $fillable = [
        'etudiant_id',
        'name',
        'duree',
        'description'
    ];
}
