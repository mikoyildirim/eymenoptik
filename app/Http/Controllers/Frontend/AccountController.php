<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $products = Product::with(['category', 'brand'])
            ->where('is_active', 1)
            ->latest()
            ->take(4)
            ->get();

        $orders = collect();
        $activeOrdersCount = 0;
        $favoriteCount = 0;

        if ($user) {
            // Show only orders that were successfully paid via Iyzico for this user
            $orders = Order::with('items')
                ->where('user_id', $user->id)
                ->where('iyzico_paid', true)
                ->latest()
                ->paginate(4);

            $activeOrdersCount = Order::where('user_id', $user->id)
                ->where('iyzico_paid', true)
                ->whereNotIn('status', ['tamamlandi', 'iptal'])
                ->count();

            $favoriteCount = Favorite::where('user_id', $user->id)->count();
        }

        $categories = Category::withCount('products')
            ->where('is_active', 1)
            ->get();

        $accountCategories = Category::withCount('products')
            ->where('is_active', 1)
            ->having('products_count', '>', 0)
            ->get();

        return view('frontend.account', [
            'categories' => $categories,
            'accountCategories' => $accountCategories,

            'products' => $products,
            'orders' => $orders,
            'activeOrdersCount' => $activeOrdersCount,
            'favoriteCount' => $favoriteCount,
        ]);
    }
}
