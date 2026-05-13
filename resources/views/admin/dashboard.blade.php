@extends('adminlte::page')

@section('title', 'Eymen Optik | Yönetim Paneli')

@section('content_header')
<div class="eo-header">
    <div>
        <span class="eo-eyebrow">
            <i class="fas fa-gem"></i> Eymen Optik
        </span>
        <h1>Eymen Optik Yönetim Paneli</h1>
        <p>Ürün, kategori, marka ve sipariş süreçlerini tek ekrandan yönetin.</p>
    </div>

    <div class="eo-header-actions">
        <a href="{{ route('admin.products.create') }}" class="btn eo-btn-dark">
            <i class="fas fa-plus"></i> Yeni Ürün
        </a>
        <a href="{{ route('admin.orders.index') }}" class="btn eo-btn-light">
            <i class="fas fa-shopping-bag"></i> Siparişler
        </a>
    </div>
</div>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success eo-alert">
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
</div>
@endif

<div class="row">
    @php
        $cards = [
            [
                'title' => 'Ürünler',
                'count' => $productCount,
                'icon' => 'fas fa-glasses',
                'route' => 'admin.products.index',
                'class' => 'eo-card-blue',
                'text' => 'Mağazadaki tüm ürünler'
            ],
            [
                'title' => 'Kategoriler',
                'count' => $categoryCount,
                'icon' => 'fas fa-layer-group',
                'route' => 'admin.categories.index',
                'class' => 'eo-card-green',
                'text' => 'Kategori vitrinleri'
            ],
            [
                'title' => 'Markalar',
                'count' => $brandCount,
                'icon' => 'fas fa-tags',
                'route' => 'admin.brands.index',
                'class' => 'eo-card-gold',
                'text' => 'Marka yönetimi'
            ],
            [
                'title' => 'Siparişler',
                'count' => $orderCount,
                'icon' => 'fas fa-shopping-bag',
                'route' => 'admin.orders.index',
                'class' => 'eo-card-red',
                'text' => 'Satış ve teslimat takibi'
            ],
        ];
    @endphp

    @foreach($cards as $card)
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route($card['route']) }}" class="eo-stat-card {{ $card['class'] }}">
            <div class="eo-stat-top">
                <div>
                    <span>{{ $card['text'] }}</span>
                    <h3>{{ $card['count'] }}</h3>
                    <p>{{ $card['title'] }}</p>
                </div>
                <div class="eo-stat-icon">
                    <i class="{{ $card['icon'] }}"></i>
                </div>
            </div>
            <div class="eo-stat-bottom">
                Yönet <i class="fas fa-arrow-right"></i>
            </div>
        </a>
    </div>
    @endforeach
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card eo-card">
            <div class="card-header eo-card-header">
                <div>
                    <h3 class="card-title">
                        <i class="fas fa-receipt mr-2"></i>Son Siparişler
                    </h3>
                    <p>En güncel müşteri siparişleri</p>
                </div>

                <a href="{{ route('admin.orders.index') }}" class="eo-link">
                    Tümünü Gör <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table eo-table mb-0">
                        <thead>
                            <tr>
                                <th>Sipariş No</th>
                                <th>Müşteri</th>
                                <th>Tutar</th>
                                <th>Durum</th>
                                <th class="text-right">İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestOrders as $order)
                            <tr>
                                <td>
                                    <strong>{{ $order->order_number }}</strong>
                                </td>
                                <td>
                                    <div class="eo-user">
                                        <span>{{ strtoupper(mb_substr($order->full_name, 0, 1)) }}</span>
                                        <div>
                                            <b>{{ $order->full_name }}</b>
                                            <small>{{ $order->phone ?? 'Telefon yok' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>{{ number_format($order->total_price, 2) }} ₺</strong>
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($order->status) {
                                            'tamamlandi' => 'success',
                                            'kargoda' => 'info',
                                            'hazirlaniyor' => 'warning',
                                            'iptal' => 'danger',
                                            default => 'secondary'
                                        };
                                    @endphp

                                    <span class="badge badge-{{ $statusClass }} eo-badge">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm eo-btn-mini">
                                        Detay
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="eo-empty">
                                        <i class="fas fa-shopping-bag"></i>
                                        <h4>Henüz sipariş yok</h4>
                                        <p>Sipariş geldiğinde burada listelenecek.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="eo-side-panel">
            <div class="eo-side-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3>Mağaza Durumu</h3>
            <p>Eymen Optik ürün vitrini ve admin yönetimi aktif durumda.</p>

            <div class="eo-progress-item">
                <span>Ürün Yönetimi</span>
                <b>%100</b>
            </div>
            <div class="progress eo-progress">
                <div class="progress-bar" style="width:100%"></div>
            </div>

            <div class="eo-progress-item mt-3">
                <span>Sipariş Takibi</span>
                <b>%85</b>
            </div>
            <div class="progress eo-progress">
                <div class="progress-bar bg-warning" style="width:85%"></div>
            </div>

            <a href="{{ route('admin.products.create') }}" class="btn eo-btn-dark btn-block mt-4">
                <i class="fas fa-plus"></i> Ürün Ekle
            </a>
        </div>
    </div>
</div>

@endsection

@section('css')
<style>
    .content-wrapper {
        background:
            radial-gradient(circle at 0% 0%, rgba(40,84,217,.08), transparent 32%),
            radial-gradient(circle at 100% 0%, rgba(199,154,58,.12), transparent 28%),
            #f4f6fb;
    }

    .eo-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        background: linear-gradient(135deg, #07111f, #17375f);
        color: #fff;
        border-radius: 28px;
        padding: 28px;
        box-shadow: 0 24px 60px rgba(7,17,31,.18);
        margin-bottom: 8px;
    }

    .eo-header h1 {
        font-weight: 900;
        letter-spacing: -1.6px;
        margin: 8px 0 6px;
    }

    .eo-header p {
        color: rgba(255,255,255,.68);
        margin: 0;
    }

    .eo-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.18);
        padding: 8px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        color: rgba(255,255,255,.86);
    }

    .eo-header-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .eo-btn-dark,
    .eo-btn-light {
        border-radius: 14px;
        font-weight: 800;
        padding: 11px 16px;
    }

    .eo-btn-dark {
        background: #07111f;
        color: #fff;
        border: 1px solid rgba(255,255,255,.15);
    }

    .eo-btn-dark:hover {
        color: #fff;
        transform: translateY(-2px);
    }

    .eo-btn-light {
        background: #fff;
        color: #07111f;
        border: 1px solid rgba(7,17,31,.08);
    }

    .eo-alert {
        border-radius: 18px;
        border: 0;
        box-shadow: 0 14px 34px rgba(22,163,107,.12);
    }

    .eo-stat-card {
        display: block;
        color: #fff !important;
        border-radius: 26px;
        padding: 22px;
        min-height: 176px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 18px 45px rgba(7,17,31,.12);
        transition: .28s ease;
    }

    .eo-stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 28px 70px rgba(7,17,31,.18);
    }

    .eo-stat-card::after {
        content: "";
        position: absolute;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        right: -55px;
        top: -55px;
        background: rgba(255,255,255,.12);
    }

    .eo-card-blue { background: linear-gradient(135deg, #2854d9, #17375f); }
    .eo-card-green { background: linear-gradient(135deg, #16a36b, #0f5d45); }
    .eo-card-gold { background: linear-gradient(135deg, #c79a3a, #7b5a16); }
    .eo-card-red { background: linear-gradient(135deg, #e33b3b, #7a1724); }

    .eo-stat-top {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        position: relative;
        z-index: 2;
    }

    .eo-stat-top span {
        color: rgba(255,255,255,.7);
        font-size: 13px;
        font-weight: 700;
    }

    .eo-stat-top h3 {
        font-size: 42px;
        font-weight: 900;
        letter-spacing: -1.5px;
        margin: 8px 0 0;
    }

    .eo-stat-top p {
        margin: 0;
        color: rgba(255,255,255,.88);
        font-weight: 800;
    }

    .eo-stat-icon {
        width: 58px;
        height: 58px;
        border-radius: 20px;
        display: grid;
        place-items: center;
        background: rgba(255,255,255,.14);
        border: 1px solid rgba(255,255,255,.18);
        font-size: 24px;
    }

    .eo-stat-bottom {
        position: absolute;
        left: 22px;
        right: 22px;
        bottom: 18px;
        z-index: 2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: rgba(255,255,255,.76);
        font-weight: 800;
        font-size: 13px;
    }

    .eo-card,
    .eo-side-panel {
        border: 1px solid rgba(7,17,31,.08);
        border-radius: 26px;
        box-shadow: 0 18px 44px rgba(7,17,31,.07);
        overflow: hidden;
    }

    .eo-card-header {
        background: rgba(255,255,255,.9);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        border-bottom: 1px solid rgba(7,17,31,.08);
        padding: 20px 22px;
    }

    .eo-card-header h3 {
        font-weight: 900;
        color: #07111f;
    }

    .eo-card-header p {
        margin: 4px 0 0;
        color: #707b8d;
        font-size: 13px;
        font-weight: 600;
    }

    .eo-link {
        color: #2854d9;
        font-weight: 900;
        font-size: 13px;
    }

    .eo-table thead th {
        border-top: 0;
        border-bottom: 1px solid rgba(7,17,31,.08);
        color: #707b8d;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 16px;
    }

    .eo-table td {
        vertical-align: middle;
        padding: 16px;
        border-top: 1px solid rgba(7,17,31,.06);
    }

    .eo-user {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .eo-user > span {
        width: 38px;
        height: 38px;
        border-radius: 14px;
        background: linear-gradient(135deg, #2854d9, #c79a3a);
        color: #fff;
        display: grid;
        place-items: center;
        font-weight: 900;
    }

    .eo-user b {
        display: block;
        color: #07111f;
    }

    .eo-user small {
        color: #707b8d;
        font-weight: 600;
    }

    .eo-badge {
        border-radius: 999px;
        padding: 8px 11px;
        font-size: 11px;
    }

    .eo-btn-mini {
        background: #eef2f8;
        color: #07111f;
        border-radius: 12px;
        font-weight: 800;
    }

    .eo-empty {
        text-align: center;
        padding: 46px 20px;
        color: #707b8d;
    }

    .eo-empty i {
        font-size: 38px;
        margin-bottom: 14px;
        color: #c79a3a;
    }

    .eo-empty h4 {
        color: #07111f;
        font-weight: 900;
    }

    .eo-side-panel {
        background:
            radial-gradient(circle at 100% 0%, rgba(199,154,58,.2), transparent 32%),
            #fff;
        padding: 24px;
    }

    .eo-side-icon {
        width: 64px;
        height: 64px;
        border-radius: 22px;
        background: linear-gradient(135deg, #07111f, #17375f);
        color: #fff;
        display: grid;
        place-items: center;
        font-size: 26px;
        margin-bottom: 18px;
    }

    .eo-side-panel h3 {
        color: #07111f;
        font-weight: 900;
        letter-spacing: -1px;
    }

    .eo-side-panel p {
        color: #707b8d;
        line-height: 1.7;
    }

    .eo-progress-item {
        display: flex;
        justify-content: space-between;
        color: #07111f;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .eo-progress {
        height: 9px;
        border-radius: 999px;
        background: #eef2f8;
    }

    .eo-progress .progress-bar {
        border-radius: 999px;
    }

    @media(max-width: 768px) {
        .eo-header {
            display: block;
            padding: 22px;
        }

        .eo-header-actions {
            margin-top: 18px;
        }

        .eo-card-header {
            display: block;
        }

        .eo-link {
            display: inline-block;
            margin-top: 10px;
        }
    }
</style>
@endsection