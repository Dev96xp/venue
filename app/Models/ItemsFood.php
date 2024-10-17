<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsFood extends Model
{
    use HasFactory;

    //Asignacion masiva
    protected $guarded = ['id'];

    // relacion UNO A MUCHOS INVERSA,
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    // RELACION UNO A MUCHOS INVERSA
    public function status_items()
    {
        return $this->belongsTo(StatusItem::class);
    }
}
