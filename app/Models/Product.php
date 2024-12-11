<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'thumb_image',
        'short_description',
        'long_description',
        'price',
        'qty',
        'status',
        'seo_title',
        'seo_description',
        'video_link',
        'sku',
        'offer_price',
        'product_type',
        'is_approved',
        'offer_start_date',
        'offer_end_date',
        'vendor_id',
        'category_id',
        'sub_category_id',
        'child_category_id',
        'brand_id',



    ];

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

