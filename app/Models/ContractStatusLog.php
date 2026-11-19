<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractStatusLog extends Model
{
    protected $guarded = ['id'];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
