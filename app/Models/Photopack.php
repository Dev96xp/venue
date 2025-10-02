<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photopack extends Model
{
    /** @use HasFactory<\Database\Factories\PhotopackFactory> */
    use HasFactory;

    //Asignacion masiva
    protected $guarded = ['id'];

    // RELACION UNO A MUCHOS
    public function photoshots()
    {
        return $this->hasMany(Photoshot::class);
    }
}
