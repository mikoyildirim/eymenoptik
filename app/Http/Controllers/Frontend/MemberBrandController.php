<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;

class MemberBrandController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount('products')
            ->where('is_active', 1)
            ->orderBy('name')
            ->get();

        return view('frontend.brands.index', compact('brands'));
    }
}