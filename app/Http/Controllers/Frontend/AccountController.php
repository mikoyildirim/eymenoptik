<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller; use App\Models\Product; use App\Models\Order; use App\Models\Favorite;
class AccountController extends Controller { public function index(){ $user=auth()->user(); return view('frontend.account', ['products'=>Product::where('is_active',1)->latest()->take(4)->get(), 'orders'=>Order::where('user_id',$user->id)->latest()->take(3)->get(), 'favoriteCount'=>Favorite::where('user_id',$user->id)->count()]); } }
