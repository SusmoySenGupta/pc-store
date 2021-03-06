<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use PhpCollective\Tracker\Trackable;

class Brand extends Model
{
    use HasFactory, SoftDeletes, Trackable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'slug', 'logo', 'description'];

    /**
     * The method to change the default route key.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

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
     * Get all the related products.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }

    /**
     * Get related user who created the brand.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id')
            ->withDefault();
    }

    /**
     * Get related user who created the brand.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id')
            ->withDefault();
    }

    /**
     * Get related user who deleted the brand.
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

        static::softDeleted(function($brand) {
            $time = time();
            $brand->name = $time . '-' . $brand->name;
            $brand->slug = $time . '-' . $brand->slug;
            $brand->deleted_by = auth()->user()->id;
        });

        static::deleting(fn($brand) => $brand->deleted_by = null);
    }
}
