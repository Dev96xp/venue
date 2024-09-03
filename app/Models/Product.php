<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    //Asignacion masiva, Para protejer id y el status
    protected $guarded = ['id', 'status', 'created_at', 'update_at'];


    use HasFactory;

    const BORRADOR = 1;
    const REVISION = 2;
    const PUBLICADO = 3;


    // SUPER IMPORTANTE
    // Ayuda a acceder a un registro atravez del slug,
    // y no mostrar el id., url amigable
    public function getRouteKeyName()
    {
        return "slug";
    }

    // relacion UNO A MUCHOS INVERSA,
    // especificicando q la llave foranea sera user_id


    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }


    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function status_product()
    {
        return $this->belongsTo(StatusProduct::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }


    // UNO A MUCHOS POLIMORFICA

    // Una UN PRODUCTO PUEDE TENER AHORA MUCHAS IMAGENES

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }



    // especificicando q la llave foranea sera sku
    public function inventories()
    {
        // return $this->hasMany(Inventory::class, 'sku');
    }


    // relacion *** MUCHOS A MUCHOS
    public function colors()
    {
        return $this->belongsToMany(Color::class)->withPivot('quantity');
    }

    public function sizes()
    {
        //   return $this->belongsToMany(Size::class);
    }
}
