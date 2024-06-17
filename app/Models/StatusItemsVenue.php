<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusItemsVenue extends Model
{
    use HasFactory;

    //relacion UNO A MUCHOS
    public function items_venues()
    {
        return $this->hasMany(ItemsVenue::class);
    }
}
