<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use PhpCollective\Tracker\Trackable;

class Product extends Model
{
    use HasFactory, SoftDeletes, Trackable;

    /**
     * The attributes that are not mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    /**
     * The method to set the slug attribute with name attribute.
     *
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    /**
     * The method to set the sku attribute.
     *
     * @param $value
     */
    public function setSkuAttribute($value)
    {
        $this->attributes['sku'] = Str::slug($value, '-');
    }

    /**
     * Get the brand of the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class)
            ->withDefault();
    }

    /**
     * Get the category of the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)
            ->withDefault();
    }

    /**
     * Get the tags of the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)
            ->withTimestamps();
    }

    /**
     * Get the images of the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get related user who created the product.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id')
            ->withDefault();
    }

    /**
     * Get related user who updated the product.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id')
            ->withDefault();
    }

    /**
     * Get related user who deleted the product.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id')
            ->withDefault();
    }

    /**
     * The boot method for the model.
     */
    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            $category->offer_price = $category->discount_percentage == 0.0 
            ? $category->price 
            : $category->price - ($category->price * $category->discount_percentage / 100);
            
        });
        static::updating(function ($category) {
            $category->offer_price = $category->discount_percentage == 0.0 
            ? $category->price 
            : $category->price - ($category->price * $category->discount_percentage / 100);
            
        });

        static::softDeleted(function($product) {
            $time = time();
            $product->name = $time . '-' . $product->name;
            $product->slug = $time . '-' . $product->slug;
            $product->deleted_by = auth()->user()->id;
        });

        static::deleting(fn($product) => $product->deleted_by = null);
    }
}
