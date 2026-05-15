<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $posts = collect([
            [
                'title' => '2026 Gözlük Trendleri',
                'slug' => '2026-gozluk-trendleri',
                'image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Yeni sezon premium gözlük trendlerini keşfedin.',
            ],
            [
                'title' => 'Yüz Şekline Göre Gözlük Seçimi',
                'slug' => 'yuz-sekline-gore-gozluk-secimi',
                'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Doğru çerçeve seçimi için ipuçları.',
            ],
            [
                'title' => 'Polarize Cam Nedir?',
                'slug' => 'polarize-cam-nedir',
                'image' => 'https://images.unsplash.com/photo-1508296695146-257a814070b4?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Polarize cam teknolojisinin avantajları.',
            ],
        ]);

        return view('frontend.blog.index', compact('posts'));
    }

    public function show($slug)
    {
        return view('frontend.blog.show', compact('slug'));
    }
}