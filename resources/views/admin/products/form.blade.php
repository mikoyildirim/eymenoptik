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

<form method="POST" enctype="multipart/form-data"
    action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}">
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
                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                class="form-control eo-input" placeholder="Örn: Eymen Milano Black" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Kategori</label>
                            <select name="category_id" class="form-control eo-input" required>
                                <option value="">Kategori seçiniz</option>

                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id)
                                    == $category->id)
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
                                <option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id) ==
                                    $brand->id)
                                    >
                                    {{ $brand->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Cinsiyet</label>
                            <select name="gender" class="form-control eo-input" required>
                                <option value="">Cinsiyet seçiniz</option>
                                @foreach([
                                'unisex' => 'Unisex',
                                'erkek' => 'Erkek',
                                'kadin' => 'Kadın',
                                'cocuk' => 'Çocuk'
                                ] as $key => $label)
                                <option value="{{ $key }}" @selected(old('gender', $product->gender) == $key)
                                    >
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Model Kodu</label>
                            <input type="text" name="model_code" value="{{ old('model_code', $product->model_code) }}"
                                class="form-control eo-input" placeholder="Örn: EM-1024">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Çerçeve Rengi</label>
                            <select name="frame_color" class="form-control eo-input">
                                <option value="">Renk seçiniz</option>
                                @foreach([
                                'siyah' => 'Siyah',
                                'beyaz' => 'Beyaz',
                                'kahverengi' => 'Kahverengi',
                                'fume' => 'Füme',
                                'saydam' => 'Şeffaf',
                                'altin' => 'Altın',
                                'gumus' => 'Gümüş',
                                'kirmizi' => 'Kırmızı',
                                'mavi' => 'Mavi',
                                'yesil' => 'Yeşil',
                                'karisik' => 'Karışık Renkler'
                                ] as $key => $label)
                                <option value="{{ $key }}" @selected(old('frame_color', $product->frame_color) ==
                                    $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Cam Rengi</label>
                            <select name="glass_color" class="form-control eo-input">
                                <option value="">Cam rengi seçiniz</option>
                                @foreach([
                                'siyah' => 'Siyah',
                                'beyaz' => 'Beyaz',
                                'kahverengi' => 'Kahverengi',
                                'fume' => 'Füme',
                                'saydam' => 'Şeffaf',
                                'altin' => 'Altın',
                                'gumus' => 'Gümüş',
                                'kirmizi' => 'Kırmızı',
                                'mavi' => 'Mavi',
                                'yesil' => 'Yeşil',
                                'karisik' => 'Karışık Renkler'
                                ] as $key => $label)
                                <option value="{{ $key }}" @selected(old('glass_color', $product->glass_color) ==
                                    $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Çerçeve Materyali</label>
                            <select name="frame_material" class="form-control eo-input" required>
                                <option value="">Materyal seçiniz</option>
                                @foreach([
                                'asetat' => 'Asetat',
                                'asetat_metal' => 'Asetat - Metal',
                                'grilamid' => 'Grilamid',
                                'metal' => 'Metal',
                                'plastik' => 'Plastik',
                                'diger' => 'Diğer'
                                ] as $key => $label)
                                <option value="{{ $key }}" @selected(old('frame_material', $product->frame_material) ==
                                    $key)
                                    >
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Cam Tipi</label>
                            <input type="text" name="glass_type" value="{{ old('glass_type', $product->glass_type) }}"
                                class="form-control eo-input" placeholder="Örn: UV400">
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Kısa Açıklama</label>
                            <textarea name="short_description" class="form-control eo-input" rows="3"
                                placeholder="Ürün kartlarında gösterilecek kısa açıklama">{{ old('short_description', $product->short_description) }}</textarea>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Detaylı Açıklama</label>
                            <textarea name="description" class="form-control eo-input" rows="6"
                                placeholder="Ürün detay sayfasında gösterilecek açıklama">{{ old('description', $product->description) }}</textarea>
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
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                            class="form-control eo-input" placeholder="0.00" required>
                    </div>

                    <div class="form-group">
                        <label>İndirimli Fiyat</label>
                        <input type="number" step="0.01" name="discount_price"
                            value="{{ old('discount_price', $product->discount_price) }}" class="form-control eo-input"
                            placeholder="Opsiyonel">
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}"
                            class="form-control eo-input" min="0" required>
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

                    @php
                        $existingMainImage = $product->exists && $product->image ? $product->image_url : null;
                        $existingExtraImages = $product->exists ? $product->images : collect();
                    @endphp

                    @if($product->exists && ($existingMainImage || $existingExtraImages->isNotEmpty()))
                    <div class="eo-preview">
                        <div class="eo-preview-grid">
                            @if($existingMainImage)
                            <div class="eo-preview-item" data-existing-main="1">
                                <img src="{{ $existingMainImage }}" alt="{{ $product->name }}">
                                <button type="button" class="eo-preview-remove" data-remove-main="1">×</button>
                                <span class="eo-upload-label">Ana görsel</span>
                            </div>
                            @endif

                            @foreach($existingExtraImages as $image)
                            <div class="eo-preview-item" data-existing-id="{{ $image->id }}">
                                <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}">
                                <button type="button" class="eo-preview-remove" data-image-id="{{ $image->id }}">×</button>
                                <span class="eo-upload-label">Ek görsel</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="form-group mb-0">
                        <label>Görselleri Yükle</label>
                        <input type="file" id="productImagesInput" name="images[]" class="form-control eo-input" accept="image/*" multiple {{ $product->exists ? '' : 'required' }}>
                        <input type="hidden" id="removedMainImageInput" name="removed_main_image" value="0">
                        <div id="removedImageIds"></div>
                        <div id="productImagesPreview" class="eo-upload-preview"></div>
                        <small class="text-muted d-block mt-2">En az 1, en fazla 4 görsel olabilir. Mevcut görsellerin üzerindeki çarpı ile silebilir, yeni görsel ekleyebilirsiniz.</small>
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
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->exists ?
                        $product->is_active : true))
                        >
                        <span>
                            <b>Aktif Ürün</b>
                            <small>Ürün mağazada görünsün.</small>
                        </span>
                    </label>

                    <label class="eo-check">
                        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured',
                            $product->is_featured))
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
            radial-gradient(circle at top right, rgba(199, 154, 58, .18), transparent 30%),
            linear-gradient(135deg, #07111f, #17375f);
        color: #fff;
        box-shadow: 0 24px 60px rgba(7, 17, 31, .18);
    }

    .eo-page-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(255, 255, 255, .12);
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
        color: rgba(255, 255, 255, .68);
    }

    .eo-btn-primary {
        height: 48px;
        padding: 0 22px;
        border: none;
        border-radius: 16px;
        background: linear-gradient(135deg, #2854d9, #17375f);
        color: #fff !important;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 16px 34px rgba(40, 84, 217, .24);
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
        box-shadow: 0 18px 44px rgba(7, 17, 31, .07);
        margin-bottom: 20px;
    }

    .eo-card-header {
        background: #fff;
        padding: 22px 24px;
        border-bottom: 1px solid rgba(7, 17, 31, .06);
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

    .eo-section-title {
        font-size: 15px;
        font-weight: 900;
        color: #07111f;
        margin: 0;
    }

    .eo-section-text {
        margin: 4px 0 0;
        color: #707b8d;
        font-size: 13px;
        font-weight: 600;
    }

    .eo-input {
        height: 48px;
        border-radius: 15px;
        border: 1px solid rgba(7, 17, 31, .09);
        font-weight: 650;
    }

    textarea.eo-input {
        height: auto;
        resize: vertical;
    }

    .eo-input:focus {
        border-color: rgba(40, 84, 217, .38);
        box-shadow: 0 0 0 4px rgba(40, 84, 217, .08);
    }

    .eo-preview {
        background: #eef2f8;
        border-radius: 22px;
        overflow: hidden;
        padding: 14px;
        margin-bottom: 18px;
    }

    .eo-preview-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .eo-preview-grid img {
        width: 100%;
        height: 140px;
        object-fit: cover;
        border-radius: 14px;
    }

    .eo-preview-item {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(7, 17, 31, .08);
        background: #fff;
        box-shadow: 0 10px 22px rgba(7, 17, 31, .06);
    }

    .eo-preview-item img {
        display: block;
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .eo-preview-remove {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 30px;
        height: 30px;
        border: 0;
        border-radius: 50%;
        background: rgba(17, 17, 17, .88);
        color: #fff;
        cursor: pointer;
        font-size: 20px;
        line-height: 1;
        display: grid;
        place-items: center;
    }

    .is-hidden {
        display: none !important;
    }

    .eo-upload-preview {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin-top: 14px;
    }

    .eo-upload-item {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(7, 17, 31, .08);
        background: #fff;
        box-shadow: 0 10px 22px rgba(7, 17, 31, .06);
    }

    .eo-upload-item img {
        display: block;
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .eo-upload-remove {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 30px;
        height: 30px;
        border: 0;
        border-radius: 50%;
        background: rgba(17, 17, 17, .88);
        color: #fff;
        cursor: pointer;
        font-size: 20px;
        line-height: 1;
        display: grid;
        place-items: center;
    }

    .eo-upload-label {
        position: absolute;
        left: 10px;
        bottom: 10px;
        background: rgba(255, 255, 255, .92);
        color: #111;
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
    }

    @media(max-width: 768px) {
        .eo-upload-preview {
            grid-template-columns: 1fr;
        }
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

@section('page_js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('productImagesInput');
        const preview = document.getElementById('productImagesPreview');
        const form = input?.closest('form');
        const removedMainImageInput = document.getElementById('removedMainImageInput');
        const removedImageIdsContainer = document.getElementById('removedImageIds');
        let selectedFiles = [];

        const existingItems = Array.from(document.querySelectorAll('[data-existing-main], [data-existing-id]'));

        function syncInputFiles() {
            if (!input) return;

            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;
        }

        function renderPreview() {
            if (!preview) return;

            if (selectedFiles.length === 0) {
                preview.innerHTML = '';
                return;
            }

            preview.innerHTML = selectedFiles.map((file, index) => {
                const url = URL.createObjectURL(file);

                return `
                    <div class="eo-upload-item">
                        <img src="${url}" alt="Seçilen görsel ${index + 1}">
                        <button type="button" class="eo-upload-remove" data-index="${index}" aria-label="Görseli kaldır">×</button>
                        <span class="eo-upload-label">${index + 1}. görsel</span>
                    </div>
                `;
            }).join('');

            preview.querySelectorAll('img').forEach(img => {
                img.addEventListener('load', function() {
                    URL.revokeObjectURL(this.src);
                });
            });
        }

        input?.addEventListener('change', function() {
            const incoming = Array.from(this.files || []);
            const combined = [...selectedFiles, ...incoming].slice(0, 4);

            selectedFiles = combined;
            syncInputFiles();
            renderPreview();
        });

        document.addEventListener('click', function(e) {
            const removeExistingButton = e.target.closest('.eo-preview-remove');
            if (!removeExistingButton) return;

            const existingMain = removeExistingButton.dataset.removeMain === '1';
            const imageId = removeExistingButton.dataset.imageId;

            if (existingMain && removedMainImageInput) {
                removedMainImageInput.value = '1';
                removeExistingButton.closest('[data-existing-main]')?.classList.add('is-hidden');
            }

            if (imageId) {
                if (removedImageIdsContainer) {
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'removed_image_ids[]';
                    hidden.value = imageId;
                    removedImageIdsContainer.appendChild(hidden);
                }

                removeExistingButton.closest('[data-existing-id]')?.classList.add('is-hidden');
            }

            if (selectedFiles.length === 0) return;
        });

        preview?.addEventListener('click', function(e) {
            const removeButton = e.target.closest('.eo-upload-remove');
            if (!removeButton) return;

            const index = Number(removeButton.dataset.index);
            if (Number.isNaN(index)) return;

            selectedFiles.splice(index, 1);
            syncInputFiles();
            renderPreview();
        });

        form?.addEventListener('submit', function(e) {
            if (!input) return;

            syncInputFiles();

            if (selectedFiles.length > 4) {
                selectedFiles = selectedFiles.slice(0, 4);
                syncInputFiles();
                renderPreview();
            }

            if (selectedFiles.length === 0 && !form.querySelector('input[name="images[]"][required]')) {
                return;
            }
        });
    });
</script>
@endsection