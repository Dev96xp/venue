<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //Asignacion masiva
    protected $guarded = ['id'];

    use HasFactory;

    // Relacion uno a mucho inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacion *** UNO A MUCHOS POLIMORFICA
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
}
