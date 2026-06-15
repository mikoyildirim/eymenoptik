@extends('adminlte::page')

@section('title', 'Slider Düzenle')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="mb-0">Slider Düzenle</h1>
        <small class="text-muted">Mevcut slider bilgilerini güncelleyin</small>
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
        <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Ana Başlık</label>
                <input
                    type="text"
                    name="title"
                    class="form-control"
                    value="{{ old('title', $slider->title) }}"
                    placeholder="Modern ve Şık Gözlükler"
                    required />
            </div>

            <div class="form-group">
                <label>Açıklama Metni</label>
                <textarea
                    name="subtitle"
                    class="form-control"
                    rows="4"
                    placeholder="Yeni sezonun en özel gözlük modellerini keşfedin.">{{ old('subtitle', $slider->subtitle) }}</textarea>
            </div>

            <div class="form-group">
                <label>Buton Yazısı</label>
                <input
                    type="text"
                    name="button_text"
                    class="form-control"
                    value="{{ old('button_text', $slider->button_text) }}"
                    placeholder="Koleksiyonu Gör" />
            </div>

            <div class="form-group">
                <label>Buton Linki</label>
                <input
                    type="text"
                    name="button_url"
                    class="form-control"
                    value="{{ old('button_url', $slider->button_url) }}"
                    placeholder="{{ route('products.index') }}" />
            </div>

            <div class="form-group">
                <label>Mevcut Görsel</label>

                @if($slider->image)
                <div class="mb-3">
                    <img
                        src="{{ asset($slider->image) }}"
                        style="max-width:320px;height:180px;object-fit:cover;border-radius:14px;border:1px solid #eee;" />
                </div>
                @else
                <p class="text-muted">Görsel bulunamadı.</p>
                @endif
            </div>

            <div class="form-group">
                <label>Yeni Görsel Yükle</label>
                <input
                    type="file"
                    name="image"
                    class="form-control"
                    accept="image/*" />
                <small class="text-muted">
                    Yeni görsel seçmezseniz eski görsel korunur.
                </small>
            </div>

            <div class="form-group">
                <label>Sıralama</label>
                <input
                    type="number"
                    name="sort_order"
                    class="form-control"
                    value="{{ old('sort_order', $slider->sort_order) }}"
                    min="0" />
            </div>

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        class="custom-control-input"
                        id="is_active"
                        {{ old('is_active', $slider->is_active) ? 'checked' : '' }} />
                    <label class="custom-control-label" for="is_active">
                        Slider aktif olsun
                    </label>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-dark">
                    <i class="fas fa-save"></i> Güncelle
                </button>
            </div>

        </form>
    </div>
</div>

@endsection