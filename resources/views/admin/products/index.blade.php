@extends('admin.layout')

@section('title', 'Ürün Yönetimi')

@section('content_header')
<div class="eo-page-header">

    <div>
        <span class="eo-page-badge">
            <i class="fas fa-glasses"></i>
            Eymen Optik
        </span>

        <h1>Ürün Yönetimi</h1>

        <p>
            Tüm ürünleri, stokları ve fiyatları tek panelden yönetin.
        </p>
    </div>

    <div class="eo-header-actions">
        <a href="{{ route('admin.products.create') }}" class="btn eo-btn-primary">
            <i class="fas fa-plus"></i>
            Yeni Ürün
        </a>
    </div>

</div>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success eo-alert-success">
    <i class="fas fa-check-circle"></i>
    {{ session('success') }}
</div>
@endif

<div class="card eo-card">

    <div class="card-header eo-card-header">

        <div>
            <h3>
                <i class="fas fa-box-open"></i>
                Ürün Listesi
            </h3>

            <span>
                Sistemde toplam
                <strong>{{ $products->total() ?? $products->count() }}</strong>
                ürün bulunuyor.
            </span>
        </div>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table eo-table mb-0">

                <thead>
                    <tr>
                        <th>Ürün</th>
                        <th>Kategori</th>
                        <th>Fiyat</th>
                        <th>İndirimli Fiyat</th>
                        <th>Stok</th>
                        <th>Durum</th>
                        <th class="text-right">İşlemler</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($products as $product)

                    <tr>

                        {{-- Ürün --}}
                        <td>
                            <div class="eo-product">

                                <div class="eo-product-image">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                </div>

                                <div class="eo-product-info">
                                    <strong>
                                        {{ $product->name }} / @if($product->lens_degree) {{ $product->lens_degree }} @endif
                                    </strong>

                                    <span>
                                        {{ $product->brand->name ?? 'Marka belirtilmedi' }}
                                    </span>

                                    <div class="eo-product-details">
                                        @if($product->lens_degree)
                                        <small class="text-muted d-block">
                                            Derece: {{ $product->lens_degree }}
                                        </small>
                                        @endif
                                        @if($product->glass_color && $product->category?->slug === 'lens')
                                        <small class="text-muted d-block">
                                            Renk: {{ $product->glass_color }}
                                        </small>
                                        @endif
                                    </div>

                                </div>

                            </div>
                        </td>

                        {{-- Kategori --}}
                        <td>
                            <span class="eo-category-badge">
                                {{ $product->category->name ?? '-' }}
                            </span>
                        </td>

                        {{-- Fiyat --}}
                        <td>
                            <div class="eo-price">
                                {{ number_format($product->price, 2) }} ₺
                            </div>
                        </td>

                        {{-- İndirimli Fiyat --}}
                        <!-- Eğer yoksa - göster -->
                        <td>
                            <div class="eo-price">
                                @if($product->discount_price)
                                {{ number_format($product->discount_price, 2) }} ₺
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </div>
                        </td>

                        {{-- Stok --}}
                        <td>

                            @if($product->stock > 10)

                            <span class="badge badge-success eo-stock-badge">
                                {{ $product->stock }} stok
                            </span>

                            @elseif($product->stock > 0)

                            <span class="badge badge-warning eo-stock-badge">
                                {{ $product->stock }} az stok
                            </span>

                            @else

                            <span class="badge badge-danger eo-stock-badge">
                                Tükendi
                            </span>

                            @endif

                        </td>

                        {{-- Durum --}}
                        <td>

                            @if($product->is_active)

                            <span class="badge badge-success eo-status-badge">
                                Aktif
                            </span>

                            @else

                            <span class="badge badge-secondary eo-status-badge">
                                Pasif
                            </span>

                            @endif

                        </td>

                        {{-- İşlemler --}}
                        <td class="text-right">

                            <div class="eo-actions">

                                <a href="{{ route('admin.products.edit', $product) }}" class="btn eo-btn-edit btn-sm">
                                    <i class="fas fa-pen"></i>
                                    Düzenle
                                </a>

                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                    onsubmit="return confirm('Ürün silinsin mi?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn eo-btn-delete btn-sm">
                                        <i class="fas fa-trash"></i>
                                        Sil
                                    </button>
                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6">

                            <div class="eo-empty">

                                <div class="eo-empty-icon">
                                    <i class="fas fa-glasses"></i>
                                </div>

                                <h4>Henüz ürün eklenmedi</h4>

                                <p>
                                    İlk ürününüzü ekleyerek mağazayı oluşturmaya başlayın.
                                </p>

                                <a href="{{ route('admin.products.create') }}" class="btn eo-btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Ürün Ekle
                                </a>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @if(method_exists($products, 'links'))

    <div class="card-footer eo-pagination">

        <div class="eo-pagination-links">
            {{ $products->links() }}
        </div>

        <div class="eo-pagination-meta">
            @if($products->total() > 0)
            Bu sayfada <strong>{{ $products->count() }}</strong> ürün listeleniyor.
            Toplam <strong>{{ $products->total() }}</strong> ürün var.
            @else
            Ürün bulunamadı.
            @endif
        </div>
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
        gap: 10px;
        box-shadow: 0 16px 34px rgba(40, 84, 217, .24);
    }

    .eo-btn-primary:hover {
        transform: translateY(-2px);
    }

    .eo-alert-success {
        border-radius: 18px;
        border: none;
        display: flex;
        align-items: center;
        gap: 10px;
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

    .eo-product {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 260px;
    }

    .eo-product-image {
        width: 72px;
        height: 58px;
        border-radius: 18px;
        overflow: hidden;
        background: #f4f6fb;
        box-shadow: 0 10px 24px rgba(7, 17, 31, .08);
    }

    .eo-product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .eo-product-info strong {
        display: block;
        font-size: 15px;
        font-weight: 900;
        color: #07111f;
        margin-bottom: 4px;
    }

    .eo-product-info span {
        font-size: 13px;
        color: #707b8d;
        font-weight: 700;
    }

    .eo-product-details {
        display: flex;
        gap: 12px;
        margin-top: 4px;
    }

    .eo-product-details small {
        color: #707b8d;
        font-size: 12px;
        font-weight: 500;
    }

    .eo-category-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 12px;
        border-radius: 999px;
        background: #eef2f8;
        color: #394456;
        font-size: 12px;
        font-weight: 900;
    }

    .eo-price {
        font-size: 16px;
        font-weight: 900;
        color: #07111f;
    }

    .eo-stock-badge,
    .eo-status-badge {
        border-radius: 999px;
        padding: 8px 12px;
        font-size: 11px;
        font-weight: 800;
    }

    .eo-actions {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        flex-wrap: wrap;
    }

    .eo-btn-edit {
        border: none;
        border-radius: 14px;
        background: rgba(199, 154, 58, .14);
        color: #8a651c;
        font-weight: 800;
        padding: 8px 14px;
    }

    .eo-btn-delete {
        border: none;
        border-radius: 14px;
        background: #fff0f0;
        color: #e33b3b;
        font-weight: 800;
        padding: 8px 14px;
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

    .eo-pagination-links {
        display: flex;
        justify-content: center;
    }

    .eo-pagination-meta {
        margin-top: 12px;
        text-align: center;
        color: #707b8d;
        font-size: 13px;
        font-weight: 600;
    }

    .eo-pagination-meta strong {
        color: #07111f;
        font-weight: 900;
    }

    @media(max-width:768px) {

        .eo-page-header {
            flex-direction: column;
            align-items: flex-start;
            padding: 24px;
        }

        .eo-actions {
            justify-content: flex-start;
        }

    }
</style>
@endsection