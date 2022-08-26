<?php

namespace App\Models;

use App\Models\Plante;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caracteristique extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nom', 'valeur', 'plante_id'];

    public function plante()
    {
        return $this->belongsTo(Plante::class);
    }
}
