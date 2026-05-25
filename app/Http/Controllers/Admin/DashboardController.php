<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $paidOrders = Order::paid();

        return view('admin.dashboard', [
            'productCount' => Product::count(),
            'categoryCount' => Category::count(),
            'brandCount' => Brand::count(),
            'orderCount' => $paidOrders->count(),
            'completedOrderCount' => (clone $paidOrders)->where('status', 'tamamlandi')->count(),
            'pendingOrderCount' => (clone $paidOrders)->whereIn('status', ['beklemede', 'hazirlaniyor', 'kargoda'])->count(),
            'latestOrders' => (clone $paidOrders)->latest()->take(5)->get(),
        ]);
    }
}
