<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusItem extends Model
{
    use HasFactory;
    //relacion UNO A MUCHOS
    public function items_personals()
    {
        return $this->hasMany(ItemsPersonal::class);
    }

    public function items_drinks()
    {
        return $this->hasMany(ItemsDrink::class);
    }

    public function items_decorations()
    {
        return $this->hasMany(ItemsDecoration::class);
    }

    public function items_cleanings()
    {
        return $this->hasMany(ItemsCleaning::class);
    }

    // public function items_venues()
    // {
    //     return $this->hasMany(ItemsVenue::class);
    // }

    public function items_foods()
    {
        return $this->hasMany(ItemsFood::class);
    }

    public function items_musics()
    {
        return $this->hasMany(ItemsMusic::class);
    }
}
