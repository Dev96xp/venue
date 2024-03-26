<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Asignacion masiva
    protected $guarded = ['id'];

    //protected $fillable = ['name','slug','image','icon'];  //app2

    use HasFactory;
    const ACTIVE = 1;
    const INACTIVE = 2;
    const PENDING = 3;

    //relacion UNO A MUCHOS
    public function courses()
    {
        return $this->hasMany('App\Models\Course');
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    // RELACION UNO A MUCHOS INVERSA
    public function status_category()
    {
        return $this->belongsTo(StatusCategory::class, 'status');
    }

    public function type_category()
    {
        return $this->belongsTo(TypeCategory::class);
    }

    // OJO AQUI ESTOY TRATANDO A UN DEPARTAMENTO COMO CATEGORIA, POR VARIAS RAZAONES
    // a) Una Categoria puede tener muchas subcategorias
    // b) Por tanto existe una relacion uno a mucho
    // c) subcategories - Se pone en (plural) por que son varias subcategorias

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }


    // Relacion MUCHO A MUCHOS
    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function details()
    {
        return $this->belongsToMany(Detail::class);
    }



    // Una relacion ATRAVEZ DE
    public function products()
    {
        return $this->hasManyThrough(Product::class, Subcategory::class);
    }

    // IMPORTANTE : Indica que use el slug en lugar del id, para mostrarlo en la url
    // url amigable
    public function getRouteKeyName()
    {
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
