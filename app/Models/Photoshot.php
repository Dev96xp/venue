<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photoshot extends Model
{
    /** @use HasFactory<\Database\Factories\PhotoshotFactory> */
    use HasFactory;

    //Asignacion masiva
    protected $guarded = ['id'];

    // relacion UNO A MUCHOS INVERSA,
    public function photopack()
    {
        return $this->belongsTo(Photopack::class);
    }

}
