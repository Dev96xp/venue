<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'user_id'];

    // Relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }


}
