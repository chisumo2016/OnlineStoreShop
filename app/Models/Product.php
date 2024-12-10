<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;



    /**
     * Vendor relationship
     */
    public function vendor() :BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Category relationship
     */
    public function category():  BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Subcategory relationship
     */
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    /**
     * Child category relationship
     */
    public function childCategory():BelongsTo
    {
        return $this->belongsTo(ChildCategory::class, 'child_category_id');
    }

    /**
     * Brand relationship
     */
    public function brand():BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}

