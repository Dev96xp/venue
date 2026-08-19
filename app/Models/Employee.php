<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_VACATION = 'vacation';
    const STATUS_SUSPENDED = 'suspended';

    const STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
        self::STATUS_VACATION,
        self::STATUS_SUSPENDED,
    ];

    const PERIOD_HOURLY = 'hourly';
    const PERIOD_WEEKLY = 'weekly';
    const PERIOD_BIWEEKLY = 'biweekly';
    const PERIOD_MONTHLY = 'monthly';

    const SALARY_PERIODS = [
        self::PERIOD_HOURLY,
        self::PERIOD_WEEKLY,
        self::PERIOD_BIWEEKLY,
        self::PERIOD_MONTHLY,
    ];

    protected $fillable = [
        'name',
        'email',
        'employee_code',
        'password',
        'role',
        'salary',
        'salary_period',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'salary' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::created(function (Employee $employee) {
            $prefix = strtoupper(str_pad(substr(preg_replace('/[^A-Za-z]/', '', $employee->name), 0, 4), 4, 'X'));
            $code = sprintf(
                '%s-%s-%s-%s',
                $prefix,
                now()->format('ymd'),
                str_pad((string) $employee->id, 4, '0', STR_PAD_LEFT),
                str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT)
            );

            $employee->forceFill(['employee_code' => $code])->saveQuietly();
        });
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }
}
