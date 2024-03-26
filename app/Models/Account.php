<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'acc_id', 'user_id'];

    // RELACION UNO A MUCHOS
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


    // RELACION UNO A UNO INVERSA
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
