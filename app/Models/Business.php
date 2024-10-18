<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{

    //Asignacion masiva
    protected $guarded = ['id'];

    use HasFactory;
}
