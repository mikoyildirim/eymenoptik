<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

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
            ->take(5)
            ->get();

        // Prefer products ranked by sold quantity (order_items). If no sales exist, fall back to `is_featured`.
        $soldProductIds = OrderItem::select('product_id', DB::raw('SUM(quantity) as sold'))
            ->groupBy('product_id')
            ->orderByDesc('sold')
            ->take(5)
            ->pluck('product_id');

        if ($soldProductIds->isNotEmpty()) {
            $bestSellerProducts = Product::with(['category', 'brand'])
                ->where('is_active', 1)
                ->whereIn('id', $soldProductIds->toArray())
                ->get()
                ->sortBy(function ($p) use ($soldProductIds) {
                    return array_search($p->id, $soldProductIds->toArray());
                })
                ->values();
        } else {
            $bestSellerProducts = Product::with(['category', 'brand'])
                ->where('is_active', 1)
                ->where('is_featured', 1)
                ->latest()
                ->take(5)
                ->get();
        }

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
