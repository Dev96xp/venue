<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;  // Lo agregre para poder usar roles y permisos

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;                       // Lo agregre para poder usar roles y permisos

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'cus_id',
        'phone',
        'company',
        'address',
        'city',
        'state',
        'zip',
        'email',
        'password',
        'store_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // Relacion uno a muchos
    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function ipxes()
    {
        return $this->hasMany(Ipx::class);
    }



    // relacion UNO A MUCHOS INVERSA,
    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    // relacion UNO A UNO
    public function account()
    {
        return $this->hasOne('App\Models\Account');
    }
}
