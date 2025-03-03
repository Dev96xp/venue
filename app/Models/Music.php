<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
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
    public function items_musics()
    {
        return $this->hasMany(ItemsMusic::class);
    }
}
