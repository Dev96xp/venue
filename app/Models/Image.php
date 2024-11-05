<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    //Asignacion masiva
    protected $guarded = ['id'];

    use HasFactory;
    const INACTIVE = 1;     // Usados para la proof y galleries tablas
    const ACTIVE = 2;
    const PENDING = 3;

    use HasFactory;

    //Relacion POLIMORFICA
    // (ESTO INDICA QUE ESTA ES UNA TABLA POLIMORFICA, LISTO)
    public function imageable()
    {
        return $this->morphTo();
    }
}
