@extends('admin.layout')

@section('title', $product->exists ? 'Ürün Düzenle' : 'Ürün Ekle')

@section('content_header')
<div class="eo-page-header">
    <div>
        <span class="eo-page-badge">
            <i class="fas fa-glasses"></i>
            Eymen Optik
        </span>

        <h1>{{ $product->exists ? 'Ürün Düzenle' : 'Yeni Ürün Ekle' }}</h1>

        <p>
            Ürün bilgilerini, fiyatları, stok durumunu ve vitrin ayarlarını yönetin.
        </p>
    </div>

    <a href="{{ route('admin.products.index') }}" class="btn eo-btn-light">
        <i class="fas fa-arrow-left"></i>
        Ürünlere Dön
    </a>
</div>
@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger eo-alert">
    <strong>Formda eksik veya hatalı alanlar var.</strong>
    <ul class="mb-0 mt-2">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form
    method="POST"
    enctype="multipart/form-data"
    action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
>
    @csrf

    @if($product->exists)
        @method('PUT')
    @endif

    <div class="row">

        <div class="col-lg-8">

            <div class="card eo-card">

                <div class="card-header eo-card-header">
                    <div>
                        <h3>
                            <i class="fas fa-info-circle"></i>
                            Ürün Bilgileri
                        </h3>
                        <p>Ürün adı, kategori, marka ve açıklama bilgileri</p>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12 form-group">
                            <label>Ürün Adı</label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $product->name) }}"
                                class="form-control eo-input"
                                placeholder="Örn: Eymen Milano Black"
                                required
                            >
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Kategori</label>
                            <select name="category_id" class="form-control eo-input" required>
                                <option value="">Kategori seçiniz</option>

                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        @selected(old('category_id', $product->category_id) == $category->id)
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Marka</label>
                            <select name="brand_id" class="form-control eo-input">
                                <option value="">Marka seçiniz</option>

                                @foreach($brands as $brand)
                                    <option
                                        value="{{ $brand->id }}"
                                        @selected(old('brand_id', $product->brand_id) == $brand->id)
                                    >
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Ürün Tipi</label>
                            <select name="type" class="form-control eo-input">
                                @foreach([
                                    'gunes_gozlugu' => 'Güneş Gözlüğü',
                                    'optik_gozluk' => 'Optik Gözlük',
                                    'spor' => 'Spor',
                                    'luxury' => 'Luxury'
                                ] as $key => $label)
                                    <option
                                        value="{{ $key }}"
                                        @selected(old('type', $product->type) == $key)
                                    >
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Cinsiyet</label>
                            <select name="gender" class="form-control eo-input">
                                @foreach([
                                    'unisex' => 'Unisex',
                                    'erkek' => 'Erkek',
                                    'kadin' => 'Kadın',
                                    'cocuk' => 'Çocuk'
                                ] as $key => $label)
                                    <option
                                        value="{{ $key }}"
                                        @selected(old('gender', $product->gender) == $key)
                                    >
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Kısa Açıklama</label>
                            <textarea
                                name="short_description"
                                class="form-control eo-input"
                                rows="3"
                                placeholder="Ürün kartlarında gösterilecek kısa açıklama"
                            >{{ old('short_description', $product->short_description) }}</textarea>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Detaylı Açıklama</label>
                            <textarea
                                name="description"
                                class="form-control eo-input"
                                rows="6"
                                placeholder="Ürün detay sayfasında gösterilecek açıklama"
                            >{{ old('description', $product->description) }}</textarea>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card eo-card">

                <div class="card-header eo-card-header">
                    <div>
                        <h3>
                            <i class="fas fa-money-bill-wave"></i>
                            Satış Bilgileri
                        </h3>
                        <p>Fiyat, indirim ve stok ayarları</p>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label>Fiyat</label>
                        <input
                            type="number"
                            step="0.01"
                            name="price"
                            value="{{ old('price', $product->price) }}"
                            class="form-control eo-input"
                            placeholder="0.00"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label>İndirimli Fiyat</label>
                        <input
                            type="number"
                            step="0.01"
                            name="discount_price"
                            value="{{ old('discount_price', $product->discount_price) }}"
                            class="form-control eo-input"
                            placeholder="Opsiyonel"
                        >
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input
                            type="number"
                            name="stock"
                            value="{{ old('stock', $product->stock ?? 0) }}"
                            class="form-control eo-input"
                            min="0"
                            required
                        >
                    </div>

                </div>

            </div>

            <div class="card eo-card">

                <div class="card-header eo-card-header">
                    <div>
                        <h3>
                            <i class="fas fa-image"></i>
                            Ürün Görseli
                        </h3>
                        <p>Listeleme ve vitrin görseli</p>
                    </div>
                </div>

                <div class="card-body">

                    @if($product->exists && !empty($product->image_url))
                        <div class="eo-preview">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        </div>
                    @endif

                    <div class="form-group mb-0">
                        <label>Görsel Yükle</label>
                        <input
                            type="file"
                            name="image"
                            class="form-control eo-input"
                            accept="image/*"
                        >
                    </div>

                </div>

            </div>

            <div class="card eo-card">

                <div class="card-header eo-card-header">
                    <div>
                        <h3>
                            <i class="fas fa-toggle-on"></i>
                            Yayın Ayarları
                        </h3>
                        <p>Ürünün sitedeki görünürlüğü</p>
                    </div>
                </div>

                <div class="card-body">

                    <label class="eo-check">
                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            @checked(old('is_active', $product->exists ? $product->is_active : true))
                        >
                        <span>
                            <b>Aktif Ürün</b>
                            <small>Ürün mağazada görünsün.</small>
                        </span>
                    </label>

                    <label class="eo-check">
                        <input
                            type="checkbox"
                            name="is_featured"
                            value="1"
                            @checked(old('is_featured', $product->is_featured))
                        >
                        <span>
                            <b>Öne Çıkan</b>
                            <small>Ana sayfa vitrininde göster.</small>
                        </span>
                    </label>

                    <button type="submit" class="btn eo-btn-primary btn-block mt-4">
                        <i class="fas fa-save"></i>
                        {{ $product->exists ? 'Değişiklikleri Kaydet' : 'Ürünü Kaydet' }}
                    </button>

                </div>

            </div>

        </div>

    </div>

