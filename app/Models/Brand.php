<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['logo', 'name', 'slug', 'is_featured', 'status'];


    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }
}
