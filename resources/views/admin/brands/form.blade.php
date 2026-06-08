@extends('admin.layout')

@section('title', $brand->exists ? 'Marka Düzenle' : 'Marka Ekle')

@section('content_header')
<div class="eo-page-header">
    <div>
        <span class="eo-page-badge">
            <i class="fas fa-tags"></i>
            Eymen Optik
        </span>

        <h1>{{ $brand->exists ? 'Marka Düzenle' : 'Yeni Marka Ekle' }}</h1>

        <p>Ürünleri markalara göre sınıflandırmak için marka bilgilerini yönetin.</p>
    </div>

    <a href="{{ route('admin.brands.index') }}" class="btn eo-btn-light">
        <i class="fas fa-arrow-left"></i>
        Markalara Dön
    </a>
</div>
@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger eo-alert">
    <strong>Formda hata var.</strong>
    <ul class="mb-0 mt-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ $brand->exists ? route('admin.brands.update', $brand) : route('admin.brands.store') }}">
    @csrf

    @if($brand->exists)
    @method('PUT')
    @endif

    <div class="row">

        <div class="col-lg-8">
            <div class="card eo-card">
                <div class="card-header eo-card-header">
                    <div>
                        <h3>
                            <i class="fas fa-info-circle"></i>
                            Marka Bilgileri
                        </h3>
                        <p>Marka adı ve mağaza görünürlüğü</p>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label>Marka Adı</label>

                        <input type="text" name="name" value="{{ old('name', $brand->name) }}"
                            class="form-control eo-input" placeholder="Örn: Ray-Ban" required>
                    </div>

                    {{-- Marka Tipi Seçimi --}}
                    <div class="form-group mt-4">
                        <label class="eo-field-label">Marka Tipi</label>
                        <div class="eo-type-selector">
                            <input type="hidden" name="type" id="brand_type_hidden"
                                value="{{ old('type', $brand->type ?? 'gozluk') }}">

                            <button type="button"
                                class="eo-type-btn {{ old('type', $brand->type ?? 'gozluk') === 'gozluk' ? 'active' : '' }}"
                                data-value="gozluk" id="type_btn_gozluk">
                                <i class="fas fa-glasses"></i>
                                <span>Gözlük</span>
                            </button>

                            <button type="button"
                                class="eo-type-btn {{ old('type', $brand->type ?? 'gozluk') === 'lens' ? 'active' : '' }}"
                                data-value="lens" id="type_btn_lens">
                                <i class="fas fa-eye"></i>
                                <span>Lens</span>
                            </button>
                        </div>
                        <small class="text-muted" style="display:block;margin-top:8px;font-weight:600;">Markanın gözlük
                            mu yoksa lens mi sattığını belirtin.</small>
                    </div>

                    <label class="eo-check">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $brand->exists ? $brand->is_active : true))>

                        <span>
                            <b>Aktif Marka</b>
                            <small>Marka mağaza ve admin listelerinde aktif görünsün.</small>
                        </span>
                    </label>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card eo-card">
                <div class="card-header eo-card-header">
                    <div>
                        <h3>
                            <i class="fas fa-eye"></i>
                            Önizleme
                        </h3>
                        <p>Markanın panel görünümü</p>
                    </div>
                </div>

                <div class="card-body">

                    <div class="eo-preview-card">
                        <div class="eo-preview-icon">
                            <i class="fas fa-tag"></i>
                        </div>

                        <div>
                            <h4>{{ old('name', $brand->name) ?: 'Marka Adı' }}</h4>
                            <span>
                                @php $t = old('type', $brand->type ?? 'gozluk'); @endphp
                                {{ $brand->exists ? 'Mevcut marka' : 'Yeni marka' }} &mdash;
                                <span
                                    id="preview_type_label">{{ $t === 'lens' ? 'Lens markası' : 'Gözlük markası' }}</span>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn eo-btn-primary btn-block mt-4">
                        <i class="fas fa-save"></i>
                        {{ $brand->exists ? 'Değişiklikleri Kaydet' : 'Markayı Kaydet' }}
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

    .eo-input {
        height: 48px;
        border-radius: 15px;
        border: 1px solid rgba(7, 17, 31, .09);
        font-weight: 650;
    }

    .eo-input:focus {
        border-color: rgba(40, 84, 217, .38);
        box-shadow: 0 0 0 4px rgba(40, 84, 217, .08);
    }

    .eo-check {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 15px;
        border-radius: 18px;
        background: #f4f6fb;
        margin-top: 18px;
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

    .eo-preview-card {
        padding: 20px;
        border-radius: 24px;
        background:
            radial-gradient(circle at top right, rgba(199, 154, 58, .16), transparent 34%),
            #f4f6fb;
        border: 1px solid rgba(7, 17, 31, .06);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .eo-preview-icon {
        width: 58px;
        height: 58px;
        border-radius: 20px;
        background: linear-gradient(135deg, #2854d9, #17375f);
        color: #fff;
        display: grid;
        place-items: center;
        font-size: 20px;
    }

    .eo-preview-card h4 {
        margin: 0 0 5px;
        color: #07111f;
        font-weight: 900;
    }

    .eo-preview-card span {
        color: #707b8d;
        font-size: 13px;
        font-weight: 700;
    }

    .eo-alert {
        border-radius: 18px;
        border: none;
    }

    .eo-field-label {
        font-size: 14px;
        font-weight: 800;
        color: #07111f;
        margin-bottom: 10px;
        display: block;
    }

    .eo-type-selector {
        display: flex;
        gap: 12px;
    }

    .eo-type-btn {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 18px 12px;
        border-radius: 18px;
        border: 2px solid rgba(7, 17, 31, .09);
        background: #f4f6fb;
        color: #707b8d;
        font-weight: 800;
        font-size: 15px;
        cursor: pointer;
        transition: all .2s ease;
    }

    .eo-type-btn i {
        font-size: 24px;
    }

    .eo-type-btn:hover {
        border-color: rgba(40, 84, 217, .3);
        background: rgba(40, 84, 217, .05);
        color: #2854d9;
        transform: translateY(-2px);
    }

    .eo-type-btn.active {
        border-color: #2854d9;
        background: linear-gradient(135deg, rgba(40, 84, 217, .10), rgba(23, 55, 95, .08));
        color: #2854d9;
        box-shadow: 0 8px 24px rgba(40, 84, 217, .14);
    }

    .eo-type-btn.active i {
        filter: drop-shadow(0 0 6px rgba(40, 84, 217, .4));
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
        const hidden = document.getElementById('brand_type_hidden');
        const buttons = document.querySelectorAll('.eo-type-btn');
        const preview = document.getElementById('preview_type_label');
        const nameInput = document.querySelector('input[name="name"]');
        const previewName = document.querySelector('.eo-preview-card h4');

        const labels = {
            gozluk: 'Gözlük markası',
            lens: 'Lens markası'
        };

        // Marka adı yazıldıkça önizleme başlığını güncelle
        if (nameInput && previewName) {
            nameInput.addEventListener('input', function() {
                previewName.textContent = this.value.trim() || 'Marka Adı';
            });
        }

        // Gözlük / Lens seçim butonları
        buttons.forEach(function(btn) {
            btn.addEventListener('click', function() {
                const val = this.dataset.value;

                // Hidden input güncelle
                hidden.value = val;

                // Aktif butonu değiştir
                buttons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                // Önizleme etiketi güncelle
                if (preview) preview.textContent = labels[val] || '';
            });
        });
    });
</script>
@endsection