</form>

@endsection

@section('page_css')
<style>
    .eo-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        padding: 30px;
        border-radius: 28px;
        margin-bottom: 20px;
        background:
            radial-gradient(circle at top right, rgba(199,154,58,.18), transparent 30%),
            linear-gradient(135deg,#07111f,#17375f);
        color: #fff;
        box-shadow: 0 24px 60px rgba(7,17,31,.18);
    }

    .eo-page-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(255,255,255,.12);
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 14px;
    }

    .eo-page-header h1 {
        font-size: 38px;
        font-weight: 900;
        letter-spacing: -1.4px;
        margin-bottom: 6px;
    }

    .eo-page-header p {
        margin: 0;
        color: rgba(255,255,255,.68);
    }

    .eo-btn-primary {
        height: 48px;
        padding: 0 22px;
        border: none;
        border-radius: 16px;
        background: linear-gradient(135deg,#2854d9,#17375f);
        color: #fff !important;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 16px 34px rgba(40,84,217,.24);
    }

    .eo-btn-light {
        height: 48px;
        padding: 0 22px;
        border-radius: 16px;
        background: #fff;
        color: #07111f !important;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .eo-card {
        border: none;
        border-radius: 26px;
        overflow: hidden;
        box-shadow: 0 18px 44px rgba(7,17,31,.07);
        margin-bottom: 20px;
    }

    .eo-card-header {
        background: #fff;
        padding: 22px 24px;
        border-bottom: 1px solid rgba(7,17,31,.06);
    }

    .eo-card-header h3 {
        font-size: 18px;
        font-weight: 900;
        color: #07111f;
        margin: 0 0 6px;
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .eo-card-header p {
        margin: 0;
        color: #707b8d;
        font-size: 13px;
        font-weight: 600;
    }

    .eo-input {
        height: 48px;
        border-radius: 15px;
        border: 1px solid rgba(7,17,31,.09);
        font-weight: 650;
    }

    textarea.eo-input {
        height: auto;
        resize: vertical;
    }

    .eo-input:focus {
        border-color: rgba(40,84,217,.38);
        box-shadow: 0 0 0 4px rgba(40,84,217,.08);
    }

    .eo-preview {
        width: 100%;
        height: 190px;
        border-radius: 22px;
        overflow: hidden;
        background: #eef2f8;
        margin-bottom: 18px;
    }

    .eo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .eo-check {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 15px;
        border-radius: 18px;
        background: #f4f6fb;
        margin-bottom: 12px;
        cursor: pointer;
    }

    .eo-check input {
        margin-top: 5px;
    }

    .eo-check b {
        display: block;
        color: #07111f;
        font-weight: 900;
    }

    .eo-check small {
        color: #707b8d;
        font-weight: 650;
    }

    .eo-alert {
        border-radius: 18px;
        border: none;
    }

    @media(max-width: 768px) {
        .eo-page-header {
            flex-direction: column;
            align-items: flex-start;
            padding: 24px;
        }
    }
</style>
@endsection