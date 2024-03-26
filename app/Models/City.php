<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'cost', ' state_id'];

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
