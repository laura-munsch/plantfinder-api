<?php

namespace App\Models;

use App\Models\Plante;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nom'];

    public function plantes()
    {
        return $this->belongsToMany(Plante::class);
    }
}
