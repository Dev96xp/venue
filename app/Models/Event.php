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

    // relacion UNO A UNO
    public function venue()
    {
        return $this->hasOne(Venue::class);
    }

    public function personal()
    {
        return $this->hasOne(Personal::class);
    }

    public function drink()
    {
        return $this->hasOne(Drink::class);
    }

    public function decoration()
    {
        return $this->hasOne(Decoration::class);
    }

    public function cleaning()
    {
        return $this->hasOne(Cleaning::class);
    }

}
