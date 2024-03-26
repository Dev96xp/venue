<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'envio_type',
        'content',
        'shipping_cost',
        'total',
        'city',
        'state',
        'district',
        'address',
        'account_id',
        'executive_id'
    ];

        // RELACION UNO A MUCHOS

        public function items()
        {
            return $this->hasMany(item::class);
        }

        // relacion UNO A MUCHOS INVERSA

        public function account()
        {
            return $this->belongsTo(Account::class);
        }
}
