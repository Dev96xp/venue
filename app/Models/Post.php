<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //Asignacion masiva, Para protejer id y el status
    protected $guarded = ['id'];

    // RELACION UNO A MUCHOS INVERSA
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // relacion *** MUCHOS A MUCHOS

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // UNO A MUCHOS POLIMORFICA

    // Una UN POST PUEDE TENER AHORA MUCHAS IMAGENES

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
}
