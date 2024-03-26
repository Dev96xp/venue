<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    const ACTIVE = 1;
    const INACTIVE = 2;
    const PENDING = 3;

    // Campos protejidos por asignacionmasiva
    protected $guarded = ['id', 'created_at', 'update_at'];

    //protected $fillable = ['name','slug'];  //app2



    //RELACION UNO A MUCHOS
    public function products()
    {
        return $this->hasMany(Product::class);
    }



    //RELACION UNO A MUCHOS INVERSA
    // Category - Esta en singular, puesto que solo pertenese a una solo categoria
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    // RELACION ATRAVEZ DE
    public function products2()
    {
        return $this->hasManyThrough(Product::class, Subcategory::class);
    }




    // Relacion MUCHO A MUCHOS

    // La tabla intermdia de esta relacion muchos a muchos, tiene un campo llamado days
    public function features()
    {
        return $this->belongsToMany(Feature::class)->withPivot('days');
    }


    // IMPORTANTE : Indica que use el slug en lugar del id, para mostrarlo en la url
    // url amigable
    public function getRouteKeyName(){
        return 'slug';
    }


    // Relacion *** UNO A MUCHOS POLIMORFICA

    // Una UNA SUBCATEGORIA PUEDE TENER AHORA MUCHAS IMAGENES
    // Tambien para App2
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }



}
