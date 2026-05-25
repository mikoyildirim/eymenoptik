@extends('adminlte::page')

@section('title', 'Eymen Optik | Site Ayarları')

@section('content_header')
<div class="eo-settings-header">
    <div>
        <span class="eo-eyebrow">
            <i class="fas fa-cog"></i> Yönetim Ayarları
        </span>
        <h1>Site Ayarları</h1>
        <p>Temel iletişim bilgilerini ve kargo kurallarını buradan düzenleyin.</p>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="btn eo-btn-light">
        <i class="fas fa-arrow-left"></i> Panele Dön
    </a>
</div>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success eo-alert">
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
</div>
@endif

<div class="card eo-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.update') }}" class="eo-form">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Site Adı</label>
                    <input type="text" name="site_name" class="form-control eo-input" value="{{ old('site_name', $settings->site_name) }}" required>
                </div>

                <div class="col-md-6 form-group">
                    <label>Telefon</label>
                    <input type="text" name="phone" class="form-control eo-input" value="{{ old('phone', $settings->phone) }}">
                </div>

                <div class="col-md-6 form-group">
                    <label>E-posta</label>
                    <input type="email" name="email" class="form-control eo-input" value="{{ old('email', $settings->email) }}">
                </div>

                <div class="col-md-6 form-group">
                    <label>WhatsApp</label>
                    <input type="text" name="whatsapp" class="form-control eo-input" value="{{ old('whatsapp', $settings->whatsapp) }}">
                </div>

                <div class="col-md-6 form-group">
                    <label>Instagram</label>
                    <input type="text" name="instagram" class="form-control eo-input" value="{{ old('instagram', $settings->instagram) }}">
                </div>

                <div class="col-md-6 form-group">
                    <label>Facebook</label>
                    <input type="text" name="facebook" class="form-control eo-input" value="{{ old('facebook', $settings->facebook) }}">
                </div>

                <div class="col-12 form-group">
                    <label>Adres</label>
                    <textarea name="address" class="form-control eo-input" rows="3">{{ old('address', $settings->address) }}</textarea>
                </div>

                <div class="col-md-6 form-group">
                    <label>Ücretsiz Kargo Limiti (TL)</label>
                    <input type="number" step="0.01" min="0" name="shipping_free_threshold" class="form-control eo-input" value="{{ old('shipping_free_threshold', $settings->shipping_free_threshold) }}" required>
                </div>

                <div class="col-md-6 form-group">
                    <label>Kargo Ücreti (TL)</label>
                    <input type="number" step="0.01" min="0" name="shipping_cost" class="form-control eo-input" value="{{ old('shipping_cost', $settings->shipping_cost) }}" required>
                </div>
                
                <div class="col-12 form-group">
                    <label>Hakkımızda Metni</label>
                    <textarea name="about_text" class="form-control eo-input" rows="5">{{ old('about_text', $settings->about_text) }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn eo-btn-dark">
                    <i class="fas fa-save"></i> Kaydet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('css')
<style>
    .eo-settings-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        background: linear-gradient(135deg, #07111f, #17375f);
        color: #fff;
        border-radius: 24px;
        padding: 24px 28px;
        margin-bottom: 20px;
    }

    .eo-settings-header h1 {
        margin: 8px 0 6px;
        font-weight: 900;
        letter-spacing: -1px;
    }

    .eo-settings-header p {
        margin: 0;
        color: rgba(255, 255, 255, .72);
    }

    .eo-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .16);
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
    }

    .eo-card {
        border-radius: 22px;
        border: 1px solid rgba(7, 17, 31, .08);
        box-shadow: 0 18px 44px rgba(7, 17, 31, .06);
    }

    .eo-form label {
        font-weight: 700;
        color: #07111f;
    }

    .eo-form .form-control {
        border-radius: 14px;
        border-color: #dbe1ea;
        box-shadow: none;
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

    .eo-btn-dark,
    .eo-btn-light {
        border-radius: 14px;
        font-weight: 800;
        padding: 10px 16px;
    }

    .eo-btn-dark {
        background: #07111f;
        color: #fff;
    }

    .eo-btn-light {
        background: #fff;
        color: #07111f;
        border: 1px solid rgba(7, 17, 31, .08);
    }

    .eo-alert {
        border-radius: 16px;
        border: 0;
    }

    @media (max-width: 768px) {
        .eo-settings-header {
            display: block;
        }

        .eo-settings-header a {
            margin-top: 16px;
            display: inline-block;
        }
    }
</style>
@endsection