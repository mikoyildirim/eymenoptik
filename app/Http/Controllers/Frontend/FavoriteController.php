<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Product;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $favorites = Favorite::where('user_id', $user->id)->with('product')->get();

        $payload = $favorites->map(function ($fav) {
            $p = $fav->product;
            if (!$p) return null;

            return [
                'id' => $p->id,
                'name' => $p->name,
                'price' => $p->discount_price ?: $p->price,
                'img' => $p->getImageUrlAttribute(),
                'product_id' => $p->id,
            ];
        })->filter()->values();

        return response()->json($payload);
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);

        $user = Auth::user();
        $productId = (int) $request->input('product_id');

        $existing = Favorite::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['action' => 'removed']);
        }

        Favorite::create([
            'user_id' => $user->id,
            'product_id' => $productId,
        ]);

        return response()->json(['action' => 'added']);
    }
}
