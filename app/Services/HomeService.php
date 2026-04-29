<?php

namespace App\Services;

use App\Models\Category;
use App\Models\GeneralReview;
use App\Models\Product;
use App\Models\PromoBanner;
use App\Models\Setting;

class HomeService
{
    public function home()
    {
        $setting = Setting::first();
        $banners = PromoBanner::where('is_active', true)->get();
        $categories = Category::all();
        $allProducts = Product::with(['images', 'category'])->latest()->paginate(10);

        return compact('setting', 'banners', 'categories', 'allProducts');
    }

    public function generalReview(array $data)
    {

        $result = GeneralReview::create([
            'name' => $data['name'],
            'review' => $data['review'],
            'is_approved' => true,
            'is_highlighted' => false,
        ]);

        return $result;
    }
}
