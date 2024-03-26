<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;
    //Asignacion masiva
    protected $guarded = ['id'];

    // Relacion uno a muchos (inversa)
    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function invite()
    {
        $this->belongsTo(Invite::class);
    }




    // Relacion uno a muchos
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
