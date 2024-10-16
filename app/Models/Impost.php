<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impost extends Model
{
    use HasFactory;

    //Asignacion masiva
    protected $guarded = ['id'];

    // Relacion MUCHOS A MUCHOS
    public function taxes()
    {
        return $this->belongsToMany(Tax::class);
    }
}
