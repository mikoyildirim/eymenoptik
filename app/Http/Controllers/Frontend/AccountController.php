<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Favorite;
use App\Models\Category;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        return view('frontend.account', ['products' => Product::with('category', 'brand')->where('is_active', 1)->latest()->take(4)->get(), 'categories' => Category::withCount(['products' => function ($query) {
            $query->where('is_active', 1);
        }])->where('is_active', 1)->get(), 'orders' => Order::where('user_id', $user->id)->latest()->take(3)->get(), 'favoriteCount' => Favorite::where('user_id', $user->id)->count()]);
    }
}
