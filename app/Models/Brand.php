<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'logo', 'description'];

    /**
     * @return mixed
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
