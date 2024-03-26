<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    //Asignacion masiva
    protected $guarded = ['id'];

    use HasFactory;

    // RELACION MUCHOS A MUCHOS
    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }
}
