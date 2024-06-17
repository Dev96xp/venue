<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsVenue extends Model
{
    use HasFactory;

    //Asignacion masiva
    protected $guarded = ['id'];

    // relacion UNO A MUCHOS INVERSA,
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    // RELACION UNO A MUCHOS INVERSA
    public function status_items_venue()
    {
        return $this->belongsTo(StatusItemsVenue::class);
    }

}
