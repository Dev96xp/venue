<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    //Asignacion masiva
    protected $guarded = ['id'];

    // Relacion uno a muchos
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}
