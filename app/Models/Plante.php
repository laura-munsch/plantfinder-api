<?php

namespace App\Models;

use App\Models\Categorie;
use App\Models\Caracteristique;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plante extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nom', 'description', 'image'];

    public function categories()
    {
        return $this->belongsToMany(Categorie::class);
    }

    public function caracteristiques()
    {
        return $this->hasMany(Caracteristique::class);
    }
}
