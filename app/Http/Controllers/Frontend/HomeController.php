<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller; use App\Models\Product; use App\Models\Category;
class HomeController extends Controller { public function index(){ return view('frontend.home', ['products'=>Product::with('category','brand')->where('is_active',1)->latest()->take(12)->get(), 'categories'=>Category::where('is_active',1)->get()]); } }
