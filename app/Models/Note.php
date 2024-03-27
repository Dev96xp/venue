<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //Asignacion masiva
    protected $guarded = ['id'];

    use HasFactory;

    // Relacion uno a mucho inversa
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    //Relacion POLIMORFICA
    // (ESTO INDICA QUE ESTA ES UNA TABLA POLIMORFICA, LISTO)
    public function noteable()
    {
        return $this->morphTo();
    }
}
