<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decoration extends Model
{
    //Asignacion masiva
    protected $guarded = ['id'];

    use HasFactory;


    // Relacion uno a uno inversa
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // RELACION UNO A MUCHOS
    public function items_decorations()
    {
        return $this->hasMany(ItemsDecoration::class);
    }

}
