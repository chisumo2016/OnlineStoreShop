<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class ChildCategory extends Model
{
    use HasFactory;

    /*Allow mass assignment for these fields*/
    protected $fillable = ['category_id','sub_category_id', 'name', 'slug', 'status'];

    /* A ChildCategory belongs to one SubCategory*/
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    /* An indirect relationship to Category through SubCategory*/
    public function category(): HasOneThrough
    {
        //$this->belongsTo(Category::class);
        return $this->hasOneThrough(Category::class, SubCategory::class, 'id', 'id', 'sub_category_id', 'category_id');
    }
}
