<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Component extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    /**
     * @return mixed
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Component::class, 'parent_id', 'id')->withDefault(function ()
        {
            $component       = new Component();
            $component->name = '---';

            return $component;
        });
    }

    /**
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'component_id', 'id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public static function scopeParents($query)
    {
        return $query->where('parent_id', null);
    }
}
