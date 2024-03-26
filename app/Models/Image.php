<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //Asignacion masiva
    protected $guarded = ['id'];

    use HasFactory;

    //Relacion POLIMORFICA
    // (ESTO INDICA QUE ESTA ES UNA TABLA POLIMORFICA, LISTO)
    public function imageable()
    {
        return $this->morphTo();
    }
}
