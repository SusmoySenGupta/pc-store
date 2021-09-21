<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    /**
     * @return mixed
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class)->withDefault();
    }
}
