<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'product_id'];


    // Relacion MUCHOS A MUCHOS

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class);
    // }


    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}
