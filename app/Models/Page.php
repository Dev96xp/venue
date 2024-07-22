<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    //Asignacion masiva
    protected $guarded = ['id'];

    // RELACION UNO A MUCHOS

    public function sectionxes()
    {
        return $this->hasMany(Sectionx::class);
    }
}
