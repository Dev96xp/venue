<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    //Asignacion masiva
    protected $guarded = ['id'];

    // RELACION UNO A MUCHOS

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function subcategories()
    {
        return $this->hasMany(subcategory::class);
    }

    // RELACION MUCHOS A MUCHOS
    //App2
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
