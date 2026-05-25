@extends('admin.layout')

@section('title', 'Sipariş Yönetimi')

@section('content_header')

<div class="eo-page-header">

    <div>

        <span class="eo-page-badge">
            <i class="fas fa-shopping-bag"></i>
            Eymen Optik
        </span>

        <h1>Sipariş Yönetimi</h1>

        <p>
            Tüm siparişleri, müşteri bilgilerini ve ödeme durumlarını yönetin.
        </p>

    </div>

</div>

@endsection

@section('content')

@php
$statusLabels = [
'beklemede' => 'Beklemede',
'hazirlaniyor' => 'Hazırlanıyor',
'kargoda' => 'Kargoda',
'tamamlandi' => 'Tamamlandı',
'iptal' => 'İptal',
];
@endphp

<div class="card eo-card">

    <div class="card-header eo-card-header">

        <div>

            <h3>
                <i class="fas fa-receipt"></i>
                Sipariş Listesi
            </h3>

            <span>
                Toplam
                <strong>{{ $orders->total() ?? $orders->count() }}</strong>
                sipariş bulunuyor.
            </span>

        </div>

    </div>

    <div class="eo-filter-bar">

        <form method="GET" action="{{ route('admin.orders.index') }}" class="eo-orders-filter">

            <input type="text" name="search" value="{{ $search ?? request('search') }}"
                class="form-control eo-input eo-filter-input" placeholder="Sipariş no, müşteri, telefon, e-posta">

            <select name="status" class="form-control eo-input eo-filter-select">

                <option value="">Tüm durumlar</option>

                @foreach($statusOptions as $status)
                <option value="{{ $status }}" @selected(($selectedStatus ?? request('status'))===$status)>
                    {{ $statusLabels[$status] ?? ucfirst($status) }}
                </option>
                @endforeach

            </select>

            <div class="eo-filter-actions">
                <button type="submit" class="btn eo-btn-primary">
                    <i class="fas fa-search"></i>
                    Filtrele
                </button>
                <a href="{{ route('admin.orders.index') }}" class="btn eo-btn-light">
                    <i class="fas fa-times"></i>
                    Temizle
                </a>
            </div>
        </form>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table eo-table mb-0">

                <thead>

                    <tr>
                        <th>Sipariş</th>
                        <th>Müşteri</th>
                        <th>Telefon</th>
                        <th>Tutar</th>
                        <th>Durum</th>
                        <th>Tarih</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($orders as $order)

                    @php
                    $detailUrl = route('admin.orders.show', $order);
                    @endphp

                    <tr class="eo-order-row" role="link" tabindex="0" data-href="{{ $detailUrl }}"
                        onclick="window.location.href = this.dataset.href"
                        onkeydown="if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); window.location.href = this.dataset.href; }">

                        {{-- Sipariş --}}
                        <td>

                            <div class="eo-order-box">

                                <div class="eo-order-icon">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>

                                <div>

                                    <strong>
                                        #{{ $order->order_number }}
                                    </strong>

                                    <span>
                                        Sipariş No
                                    </span>

                                </div>

                            </div>

                        </td>

                        {{-- Müşteri --}}
                        <td>

                            <div class="eo-customer">

                                <div class="eo-avatar">
                                    {{ strtoupper(substr($order->full_name,0,1)) }}
                                </div>

                                <div>

                                    <strong>
                                        {{ $order->full_name }}
                                    </strong>

                                    <span>
                                        Müşteri
                                    </span>

                                </div>

                            </div>

                        </td>

                        {{-- Telefon --}}
                        <td>

                            <div class="eo-phone">
                                {{ $order->phone }}
                            </div>

                        </td>

                        {{-- Tutar --}}
                        <td>

                            <div class="eo-price">
                                {{ number_format($order->total_price,2) }} ₺
                            </div>

                        </td>

                        {{-- Durum --}}
                        <td>

                            @php

                            $statusClass = match($order->status){

                            'hazirlaniyor' => 'warning',
                            'kargoda' => 'info',
                            'tamamlandi' => 'success',
                            'iptal' => 'danger',

                            default => 'secondary'

                            };

                            @endphp

                            <span class="badge badge-{{ $statusClass }} eo-status-badge">

                                {{ ucfirst($order->status) }}

                            </span>

                        </td>

                        {{-- Tarih --}}
                        <td>

                            <div class="eo-date">

                                {{ $order->created_at?->format('d.m.Y') }}

                                <span>
                                    {{ $order->created_at?->format('H:i') }}
                                </span>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6">

                            <div class="eo-empty">

                                <div class="eo-empty-icon">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>

                                <h4>Henüz sipariş bulunmuyor</h4>

                                <p>
                                    Yeni siparişler geldiğinde burada listelenecek.
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @if(method_exists($orders, 'links'))

    <div class="card-footer eo-pagination">
        {{ $orders->links() }}
    </div>

    @endif

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

    .eo-card {
        border: none;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(7, 17, 31, .08);
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

    .eo-filter-bar {
        padding: 18px 28px 0;
    }

    .eo-orders-filter {
        display: grid;
        grid-template-columns: minmax(260px, 1.4fr) minmax(180px, .9fr) auto;
        gap: 10px;
        align-items: center;
    }

    .eo-filter-input,
    .eo-filter-select {
        min-height: 48px;
        border-radius: 14px;
        border: 1px solid rgba(7, 17, 31, .08);
        box-shadow: none;
        background: #fff;
        font-weight: 700;
    }

    .eo-filter-input::placeholder {
        color: #8a94a6;
        font-weight: 600;
    }

    .eo-filter-actions {
        display: flex;
        gap: 10px;
        flex-wrap: nowrap;
        align-items: center;
    }

    .eo-filter-actions .eo-btn-primary,
    .eo-filter-actions .eo-btn-light {
        height: 48px;
        padding: 0 18px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .eo-order-row {
        cursor: pointer;
        transition: background-color .18s ease, transform .18s ease;
    }

    .eo-order-row:hover {
        background: rgba(199, 154, 58, .08);
    }

    .eo-order-row:focus {
        outline: none;
        background: rgba(199, 154, 58, .12);
        box-shadow: inset 0 0 0 2px rgba(199, 154, 58, .28);
    }

    .eo-table thead th {
        border-top: none;
        border-bottom: 1px solid rgba(7, 17, 31, .06);
        padding: 18px;
        color: #707b8d;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .eo-table td {
        padding: 18px;
        vertical-align: middle;
        border-top: 1px solid rgba(7, 17, 31, .05);
    }

    .eo-order-box {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 180px;
    }

    .eo-order-icon {
        width: 54px;
        height: 54px;
        border-radius: 18px;
        background: linear-gradient(135deg, #2854d9, #17375f);
        display: grid;
        place-items: center;
        color: #fff;
        font-size: 18px;
        box-shadow: 0 12px 30px rgba(40, 84, 217, .20);
    }

    .eo-order-box strong {
        display: block;
        color: #07111f;
        font-size: 15px;
        font-weight: 900;
        margin-bottom: 4px;
    }

    .eo-order-box span {
        color: #707b8d;
        font-size: 13px;
        font-weight: 700;
    }

    .eo-customer {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 220px;
    }

    .eo-avatar {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        background: linear-gradient(135deg, #2854d9, #c79a3a);
        display: grid;
        place-items: center;
        color: #fff;
        font-weight: 900;
        font-size: 16px;
        box-shadow: 0 12px 30px rgba(40, 84, 217, .18);
    }

    .eo-customer strong {
        display: block;
        color: #07111f;
        font-size: 15px;
        font-weight: 900;
        margin-bottom: 4px;
    }

    .eo-customer span {
        color: #707b8d;
        font-size: 13px;
        font-weight: 700;
    }

    .eo-phone {
        font-weight: 800;
        color: #07111f;
    }

    .eo-price {
        font-size: 16px;
        font-weight: 900;
        color: #07111f;
    }

    .eo-status-badge {
        border-radius: 999px;
        padding: 8px 12px;
        font-size: 11px;
        font-weight: 800;
    }

    .eo-date {
        font-weight: 800;
        color: #07111f;
    }

    .eo-date span {
        display: block;
        margin-top: 4px;
        color: #707b8d;
        font-size: 12px;
        font-weight: 700;
    }

    .eo-empty {
        padding: 60px 20px;
        text-align: center;
    }

    .eo-empty-icon {
        width: 82px;
        height: 82px;
        border-radius: 26px;
        margin: 0 auto 20px;
        display: grid;
        place-items: center;
        font-size: 28px;
        color: #fff;
        background: linear-gradient(135deg, #2854d9, #17375f);
        box-shadow: 0 20px 50px rgba(40, 84, 217, .24);
    }

    .eo-empty h4 {
        font-size: 24px;
        font-weight: 900;
        margin-bottom: 10px;
        color: #07111f;
    }

    .eo-empty p {
        color: #707b8d;
        margin-bottom: 24px;
    }

    .eo-pagination {
        background: #fff;
        border-top: 1px solid rgba(7, 17, 31, .06);
        padding: 20px;
    }

    @media(max-width:768px) {

        .eo-page-header {
            flex-direction: column;
            align-items: flex-start;
            padding: 24px;
        }

        .eo-filter-bar {
            padding: 16px 18px 0;
        }

        .eo-orders-filter {
            width: 100%;
            grid-template-columns: 1fr;
        }

        .eo-filter-actions {
            flex-direction: row;
        }

        .eo-filter-actions .btn {
            width: auto;
            flex: 1 1 0;
        }

    }
</style>

@endsection