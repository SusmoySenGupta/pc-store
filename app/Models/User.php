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

    private const SUPER_ADMINISTRATOR = 1;
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
        return $query->where('role', '!=', 'super-admin');
    }

    /**
     * The method for getting only admin users.
     *
     * @param $query
     * @return mixed
     */
    public static function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * The method for getting only customer users.
     *
     * @param $query
     * @return mixed
     */
    public static function scopeCustomers($query)
    {
        return $query->where('role', 'customer');
    }

    public function isSuperAdmin()
    {
        return $this->id === self::SUPER_ADMINISTRATOR;
    }
}
