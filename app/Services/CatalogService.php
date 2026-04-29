<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;

class CatalogService
{
    public function getCatalog(array $filters)
    {
        $categories = Category::all();

        $query = Product::with(['images', 'category']);

        // Search
        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        // Filter Category
        if (!empty($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }

        $products = $query->latest()
            ->paginate(12)
            ->withQueryString();

        return compact('products', 'categories');
    }

    public function getDetail($slug)
    {
        $product = Product::with([
            'images',
            'category',
            'reviews' => function ($q) {
                $q->where('is_approved', true);
            }
        ])->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::with(['images', 'category'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return compact('product', 'relatedProducts');
    }
}
