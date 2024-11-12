<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'slug', 'status'];

    /* A SubCategory belongs to one Category*/
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /* A SubCategory has many ChildCategories*/
    public function childCategories()
    {
        return $this->hasMany(ChildCategory::class);
    }
}
