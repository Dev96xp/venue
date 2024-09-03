<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ipx extends Model
{
    //Asignacion masiva
    protected $guarded = ['id'];

    use HasFactory;

    // RELACION UNO A MUCHOS INVERSA

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
