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

@php
$selectedCategoryId = old('category_id', $product->category_id);
$selectedCategory = $categories->firstWhere('id', $selectedCategoryId);
$isLensCategory = $selectedCategory && str_contains(mb_strtolower((string) ($selectedCategory->slug ?? $selectedCategory->name)), 'lens');
@endphp

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
                            <select name="category_id" id="productCategorySelect" class="form-control eo-input" required>
                                <option value="">Kategori seçiniz</option>

                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-slug="{{ $category->slug ?? '' }}" @selected(old('category_id', $product->category_id)
                                    == $category->id)
                                    >
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Marka</label>
                            <select name="brand_id" id="brandSelect" class="form-control eo-input">
                                <option value="">Marka seçiniz</option>

                                @foreach($brands as $brand)

                                <option
                                    value="{{ $brand->id }}"
                                    data-type="{{ $brand->type }}"
                                    @selected(old('brand_id', $product->brand_id) == $brand->id)
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

                        <fieldset id="eyewearFields" class="col-12" @if($isLensCategory) style="display:none;" disabled @endif>
                            <div class="row">
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
                                        'metalik' => 'Metalik',
                                        'havana' => 'Havana',
                                        'pudra' => 'Pudra',
                                        'rose_gold' => 'Rose Gold',
                                        'bordo' => 'Bordo',
                                        'enjeksiyon' => 'Enjeksiyon',
                                        'titanyum' => 'Titanyum',
                                        'gri' => 'Gri',
                                        'pembe' => 'Pembe',
                                        'leopar_deseni' => 'Leopar Deseni',
                                        'kaplumbaga_kabugu' => 'Kaplumbağa Kabuğu',
                                        'seffaf_bej' => 'Şeffaf Bej',
                                        'siyah_sari_mermer' => 'Siyah Sarı Mermer',
                                        'col_kaplumbaga_kabugu' => 'Çöl Kaplumbağa Kabuğu',
                                        'acik_pembe' => 'Açık Pembe',
                                        'opak_kum' => 'Opak Kum',
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
                                        'fume_degrade' => 'Füme Degrade',
                                        'saydam' => 'Şeffaf',
                                        'altin' => 'Altın',
                                        'gumus' => 'Gümüş',
                                        'kirmizi' => 'Kırmızı',
                                        'mavi' => 'Mavi',
                                        'yesil' => 'Yeşil',
                                        'pembe' => 'Pembe',
                                        'mor' => 'Mor',
                                        'sari' => 'Sarı',
                                        'kahverengi_degrade' => 'Kahverengi Degrade',
                                        'bordo' => 'Bordo',
                                        'turuncu' => 'Turuncu',
                                        'mavi_degrade' => 'Mavi Degrade',
                                        'mavi_aynali' => 'Mavi Aynalı',
                                        'silver_mirror' => 'Silver Mirror',
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
                                        'titanyum' => 'Titanyum',
                                        'metal' => 'Metal',
                                        'kemik' => 'Kemik',
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
                            </div>
                        </fieldset>

                        <fieldset id="lensFields" class="col-12" @if(! $isLensCategory) style="display:none;" disabled @endif>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Lens Derecesi</label>
                                    <input type="text" name="lens_degree" value="{{ old('lens_degree', $product->lens_degree) }}"
                                        class="form-control eo-input" placeholder="Numarasız, -0.50, +1.25">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Lens Tipi</label>
                                    <input type="text" name="lens_type" value="{{ old('lens_type', $product->lens_type) }}"
                                        class="form-control eo-input" placeholder="Renkli yumuşak kontakt lens">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Lens Rengi</label>
                                    <input type="text" class="form-control eo-input" value="Şeffaf" readonly>
                                    <input type="hidden" name="glass_color" value="seffaf">
                                </div>



                                <div class="col-md-6 form-group">
                                    <label>Ambalaj İçeriği</label>
                                    <input type="text" name="lens_package_content" value="{{ old('lens_package_content', $product->lens_package_content) }}"
                                        class="form-control eo-input" placeholder="1 kutuda 2 adet">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Su İçeriği</label>
                                    <input type="text" name="lens_water_content" value="{{ old('lens_water_content', $product->lens_water_content) }}"
                                        class="form-control eo-input" placeholder="%33">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Base Curve (BC)</label>
                                    <input type="text" name="lens_base_curve" value="{{ old('lens_base_curve', $product->lens_base_curve) }}"
                                        class="form-control eo-input" placeholder="8.60 mm">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Çap (Dia.)</label>
                                    <input type="text" name="lens_diameter" value="{{ old('lens_diameter', $product->lens_diameter) }}"
                                        class="form-control eo-input" placeholder="14.20 mm">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Lens Materyali</label>
                                    <input type="text" name="lens_material" value="{{ old('lens_material', $product->lens_material) }}"
                                        class="form-control eo-input" placeholder="Lotrafilcon B">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Merkez Kalınlığı</label>
                                    <input type="text" name="lens_center_thickness" value="{{ old('lens_center_thickness', $product->lens_center_thickness) }}"
                                        class="form-control eo-input" placeholder="0.08 mm @ -3.00D">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Oksijen Aktarılabilirliği</label>
                                    <input type="text" name="lens_oxygen_permeability" value="{{ old('lens_oxygen_permeability', $product->lens_oxygen_permeability) }}"
                                        class="form-control eo-input" placeholder="Dk/t:110, 138 @ -3.00D">
                                </div>
                            </div>
                        </fieldset>

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

            @if($isLensCategory)
            @if($product->exists)
            <div class="card eo-card">

                <div class="card-header eo-card-header">
                    <div>
                        <h3>
                            <i class="fas fa-clone"></i>
                            Derece Kopyalama
                        </h3>
                        <p>Her satıra derece ve stok yazıp ürünü çoğaltın.</p>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label>Derece | Stok</label>
                        <textarea name="degree_rows" class="form-control eo-input" rows="8"
                            placeholder="Numarasız|5&#10;-0.50|8&#10;-0.75|6&#10;+0.50|4"></textarea>
                        <small class="text-muted d-block mt-2">Her satır için format: derece|stok. Stok yazmazsanız kaynak ürünün stoğu kullanılır.</small>
                    </div>

                    <button type="submit" class="btn eo-btn-primary btn-block"
                        formaction="{{ route('admin.products.duplicate', $product) }}"
                        formmethod="POST" data-duplicate="1">
                        <i class="fas fa-clone"></i>
                        Dereceleri Oluştur
                    </button>

                </div>

            </div>
            @endif
            @endif

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

    .eo-section-label {
        margin: 10px 0 16px;
        padding: 10px 14px;
        border-radius: 14px;
        background: #eef4ff;
        color: #17375f;
        font-weight: 800;
        letter-spacing: -.2px;
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
        const categorySelect = document.getElementById('productCategorySelect');
        const brandSelect = document.getElementById('brandSelect');
        const eyewearFields = document.getElementById('eyewearFields');
        const lensFields = document.getElementById('lensFields');
        const input = document.getElementById('productImagesInput');
        const preview = document.getElementById('productImagesPreview');
        const form = input?.closest('form');
        const removedMainImageInput = document.getElementById('removedMainImageInput');
        const removedImageIdsContainer = document.getElementById('removedImageIds');
        let selectedFiles = [];

        function isLensCategory() {
            const option = categorySelect?.selectedOptions?.[0];
            const slug = (option?.dataset?.slug || option?.textContent || '').toLowerCase();
            return slug.includes('lens');
        }

        function toggleCategoryFields() {
            if (!eyewearFields || !lensFields) return;

            if (isLensCategory()) {
                eyewearFields.style.display = 'none';
                lensFields.style.display = '';
                // disable fieldsets (disables contained controls) and inputs as fallback
                try {
                    eyewearFields.disabled = true;
                } catch (e) {}
                try {
                    lensFields.disabled = false;
                } catch (e) {}
                Array.from(eyewearFields.querySelectorAll('input,select,textarea')).forEach(el => el.disabled = true);
                Array.from(lensFields.querySelectorAll('input,select,textarea')).forEach(el => el.disabled = false);
            } else {
                eyewearFields.style.display = '';
                lensFields.style.display = 'none';
                try {
                    eyewearFields.disabled = false;
                } catch (e) {}
                try {
                    lensFields.disabled = true;
                } catch (e) {}
                Array.from(eyewearFields.querySelectorAll('input,select,textarea')).forEach(el => el.disabled = false);
                Array.from(lensFields.querySelectorAll('input,select,textarea')).forEach(el => el.disabled = true);
            }
        }

        function filterBrands() {
            if (!brandSelect) return;

            const lensSelected = isLensCategory();

            Array.from(brandSelect.options).forEach(option => {

                if (!option.value) {
                    option.hidden = false;
                    return;
                }

                const type = option.dataset.type;

                if (lensSelected) {
                    option.hidden = type !== 'lens';
                } else {
                    option.hidden = type !== 'gozluk';
                }
            });

            const selectedOption = brandSelect.selectedOptions[0];

            if (
                selectedOption &&
                selectedOption.value &&
                selectedOption.hidden
            ) {
                brandSelect.value = '';
            }
        }

        const existingItems = Array.from(document.querySelectorAll('[data-existing-main], [data-existing-id]'));

        toggleCategoryFields();
        filterBrands();

        categorySelect?.addEventListener('change', function() {
            toggleCategoryFields();
            filterBrands();
        });

        // When submitting via the duplicate button, remove the method override so server sees POST
        document.querySelectorAll('button[data-duplicate]').forEach(btn => {
            btn.addEventListener('click', function() {
                const methodInput = form?.querySelector('input[name="_method"]');
                if (methodInput) {
                    methodInput.parentNode.removeChild(methodInput);
                }
            });
        });

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