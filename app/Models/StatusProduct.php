<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusProduct extends Model
{
    use HasFactory;

    //relacion UNO A MUCHOS

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
