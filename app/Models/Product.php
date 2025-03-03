<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'image', 'price', 'qty'];
    
    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    // }

public function category()
{
    return $this->belongsTo(Category::class);
}
}
