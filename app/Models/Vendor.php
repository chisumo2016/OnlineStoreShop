<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner',
        'email',
        'phone',
        'address',
        'description',
        'fb_link',
        'tw_link',
        'insta_link',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
