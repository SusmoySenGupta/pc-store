<?php

namespace App\Models;

use App\Jobs\QueuedPasswordResetJob;
use App\Jobs\QueuedVerifyEmailJob;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE_SUPER_ADMIN     = 'super-admin';
    public const ROLE_ADMIN           = 'admin';
    public const ROLE_CUSTOMER        = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        QueuedVerifyEmailJob::dispatch($this);
    }

    /**
     * @param $token
     */
    public function sendPasswordResetNotification($token)
    {
        QueuedPasswordResetJob::dispatch($this, $token);
    }

    /**
     * The method for getting only admin users.
     *
     * @param $query
     * @return mixed
     */
    public static function scopeExceptSuperAdmin($query)
    {
        return $query->where('role', '!=', self::ROLE_SUPER_ADMIN);
    }

    /**
     * The method for getting only admin users.
     *
     * @param $query
     * @return mixed
     */
    public static function scopeAdmins($query)
    {
        return $query->where('role', self::ROLE_ADMIN);
    }

    /**
     * The method for getting only customer users.
     *
     * @param $query
     * @return mixed
     */
    public static function scopeCustomers($query)
    {
        return $query->where('role', self::ROLE_CUSTOMER);
    }

    /**
     * Determines whether the user is a super administrator.
     * 
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    /**
     * Determines whether the user is an administrator.
     * 
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Determines whether the user is a customer.
     * 
     * @return bool
     */
    public function isCustomer(): bool
    {
        return $this->role === self::ROLE_CUSTOMER;
    }
}
