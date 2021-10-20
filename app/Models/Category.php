<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use PhpCollective\Tracker\Trackable;

class Category extends Model
{
    use HasFactory, SoftDeletes, NodeTrait, Trackable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'parent_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'parent_id' => 'integer',
    ];

    /**
     * The method to change the default route key.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Query scope for parent categories.
     *
     * @param $query
     * @return mixed
     */
    public static function scopeParents($query)
    {
        return $query->where('parent_id', null);
    }

    /**
     * Get the parent category.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')->withDefault();
    }

    /**
     * Get related products.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    /**
     * Get related user who created the category.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id')
            ->withDefault();
    }

    /**
     * Get related user who updated the category.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id')
            ->withDefault();
    }

    /**
     * The boot method for the model.
     */
    public static function boot()
    {
        parent::boot();

        static::saving(fn ($category) => $category->slug = Str::slug($category->name . '-' . $category->parent?->name ?? '', '-'));
    }
}
