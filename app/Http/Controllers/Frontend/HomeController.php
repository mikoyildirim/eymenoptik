<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])
            ->where('is_active', 1)
            ->latest()
            ->take(20)
            ->get();

        $discountProducts = Product::with(['category', 'brand'])
            ->where('is_active', 1)
            ->whereNotNull('discount_price')
            ->latest()
            ->take(10)
            ->get();

        $bestSellerProducts = Product::with(['category', 'brand'])
            ->where('is_active', 1)
            ->where('is_featured', 1)
            ->latest()
            ->take(10)
            ->get();

        return view('frontend.home', [
            'categories' => Category::withCount('products')
                ->where('is_active', 1)
                ->get(),

            'brands' => Brand::withCount('products')
                ->where('is_active', 1)
                ->get(),

            'products' => $products,

            'discountProducts' => $discountProducts->isNotEmpty()
                ? $discountProducts
                : $products,

            'bestSellerProducts' => $bestSellerProducts->isNotEmpty()
                ? $bestSellerProducts
                : $products,
        ]);
    }
}