<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;

    /*Allow mass assignment for these fields*/
    protected $fillable = ['category_id','sub_category_id', 'name', 'slug', 'status'];
}
