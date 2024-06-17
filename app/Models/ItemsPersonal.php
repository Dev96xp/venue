<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsPersonal extends Model
{
    use HasFactory;

    //Asignacion masiva
    protected $guarded = ['id'];

    // relacion UNO A MUCHOS INVERSA,
    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }

    // RELACION UNO A MUCHOS INVERSA
    public function status_items()
    {
        return $this->belongsTo(StatusItemsVenue::class);
    }
}
