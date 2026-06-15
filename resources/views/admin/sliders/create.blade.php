@extends('adminlte::page')

@section('title', 'Yeni Slider Ekle')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="mb-0">Yeni Slider Ekle</h1>
        <small class="text-muted">Ana sayfa için yeni slider oluşturun</small>
    </div>

    <a href="{{ route('admin.sliders.index') }}" class="btn btn-light">
        <i class="fas fa-arrow-left"></i> Geri Dön
    </a>
</div>
@endsection

@section('content')

@if($errors->any())
<div class="alert alert-danger">
    <strong>Hata!</strong> Lütfen formdaki alanları kontrol edin.
</div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Küçük Başlık</label>
                <input
                    type="text"
                    name="badge"
                    class="form-control"
                    value="{{ old('badge') }}"
                    placeholder="Premium Seçimler"
                >
            </div>

            <div class="form-group">
                <label>Ana Başlık</label>
                <input
                    type="text"
                    name="title"
                    class="form-control"
                    value="{{ old('title') }}"
                    placeholder="Modern ve Şık Gözlükler"
                    required
                >
            </div>

            <div class="form-group">
                <label>Açıklama Metni</label>
                <textarea
                    name="text"
                    class="form-control"
                    rows="4"
                    placeholder="Yeni sezonun en özel gözlük modellerini keşfedin."
                >{{ old('text') }}</textarea>
            </div>

            <div class="form-group">
                <label>Buton Yazısı</label>
                <input
                    type="text"
                    name="button_text"
                    class="form-control"
                    value="{{ old('button_text') }}"
                    placeholder="Koleksiyonu Gör"
                >
            </div>

            <div class="form-group">
                <label>Buton Linki</label>
                <input
                    type="text"
                    name="button_url"
                    class="form-control"
                    value="{{ old('button_url', route('products.index')) }}"
                    placeholder="{{ route('products.index') }}"
                >
            </div>

            <div class="form-group">
                <label>Slider Görseli</label>
                <input
                    type="file"
                    name="image"
                    class="form-control"
                    accept="image/*"
                    required
                >
            </div>

            <div class="form-group">
                <label>Sıralama</label>
                <input
                    type="number"
                    name="sort_order"
                    class="form-control"
                    value="{{ old('sort_order', 0) }}"
                    min="0"
                >
            </div>

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        class="custom-control-input"
                        id="is_active"
                        checked
                    >
                    <label class="custom-control-label" for="is_active">
                        Slider aktif olsun
                    </label>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-dark">
                    <i class="fas fa-save"></i> Slider Kaydet
                </button>
            </div>

        </form>
    </div>
</div>

@endsection