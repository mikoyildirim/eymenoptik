<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category', 'brand')->where('is_active', 1);

        if ($request->filled('q')) {
            $search = trim((string) $request->input('q'));

            $query->where(function ($searchQuery) use ($search) {
                $searchQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('short_description', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($categoryQuery) use ($search) {
                        $categoryQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('slug', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('brand', function ($brandQuery) use ($search) {
                        $brandQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('slug', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($categoryQuery) use ($request) {
                $categoryQuery->where('slug', $request->string('category'));
            });
        }

        if ($request->filled('brand')) {
            $query->whereHas('brand', function ($brandQuery) use ($request) {
                $brandQuery->where('slug', $request->string('brand'));
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->string('gender'));
        }

        $products = $query->latest()->get();

        // total active products count (unfiltered) for sidebar totals
        $allProductsCount = Product::where('is_active', 1)->count();

        $categories = Category::withCount(['products' => function ($query) {
            $query->where('is_active', 1);
        }])->where('is_active', 1)->get();

        $brands = Brand::withCount(['products' => function ($query) {
            $query->where('is_active', 1);
        }])->where('is_active', 1)->orderBy('name')->get();

        // frame color counts
        $frameColorsCount = Product::where('is_active', 1)
            ->whereNotNull('frame_color')
            ->select('frame_color')
            ->selectRaw('count(*) as count')
            ->groupBy('frame_color')
            ->pluck('count', 'frame_color')
            ->toArray();

        // glass color counts
        $glassColorsCount = Product::where('is_active', 1)
            ->whereNotNull('glass_color')
            ->select('glass_color')
            ->selectRaw('count(*) as count')
            ->groupBy('glass_color')
            ->pluck('count', 'glass_color')
            ->toArray();

        // gender counts
        $genderCounts = Product::where('is_active', 1)
            ->select('gender')
            ->selectRaw('count(*) as count')
            ->groupBy('gender')
            ->pluck('count', 'gender')
            ->toArray();

        return view('frontend.products.index', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'frameColorsCount' => $frameColorsCount,
            'glassColorsCount' => $glassColorsCount,
            'genderCounts' => $genderCounts,
            'allProductsCount' => $allProductsCount,
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'images']);

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
