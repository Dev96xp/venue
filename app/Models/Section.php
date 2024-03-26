<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    //Asignacion masiva
    protected $guarded = ['id'];

    const ACTIVE = 1;
    const INACTIVE = 2;
    const PENDING = 3;

    // Relacion *** UNO A MUCHOS POLIMORFICA

    // Una UNA SUBCATEGORIA PUEDE TENER AHORA MUCHAS IMAGENES
    // Tambien para App2
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    // relacion uno a muchos
    public function parts()
    {
        return $this->hasMany(Part::class);
    }



    // Relacion uno a muchos (inversa)
    public function Invitation()
    {
        $this->belongsTo(Invitation::class);
    }
}
