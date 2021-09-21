<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
