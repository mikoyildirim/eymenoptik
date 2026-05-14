<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category', 'brand')->where('is_active', 1);

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->get('category'));
            });
        }

        if ($request->has('brand')) {
            $query->whereHas('brand', function ($q) use ($request) {
                $q->where('slug', $request->get('brand'));
            });
        }

        $products = $query->latest()->get();

        $categories = Category::withCount(['products' => function ($query) {
            $query->where('is_active', 1);
        }])->where('is_active', 1)->get();

        $brands = Brand::withCount(['products' => function ($query) {
            $query->where('is_active', 1);
        }])->where('is_active', 1)->orderBy('name')->get();

        return view('frontend.products.index', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand']);

        $relatedProducts = Product::with('category', 'brand')
            ->where('is_active', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('frontend.products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
