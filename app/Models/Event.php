<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //Asignacion masiva
    protected $guarded = ['id'];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

        // UNO A MUCHOS POLIMORFICA

    // UN BUSINESS PUEDE TENER AHORA MUCHAS NOTAS
    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

}
