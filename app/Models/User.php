<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Jobs\QueuedVerifyEmailJob;
use App\Jobs\QueuedPasswordResetJob;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE_SUPER_ADMIN = 'super-admin';
    public const ROLE_ADMIN       = 'admin';
    public const ROLE_CUSTOMER    = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'zip',
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

    public static function superAdmins()
    {
        return self::where('role', self::ROLE_SUPER_ADMIN)->get();
    }

    /**
     * Defines the relationship between the user and the cart
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * Defines the relationship between the user and the orders
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Defines the relationship between the user and the payments.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeAuthUser()
    {
        return $this->where('id', auth()->id())->first();
    }
}
