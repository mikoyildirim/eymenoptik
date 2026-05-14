<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', ['products' => Product::with('category', 'brand')->latest()->paginate(20)]);
    }
    public function create()
    {
        return view('admin.products.form', ['product' => new Product, 'categories' => Category::all(), 'brands' => Brand::all()]);
    }
    public function store(Request $r)
    {
        $d = $this->valid($r);
        if ($r->hasFile('image')) {
            $d['image'] = $r->file('image')->store('products', 'public');
        }
        $d['slug'] = Str::slug($d['name']) . '-' . uniqid();
        $d['is_active'] = $r->boolean('is_active');
        $d['is_featured'] = $r->boolean('is_featured');
        Product::create($d);
        return redirect()->route('admin.products.index')->with('success', 'Ürün eklendi.');
    }
    public function edit(Product $product)
    {
        return view('admin.products.form', ['product' => $product, 'categories' => Category::all(), 'brands' => Brand::all()]);
    }
    public function update(Request $r, Product $product)
    {
        $d = $this->valid($r);
        if ($r->hasFile('image')) {
            $d['image'] = $r->file('image')->store('products', 'public');
        }
        $d['is_active'] = $r->boolean('is_active');
        $d['is_featured'] = $r->boolean('is_featured');
        $product->update($d);
        return redirect()->route('admin.products.index')->with('success', 'Ürün güncellendi.');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Ürün silindi.');
    }
    public function show(Product $product)
    {
        return redirect()->route('admin.products.edit', $product);
    }
    private function valid(Request $r)
    {
        return $r->validate(['category_id' => 'required|exists:categories,id', 'brand_id' => 'nullable|exists:brands,id', 'name' => 'required|max:255', 'gender' => 'required|in:erkek,kadin,unisex,cocuk', 'type' => 'required|in:gunes_gozlugu,optik_gozluk,spor,luxury', 'price' => 'required|numeric|min:0', 'discount_price' => 'nullable|numeric|min:0', 'stock' => 'required|integer|min:0', 'image' => 'nullable|image', 'short_description' => 'nullable', 'description' => 'nullable', 'model_code' => 'nullable', 'frame_color' => 'nullable', 'glass_color' => 'nullable', 'frame_material' => 'nullable', 'glass_type' => 'nullable']);
    }
}
