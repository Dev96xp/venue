<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;


    protected $fillable = ['name'];


    // RELACION MUCHOS A MUCHOS
    //App2
    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class);
    }
}
