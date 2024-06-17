<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsDecoration extends Model
{
    use HasFactory;

    //Asignacion masiva
    protected $guarded = ['id'];

    // relacion UNO A MUCHOS INVERSA,
    public function decoration()
    {
        return $this->belongsTo(Decoration::class);
    }

    // RELACION UNO A MUCHOS INVERSA
    public function status_items()
    {
        return $this->belongsTo(StatusItemsVenue::class);
    }
}
