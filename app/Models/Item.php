<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    //Asignacion masiva
    protected $guarded = ['id'];

    // relacion UNO A MUCHOS inversa

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction');
    }



    // Relacion *** UNO A MUCHOS POLIMORFICA

    // Una UN PRODUCTO PUEDE TENER AHORA MUCHAS IMAGENES
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
}
