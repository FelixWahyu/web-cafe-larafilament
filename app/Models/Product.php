<?php
namespace App\Models;

use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    // Relasi: 1 Produk memiliki 1 Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: 1 Produk bisa memiliki Banyak Gambar
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Relasi: 1 Produk bisa memiliki Banyak Review
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}