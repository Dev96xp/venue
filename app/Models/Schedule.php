<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    // ************  NO LO VOY A USAR POR AHORA, OPEN

    //Asignacion masiva
    protected $guarded = ['id'];

    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

}

