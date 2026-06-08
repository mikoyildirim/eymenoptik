<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.brands.index', ['brands' => Brand::latest()->paginate(20)]);
    }
    public function create()
    {
        return view('admin.brands.form', ['brand' => new Brand]);
    }
    public function store(Request $r)
    {
        $type = $r->input('type', 'gozluk');
        $d = $r->validate([
            'name'      => ['required', 'max:255', Rule::unique('brands')->where(fn($q) => $q->where('type', $type))],
            'is_active' => 'nullable',
            'type'      => 'nullable|in:gozluk,lens',
        ], [
            'name.unique' => 'Bu marka adı ve tipte zaten bir marka kayıtlı.',
            'name.required' => 'Marka adı zorunludur.',
            'name.max' => 'Marka adı en fazla 255 karakter olabilir.',
        ]);
        Brand::create(['name' => $d['name'], 'slug' => Str::slug($d['name'] . '-' . $type), 'is_active' => $r->boolean('is_active'), 'type' => $type]);
        return redirect()->route('admin.brands.index')->with('success', 'Marka eklendi.');
    }
    public function edit(Brand $brand)
    {
        return view('admin.brands.form', compact('brand'));
    }
    public function update(Request $r, Brand $brand)
    {
        $type = $r->input('type', 'gozluk');
        $d = $r->validate([
            'name'      => ['required', 'max:255', Rule::unique('brands')->where(fn($q) => $q->where('type', $type))->ignore($brand->id)],
            'is_active' => 'nullable',
            'type'      => 'nullable|in:gozluk,lens',
        ], [
            'name.unique' => 'Bu marka adı ve tipte zaten bir marka kayıtlı.',
            'name.required' => 'Marka adı zorunludur.',
            'name.max' => 'Marka adı en fazla 255 karakter olabilir.',
        ]);
        $brand->update(['name' => $d['name'], 'slug' => Str::slug($d['name'] . '-' . $type), 'is_active' => $r->boolean('is_active'), 'type' => $type]);
        return redirect()->route('admin.brands.index')->with('success', 'Marka güncellendi.');
    }
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return back()->with('success', 'Marka silindi.');
    }
    public function show(Brand $brand)
    {
        return redirect()->route('admin.brands.edit', $brand);
    }
}
