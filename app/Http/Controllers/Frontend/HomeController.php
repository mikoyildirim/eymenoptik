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
        return view('frontend.home', [
            'products' => Product::with('category', 'brand')->where('is_active', 1)->latest()->get(),
            'categories' => Category::withCount(['products' => function ($query) {
                $query->where('is_active', 1);
            }])->where('is_active', 1)->get(),
            'brands' => Brand::withCount(['products' => function ($query) {
                $query->where('is_active', 1);
            }])->where('is_active', 1)->orderBy('name')->get(),
        ]);
    }
}
