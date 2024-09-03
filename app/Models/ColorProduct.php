<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'color_id', 'product_id', 'quantity', 'color_code', 'model'
    ];

    // Para que administre la tabla: color_product
    protected $table = "color_product";

    //Relacion a muchos inversa

    public function color(){
        return $this->belongsTo(Color::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }



}
