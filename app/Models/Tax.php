<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    //Asignacion masiva
    protected $guarded = ['id'];

    // Relacion MUCHOS A MUCHOS

    public function imposts()
    {
        return $this->belongsToMany(Impost::class);
    }
}
