@extends('admin.layout')

@section('title', 'Sipariş Detayı')

@section('content_header')

<div class="eo-page-header">

    <div>

        <span class="eo-page-badge">
            <i class="fas fa-receipt"></i>
            Eymen Optik
        </span>

        <h1>#{{ $order->order_number }}</h1>

        <p>
            Sipariş detaylarını, müşteri bilgilerini ve sipariş durumunu yönetin.
        </p>

    </div>

    <a href="{{ route('admin.orders.index') }}" class="btn eo-btn-light">
        <i class="fas fa-arrow-left"></i>
        Siparişlere Dön
    </a>

</div>

@endsection

@section('content')

<div class="row">

    {{-- Sol Alan --}}
    <div class="col-lg-8">

        <div class="card eo-card">

            <div class="card-header eo-card-header">

                <div>

                    <h3>
                        <i class="fas fa-user"></i>
                        Müşteri Bilgileri
                    </h3>

                    <span>
                        Sipariş veren kullanıcı bilgileri
                    </span>

                </div>

            </div>

            <div class="card-body">
                <div class="eo-customer-box">
                    <div class="eo-avatar">
                        {{ strtoupper(substr($order->full_name,0,1)) }}
                    </div>
                    <div>
                        <h4>{{ $order->full_name }}</h4>

                        <span>Müşteri Hesabı</span>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="eo-info-box">
                            <label>
                                Telefon
                            </label>
                            <strong>
                                {{ $order->phone }}
                            </strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="eo-info-box">
                            <label>
                                Sipariş Tarihi
                            </label>
                            <strong>
                                {{ $order->created_at?->format('d.m.Y H:i') }}
                            </strong>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="eo-info-box">
                            <label>
                                Ödeme Durumu
                            </label>
                            <strong>
                                {{ $order->iyzico_paid ? 'Başarılı' : 'Başarısız' }}
                            </strong>
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="eo-info-box">
                            <label>
                                İyzico Ödeme ID
                            </label>
                            <strong>
                                {{ $order->iyzico_payment_id ?? '-' }}
                            </strong>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="eo-info-box">
                            <label>
                                Teslimat Adresi
                            </label>
                            <strong>
                                {{ $order->address }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card eo-card">
            <div class="card-header eo-card-header">
                <div>
                    <h3>
                        <i class="fas fa-box-open"></i>
                        Sipariş Ürünleri
                    </h3>
                    <span>
                        Siparişe eklenen ürünler
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead>
                            <tr>
                                <th class="order-col-product">Ürün</th>
                                <th class="order-col-qty">Adet</th>
                                <th class="order-col-price">Birim Fiyat</th>
                                <th class="order-col-total">Tutar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order->items as $item)
                            @php
                            $productDetailUrl = $item->product ? route('admin.products.show', $item->product) : null;
                            @endphp

                            <tr @if($productDetailUrl) class="eo-product-row" role="link" tabindex="0"
                                data-href="{{ $productDetailUrl }}" onclick="window.location.href = this.dataset.href"
                                onkeydown="if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); window.location.href = this.dataset.href; }"
                                @endif>
                                <td class="order-col-product">
                                    <div class="d-flex align-items-center" style="gap:12px">
                                        @if($item->product && $item->product->image_url)
                                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product_name }}"
                                            class="admin-order-thumb" />
                                        @else
                                        <div class="admin-order-thumb placeholder"></div>
                                        @endif

                                        <div>
                                            <strong>{{ $item->product_name }}</strong>

                                            @if($item->product_id)
                                            <div class="text-muted small">Ürün ID: {{ $item->product_id }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="order-col-qty">{{ $item->quantity }}</td>
                                <td class="order-col-price">{{ number_format($item->price, 2, ',', '.') }} ₺</td>
                                <td class="order-col-total"><strong>{{ number_format($item->total, 2, ',', '.') }}
                                        ₺</strong>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Bu sipariş için ürün kaydı bulunamadı.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Sağ Alan --}}
    <div class="col-lg-4">

        <div class="card eo-card">

            <div class="card-header eo-card-header">

                <div>

                    <h3>
                        <i class="fas fa-sync-alt"></i>
                        Sipariş Durumu
                    </h3>

                    <span>
                        Sipariş durumunu güncelleyin
                    </span>

                </div>

            </div>

            <div class="card-body">

                <div class="eo-status-preview">

                    @php

                    $statusClass = match($order->status){

                    'beklemede' => 'warning',
                    'hazirlaniyor' => 'info',
                    'kargoda' => 'primary',
                    'tamamlandi' => 'success',
                    'iptal' => 'danger',

                    default => 'secondary'

                    };

                    @endphp

                    <span class="badge badge-{{ $statusClass }} eo-status-badge">
                        {{ ucfirst($order->status) }}
                    </span>

                </div>

                <form method="POST" action="{{ route('admin.orders.status', $order) }}">

                    @csrf

                    <div class="form-group mt-4">

                        <label>
                            Durum Seçin
                        </label>

                        <select name="status" class="form-control eo-input">

                            <option value="beklemede" @selected($order->status == 'beklemede')
                                >
                                Beklemede
                            </option>

                            <option value="hazirlaniyor" @selected($order->status == 'hazirlaniyor')
                                >
                                Hazırlanıyor
                            </option>

                            <option value="kargoda" @selected($order->status == 'kargoda')
                                >
                                Kargoda
                            </option>

                            <option value="tamamlandi" @selected($order->status == 'tamamlandi')
                                >
                                Tamamlandı
                            </option>

                            <option value="iptal" @selected($order->status == 'iptal')
                                >
                                İptal
                            </option>

                        </select>

                    </div>

                    <button type="submit" class="btn eo-btn-primary btn-block mt-4">
                        <i class="fas fa-save"></i>
                        Siparişi Güncelle
                    </button>

                </form>

            </div>

        </div>

        <div class="card eo-card">

            <div class="card-header eo-card-header">

                <div>

                    <h3>
                        <i class="fas fa-money-bill-wave"></i>
                        Sipariş Özeti
                    </h3>

                    <span>
                        Ödeme ve sipariş bilgileri
                    </span>

                </div>

            </div>

            <div class="card-body">

                <div class="eo-summary-box">

                    <div>
                        <span>Toplam Tutar</span>
                        <strong>{{ number_format($order->total_price,2) }} ₺</strong>
                    </div>

                    <div class="mt-3">
                        <span>Ürün Sayısı</span>
                        <strong>{{ $order->items->count() }}</strong>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

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

    .eo-card {
        border: none;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(7, 17, 31, .08);
        margin-bottom: 20px;
    }

    .eo-card-header {
        padding: 24px 28px;
        border-bottom: 1px solid rgba(7, 17, 31, .06);
        background: #fff;
    }

    .eo-card-header h3 {
        font-size: 20px;
        font-weight: 900;
        margin: 0 0 8px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #07111f;
    }

    .eo-card-header span {
        color: #707b8d;
        font-size: 14px;
        font-weight: 600;
    }

    .eo-customer-box {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .eo-avatar {
        width: 70px;
        height: 70px;
        border-radius: 24px;
        background: linear-gradient(135deg, #2854d9, #c79a3a);
        display: grid;
        place-items: center;
        color: #fff;
        font-size: 22px;
        font-weight: 900;
        box-shadow: 0 16px 40px rgba(40, 84, 217, .22);
    }

    .eo-customer-box h4 {
        margin: 0 0 6px;
        font-size: 22px;
        font-weight: 900;
        color: #07111f;
    }

    .eo-customer-box span {
        color: #707b8d;
        font-weight: 700;
    }

    .eo-info-box {
        padding: 18px;
        border-radius: 20px;
        background: #f4f6fb;
        border: 1px solid rgba(7, 17, 31, .05);
    }

    .eo-info-box label {
        display: block;
        margin-bottom: 8px;
        color: #707b8d;
        font-size: 13px;
        font-weight: 700;
    }

    .eo-info-box strong {
        color: #07111f;
        font-size: 15px;
        font-weight: 900;
        line-height: 1.7;
    }

    .eo-product-row {
        cursor: pointer;
        transition: background-color .18s ease, transform .18s ease;
    }

    .eo-product-row:hover {
        background: rgba(40, 84, 217, .06);
    }

    .eo-product-row:focus {
        outline: none;
        background: rgba(40, 84, 217, .1);
        box-shadow: inset 0 0 0 2px rgba(40, 84, 217, .22);
    }

    .eo-status-preview {
        text-align: center;
    }

    .eo-status-badge {
        border-radius: 999px;
        padding: 10px 18px;
        font-size: 12px;
        font-weight: 900;
    }

    .eo-input {
        height: 50px;
        border-radius: 16px;
        border: 1px solid rgba(7, 17, 31, .09);
        font-weight: 700;
    }

    .eo-input:focus {
        border-color: rgba(40, 84, 217, .36);
        box-shadow: 0 0 0 4px rgba(40, 84, 217, .08);
    }

    .eo-summary-box {
        padding: 20px;
        border-radius: 22px;
        background:
            radial-gradient(circle at top right, rgba(199, 154, 58, .16), transparent 34%),
            #f4f6fb;
    }

    .eo-summary-box span {
        display: block;
        color: #707b8d;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .eo-summary-box strong {
        font-size: 28px;
        font-weight: 900;
        color: #07111f;
    }

    @media(max-width:768px) {

        .eo-page-header {
            flex-direction: column;
            align-items: flex-start;
            padding: 24px;
        }

    }

    .admin-order-thumb {
        width: 72px;
        height: 72px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid rgba(7, 17, 31, .06);
        box-shadow: 0 6px 18px rgba(7, 17, 31, .06);
        display: inline-block;
    }

    .admin-order-thumb.placeholder {
        background: #f4f6fb;
    }

    @media(max-width:768px) {
        .admin-order-thumb {
            width: 56px;

            /* Alignment for order table columns */
            .order-col-product {
                text-align: left;
            }

            .order-col-qty {
                text-align: center;
                width: 90px;
            }

            .order-col-price {
                text-align: right;
                width: 140px;
            }

            .order-col-total {
                text-align: right;
                width: 160px;
            }

            height: 56px
        }
    }
</style>

@endsection