<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class AccountController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])
            ->where('is_active', 1)
            ->latest()
            ->take(12)
            ->get();

        return view('frontend.account', [
            'categories' => Category::withCount('products')
                ->where('is_active', 1)
                ->get(),

            'products' => $products,
        ]);
    }
}