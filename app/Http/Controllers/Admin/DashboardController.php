<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Product; use App\Models\Category; use App\Models\Brand; use App\Models\Order;
class DashboardController extends Controller { public function index(){ return view('admin.dashboard', ['productCount'=>Product::count(),'categoryCount'=>Category::count(),'brandCount'=>Brand::count(),'orderCount'=>Order::count(),'latestOrders'=>Order::latest()->take(8)->get()]); } }
