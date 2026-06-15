<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::query()
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'badge' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'text' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'slider_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/sliders'), $imageName);

            $validated['image'] = 'uploads/sliders/' . $imageName;
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Slider::create($validated);

        return redirect()
            ->route('admin.sliders.index')
            ->with('success', 'Slider başarıyla eklendi.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'badge' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'text' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:500',
           'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:20480',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if (!empty($slider->image) && File::exists(public_path($slider->image))) {
                File::delete(public_path($slider->image));
            }

            $image = $request->file('image');
            $imageName = 'slider_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/sliders'), $imageName);

            $validated['image'] = 'uploads/sliders/' . $imageName;
        } else {
            unset($validated['image']);
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $slider->update($validated);

        return redirect()
            ->route('admin.sliders.index')
            ->with('success', 'Slider başarıyla güncellendi.');
    }

    public function destroy(Slider $slider)
    {
        if (!empty($slider->image) && File::exists(public_path($slider->image))) {
            File::delete(public_path($slider->image));
        }

        $slider->delete();

        return redirect()
            ->route('admin.sliders.index')
            ->with('success', 'Slider başarıyla silindi.');
    }
}