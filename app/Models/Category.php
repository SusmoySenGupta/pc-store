<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory, SoftDeletes, NodeTrait;

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    protected $casts = [
        'parent_id' => 'integer',
    ];

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
     * @param $query
     * @return mixed
     */
    public static function scopeParents($query)
    {
        return $query->where('parent_id', null);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id')->withDefault();
    }
}
