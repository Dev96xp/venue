<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
        //Asignacion masiva
        protected $guarded = ['id'];

        use HasFactory;
        // RELACION UNO A MUCHOS

        public function users()
        {
            return $this->hasMany('App\Models\User');
        }

        public function orders(){
            return $this->hasMany(Order::class);
        }

}
