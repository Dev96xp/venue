<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sectionx extends Model
{
    use HasFactory;

    //Asignacion masiva
    protected $guarded = ['id'];

    // Relacion UNO A MUCHO INVERSA
    public function page()
    {
        return $this->belongsTo(Page::class);
    }


    // Relacion *** UNO A MUCHOS POLIMORFICA
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
}
