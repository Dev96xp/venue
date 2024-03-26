<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusCategory extends Model
{
    use HasFactory;

    //relacion UNO A MUCHOS

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
