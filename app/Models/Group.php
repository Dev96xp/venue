<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //Asignacion masiva
    protected $guarded = ['id'];

    use HasFactory;

    // RELACION UNO A MUCHOS.......OJO   CHECARLO CREO QUE ES SOLO UNO A UNO
    public function products()
    {
        return $this->hasMany(Product::class);
    }


    // relacion *** MUCHOS A MUCHOS
    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }
}
