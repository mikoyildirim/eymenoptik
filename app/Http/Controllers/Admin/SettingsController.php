<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::query()->firstOrCreate(
            ['id' => 1],
            SiteSetting::defaults()
        );

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:1000',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'about_text' => 'nullable|string',
            'shipping_free_threshold' => 'required|numeric|min:0',
            'shipping_cost' => 'required|numeric|min:0',
        ]);

        $settings = SiteSetting::query()->firstOrCreate(['id' => 1], SiteSetting::defaults());
        $settings->update($validated);

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Site ayarları güncellendi.');
    }
}