@extends('frontend.layout')

@section('title', 'Hesabım | Eymen Optik')

@section('content')

<main class="account-page">

    <section class="account-hero">
        <div class="container">
            <div class="account-hero-box reveal">
                <div>
                    <span>HESABIM</span>

                    <h1>
                        Hoş geldin,<br>
                        {{ auth()->user()->name ?? 'Kullanıcı' }}
                    </h1>

                    <p>
                        Siparişlerini takip et, favorilerini yönet ve sana özel ürün önerilerini incele.
                    </p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="logout-btn">
                        Çıkış Yap
                    </button>
                </form>
            </div>
        </div>
    </section>

    <section class="account-content">
        <div class="container account-grid">

            <aside class="account-sidebar reveal">

                <div class="profile-card">
                    <div class="profile-avatar">
                        {{ mb_substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>

                    <h3>{{ auth()->user()->name ?? 'Kullanıcı' }}</h3>
                    <p>{{ auth()->user()->email ?? 'user@mail.com' }}</p>
                </div>

                <nav class="account-menu">
                    <a href="#overview" class="active">Genel Bakış</a>
                    <a href="#orders">Siparişlerim</a>
                    <a href="#categories">Kategoriler</a>
                    <a href="#products">Önerilen Ürünler</a>
                </nav>

            </aside>

            <div class="account-main">

                <div class="stats-grid reveal" id="overview">

                    <div class="stat-card">
                        <span>📦</span>
                        <b>{{ $activeOrdersCount }}</b>
                        <p>Aktif Sipariş</p>
                    </div>

                    <div class="stat-card stat-card-action" role="button" tabindex="0" data-open-drawer="favorites">
                        <span>♡</span>
                        <b id="favoriteCount">{{ $favoriteCount }}</b>
                        <p>Favori Ürün</p>
                    </div>

                    <!-- Kupon kartı kaldırıldı -->

                    <div class="stat-card stat-card-action" role="button" tabindex="0" data-open-drawer="cart">
                        <span>🛒</span>
                        <b id="miniCartCount">0</b>
                        <p>Sepette Ürün</p>
                    </div>

                </div>

                <div class="panel-grid">

                    <div class="account-panel reveal" id="orders">

                        <div class="panel-head">
                            <div>
                                <span>SİPARİŞLER</span>
                                <h2>Son Siparişler</h2>
                            </div>
                        </div>

                        <div id="ordersCardContent">

                            <div class="orders-loading" aria-hidden="true">
                                <div class="orders-spinner"></div>
                            </div>

                            <div class="order-list orders-fade">

                                @forelse($orders as $order)
                                @php
                                $firstItem = $order->items->first();
                                $statusClass = match($order->status) {
                                'tamamlandi' => 'delivered',
                                'kargoda' => 'cargo',
                                'hazirlaniyor', 'beklemede' => 'preparing',
                                'iptal' => 'preparing',
                                default => 'preparing'
                                };

                                $statusText = match($order->status) {
                                'tamamlandi' => 'Teslim Edildi',
                                'kargoda' => 'Kargoda',
                                'hazirlaniyor' => 'Hazırlanıyor',
                                'beklemede' => 'Beklemede',
                                'iptal' => 'İptal',
                                default => ucfirst($order->status)
                                };
                                @endphp

                                <div class="order-item">
                                    <div class="order-icon">🕶️</div>

                                    <div>
                                        <b>#{{ $order->order_number }} • {{ $firstItem->product_name ?? 'Sipariş' }}</b>
                                        <small>{{ $order->created_at->format('d F Y') }} • ₺{{ number_format($order->total_price, 0, ',', '.') }}</small>
                                    </div>

                                    <span class="status {{ $statusClass }}">{{ $statusText }}</span>
                                </div>

                                @empty

                                <div class="empty-box">
                                    Henüz sipariş bulunmuyor.
                                </div>

                                @endforelse

                            </div>

                            @if(method_exists($orders, 'hasPages') && $orders->hasPages())
                            <nav class="orders-pagination" aria-label="Sipariş sayfaları">
                                <ul class="pagination pagination-sm mb-0">
                                    <li class="page-item {{ $orders->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $orders->previousPageUrl() ?? '#' }}" aria-label="Previous" @if($orders->onFirstPage()) tabindex="-1" aria-disabled="true" @endif>
                                            <span aria-hidden="true">&lsaquo;</span>
                                        </a>
                                    </li>

                                    @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page === $orders->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                    @endforeach

                                    <li class="page-item {{ $orders->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $orders->nextPageUrl() ?? '#' }}" aria-label="Next" @if(!$orders->hasMorePages()) tabindex="-1" aria-disabled="true" @endif>
                                            <span aria-hidden="true">&rsaquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            @endif

                        </div>

                    </div>

                    <!-- Kupon paneli kaldırıldı -->

                </div>

                <div class="section-title reveal" id="categories">
                    <div>
                        <span>KATEGORİLER</span>
                        <h2>Kategorilere Göz At</h2>
                        <p>Hızlıca kategori seçip alışverişe devam edebilirsin.</p>
                    </div>
                </div>

                @php
                $categoryIcons = [
                'gunes-gozlugu' => '🕶️',
                'optik-cerceve' => '👓',
                'polarize-gozluk' => '😎',
                'luxury-seri' => '✨',
                'spor-gozluk' => '🏃',
                'cocuk-gozluk' => '🧒',
                ];
                @endphp

                <div class="category-grid reveal">

                    @forelse($categories as $category)

                    <a href="{{ route('products.index') }}" class="category-card js-top-category-link" data-category="{{ $category->slug }}">

                        <span>
                            {{ $categoryIcons[$category->slug] ?? '◦' }}
                        </span>

                        <h3>{{ $category->name }}</h3>

                        <p>{{ $category->products_count }} ürün</p>

                    </a>

                    @empty

                    <div class="empty-box">
                        Henüz kategori bulunmuyor.
                    </div>

                    @endforelse

                </div>

                <div class="section-title reveal" id="products">
                    <div>
                        <span>ÖNERİLENLER</span>
                        <h2>Sana Özel Ürünler</h2>
                        <p>Yeni sezon ve öne çıkan ürünleri inceleyebilirsin.</p>
                    </div>

                    <a href="{{ route('products.index') }}">
                        Tüm Ürünler →
                    </a>
                </div>

                <div class="account-product-grid">

                    @forelse($products as $product)

                    <article class="account-product-card reveal">

                        <span class="product-label">
                            {{ $product->is_featured ? 'Önerilen' : 'Yeni' }}
                        </span>

                        <button class="heart-btn" type="button">
                            ♡
                        </button>

                        <a href="{{ route('products.show', $product->slug) }}" class="product-image">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        </a>

                        <div class="product-body">

                            <div class="product-meta">
                                <span>{{ $product->category?->name ?? 'Ürün' }}</span>
                                <span>{{ $product->brand?->name ?? 'Eymen' }}</span>
                            </div>

                            <h3>{{ $product->name }}</h3>

                            <div class="specs">
                                <span>{{ $product->gender === 'unisex' ? 'Unisex' : ucfirst($product->gender) }}</span>
                                <span>{{ $product->stock > 0 ? 'Stokta' : 'Tükendi' }}</span>
                            </div>

                            <div class="price-row">
                                <div>
                                    <strong>
                                        ₺{{ number_format($product->final_price, 0, ',', '.') }}
                                    </strong>

                                    @if($product->discount_price)
                                    <small>
                                        ₺{{ number_format($product->price, 0, ',', '.') }}
                                    </small>
                                    @endif
                                </div>

                                <button
                                    class="add-cart js-add-cart"
                                    type="button"
                                    data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}"
                                    data-price="{{ $product->final_price }}"
                                    data-img="{{ $product->image_url }}"
                                    {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    +
                                </button>
                            </div>

                        </div>

                    </article>

                    @empty

                    <div class="empty-box">
                        Henüz ürün bulunmuyor.
                    </div>

                    @endforelse

                </div>

            </div>

        </div>
    </section>

</main>

@endsection

@section('page_css')

<style>
    .account-page {
        background: #f6f6f6;
        padding-bottom: 80px;
    }

    .account-hero {
        padding: 34px 0 24px;

        .account-panel.is-loading {
            opacity: .65;
            pointer-events: none;
        }
    }

    .account-hero-box {
        min-height: 320px;
        background:
            linear-gradient(90deg, rgba(0, 0, 0, .72), rgba(0, 0, 0, .18)),
            url('https://images.unsplash.com/photo-1572635196237-14b3f281503f?auto=format&fit=crop&w=1800&q=90');
        background-size: cover;
        background-position: center;
        color: #fff;
        padding: 50px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 30px;
    }

    .account-hero-box span {
        display: inline-block;
        background: #fff;
        color: #000;
        padding: 9px 15px;
        font-size: 12px;
        font-weight: 900;
        margin-bottom: 20px;
    }

    .account-hero-box h1 {
        font-size: clamp(44px, 6vw, 82px);
        line-height: .92;
        letter-spacing: -4px;
        margin-bottom: 18px;
    }

    .account-hero-box p {
        color: rgba(255, 255, 255, .78);
        max-width: 620px;
        line-height: 1.8;
    }

    .logout-btn {
        height: 50px;
        padding: 0 26px;
        border: 0;
        background: #fff;
        color: #000;
        font-weight: 900;
        cursor: pointer;
    }

    .account-grid {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 24px;
        align-items: start;
    }

    .account-sidebar {
        position: sticky;
        top: 120px;
        background: #fff;
        border: 1px solid #eee;
        padding: 20px;
        box-shadow: 0 18px 45px rgba(0, 0, 0, .05);
    }

    .profile-card {
        text-align: center;
        padding: 24px 18px;
        background: #f7f7f7;
        margin-bottom: 18px;
    }

    .profile-avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #000;
        color: #fff;
        display: grid;
        place-items: center;
        margin: 0 auto 16px;
        font-size: 28px;
        font-weight: 900;
        text-transform: uppercase;
    }

    .profile-card h3 {
        font-size: 19px;
        margin-bottom: 6px;
    }

    .profile-card p {
        color: #777;
        font-size: 13px;
        word-break: break-word;
    }

    .account-menu {
        display: grid;
        gap: 8px;
    }

    .account-menu a {
        padding: 14px 15px;
        background: #fff;
        border: 1px solid #eee;
        font-size: 14px;
        font-weight: 800;
        transition: .22s ease;

        .orders-loading {
            display: none;
            align-items: center;
            justify-content: center;
            min-height: 120px;
            margin-bottom: 14px;
        }

        .orders-spinner {
            width: 34px;
            height: 34px;
            border: 3px solid #000;
            border-right-color: transparent;
            border-radius: 50%;
            animation: ordersSpin .8s linear infinite;
        }

        .account-panel.is-loading .orders-loading {
            display: flex;
        }

        .account-panel.is-loading .orders-fade {
            opacity: .25;
            transform: translateY(4px);
        }

        .orders-fade {
            transition: opacity .22s ease, transform .22s ease;
        }
    }

    .account-menu a.active,
    .account-menu a:hover {
        background: #000;
        color: #fff;
        border-color: #000;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid #eee;
        padding: 24px;
        transition: .25s ease;
    }

    .stat-card-action {
        cursor: pointer;
    }

    .stat-card-action:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 45px rgba(0, 0, 0, .06);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 45px rgba(0, 0, 0, .06);
    }

    .stat-card span {
        font-size: 28px;
        display: block;
        margin-bottom: 14px;
    }

    .stat-card b {
        display: block;
        font-size: 34px;
        line-height: 1;
        margin-bottom: 8px;
    }

    .stat-card p {
        color: #777;
        font-size: 13px;
        font-weight: 700;
    }

    .panel-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
        margin-bottom: 28px;
    }

    .account-panel {
        background: #fff;
        border: 1px solid #eee;
        padding: 32px;
        box-shadow: 0 18px 45px rgba(0, 0, 0, .04);
    }

    .panel-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 22px;
    }

    .panel-head span,
    .section-title span {
        color: #c79a3a;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 1px;
    }

    .panel-head h2,
    .section-title h2 {
        font-size: 34px;
        letter-spacing: -1.5px;
        margin-top: 6px;
    }

    .panel-head a,
    .section-title a {
        color: #000;
        font-weight: 900;
        font-size: 14px;
    }

    .order-list {
        display: grid;
        gap: 14px;
    }

    .orders-pagination {
        margin-top: 18px;
        display: flex;
        justify-content: center;
    }

    .orders-pagination .pagination {
        display: inline-flex;
        padding-left: 0;
        list-style: none;
        border-radius: .2rem;
        overflow: hidden;
        box-shadow: none;
    }

    .orders-pagination .page-item {
        margin-left: -1px;
    }

    .orders-pagination .page-link {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 32px;
        padding: 0 .6rem;
        border: 1px solid #dee2e6;
        background: #fff;
        color: #000;
        font-size: 13px;
        font-weight: 400;
        line-height: 1.25;
        text-decoration: none;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .orders-pagination .page-link:hover {
        z-index: 2;
        background: #000;
        color: #fff;
        border-color: #000;
    }

    .orders-pagination .page-item.active .page-link {
        z-index: 3;
        background: #000;
        color: #fff;
        border-color: #000;
    }

    .orders-pagination .page-item.disabled .page-link {
        color: #adb5bd;
        background: #fff;
        pointer-events: none;
        cursor: default;
    }

    .orders-pagination .page-link svg {
        display: block;
    }

    @keyframes ordersSpin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    @media(max-width: 680px) {
        .orders-pagination .page-link {
            min-width: 30px;
            height: 30px;
            padding: 0 .5rem;
            font-size: 12px;
        }
    }

    .order-item {
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 18px;
        align-items: center;
        background: #fafafa;
        border: 1px solid #eee;
        padding: 18px;
        border-radius: 8px;
    }

    .order-icon {
        width: 56px;
        height: 56px;
        background: #fff;
        display: grid;
        place-items: center;
        font-size: 26px;
        border-radius: 8px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.04);
    }

    .order-item b {
        display: block;
        margin-bottom: 5px;
    }

    .order-item small {
        color: #777;
        font-weight: 700;
    }

    .status {
        padding: 8px 11px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 900;
        white-space: nowrap;
    }

    .delivered {
        background: #e8fff4;
        color: #16a36b;
    }

    .cargo {
        background: #edf3ff;
        color: #2854d9;
    }

    .preparing {
        background: #fff7e5;
        color: #9b741d;
    }

    /* Kupon stilleri kaldırıldı */

    .section-title {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin: 34px 0 20px;
    }

    .section-title p {
        color: #777;
        margin-top: 6px;
    }

    .category-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
        margin-bottom: 30px;
    }

    .category-card {
        background: #fff;
        border: 1px solid #eee;
        padding: 22px;
        transition: .25s ease;
    }

    .category-card:hover {
        background: #000;
        color: #fff;
        transform: translateY(-6px);
    }

    .category-card span {
        width: 46px;
        height: 46px;
        background: #f1f1f1;
        display: grid;
        place-items: center;
        font-size: 22px;
        margin-bottom: 15px;
    }

    .category-card h3 {
        font-size: 17px;
        margin-bottom: 6px;
    }

    .category-card p {
        color: #777;
        font-size: 13px;
        font-weight: 700;
    }

    .category-card:hover p {
        color: rgba(255, 255, 255, .7);
    }

    .account-product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
    }

    .account-product-card {
        background: #fff;
        border: 1px solid #eee;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        min-height: 430px;
        transition: .28s ease;
    }

    .account-product-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 24px 70px rgba(0, 0, 0, .1);
    }

    .product-label {
        position: absolute;
        top: 14px;
        left: 14px;
        z-index: 3;
        background: #000;
        color: #fff;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 900;
    }

    .heart-btn {
        position: absolute;
        top: 14px;
        right: 14px;
        z-index: 3;
        width: 38px;
        height: 38px;
        border: 1px solid #eee;
        background: rgba(255, 255, 255, .9);
        cursor: pointer;
        font-size: 20px;
        transition: .22s ease;
    }

    .heart-btn.active,
    .heart-btn:hover {
        background: #000;
        color: #fff;
    }

    .product-image {
        height: 240px;
        background: #fafafa;
        padding: 28px;
        display: grid;
        place-items: center;
        overflow: hidden;
    }

    .product-image img {
        display: block;
        margin: 0 auto;
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        object-position: center;
        transition: .3s ease;
    }

    .account-product-card:hover .product-image img {
        transform: scale(1.07);
    }

    .product-body {
        padding: 18px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .product-meta {
        display: flex;
        justify-content: space-between;
        color: #888;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 9px;
    }

    .product-body h3 {
        font-size: 18px;
        line-height: 1.35;
        margin-bottom: 12px;
    }

    .specs {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin-bottom: 16px;
    }

    .specs span {
        background: #f1f1f1;
        padding: 7px 9px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 900;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-top: auto;
    }

    .price-row strong {
        display: block;
        font-size: 23px;
        color: #000;
        font-weight: 900;
    }

    .price-row small {
        color: #999;
        text-decoration: line-through;
        font-weight: 700;
    }

    .add-cart {
        width: 48px;
        height: 48px;
        border: 0;
        background: #000;
        color: #fff;
        font-size: 22px;
        font-weight: 900;
        cursor: pointer;
        transition: .25s ease;
    }

    .add-cart:hover {
        background: #c79a3a;
        transform: rotate(8deg) scale(1.05);
    }

    .add-cart:disabled {
        background: #aaa;
        cursor: not-allowed;
    }

    .empty-box {
        grid-column: 1 / -1;
        background: #fff;
        padding: 34px;
        text-align: center;
        color: #777;
        font-weight: 700;
    }

    @media(max-width: 1200px) {
        .account-grid {
            grid-template-columns: 1fr;
        }

        .account-sidebar {
            position: relative;
            top: 0;
        }

        .stats-grid,
        .account-product-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .panel-grid {
            grid-template-columns: 1fr;
        }

        .category-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media(max-width: 680px) {
        .account-hero-box {
            display: block;
            padding: 30px;
        }

        .account-hero-box h1 {
            font-size: 42px;
        }

        .logout-btn {
            margin-top: 22px;
        }

        .stats-grid,
        .category-grid,
        .account-product-grid {
            grid-template-columns: 1fr;
        }

        .order-item {
            grid-template-columns: auto 1fr;
        }

        .order-item .status {
            grid-column: 1 / -1;
            width: max-content;
        }

        .section-title,
        .panel-head {
            display: block;
        }
    }
</style>

@endsection

@section('page_js')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const miniCartCount = document.getElementById('miniCartCount');
        const favoriteCount = document.getElementById('favoriteCount');
        const ordersPanel = document.getElementById('orders');
        const favoritesOpenBtn = document.getElementById('favoritesOpenBtn');
        const cartOpenBtn = document.getElementById('cartOpenBtn');
        // coupon copy functionality removed

        function openDrawerFromCard(type) {
            if (type === 'favorites') {
                favoritesOpenBtn?.click();
                return;
            }

            if (type === 'cart') {
                cartOpenBtn?.click();
            }
        }

        document.querySelectorAll('.stat-card-action').forEach(card => {
            const trigger = () => openDrawerFromCard(card.dataset.openDrawer || '');

            card.addEventListener('click', trigger);
            card.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    trigger();
                }
            });
        });

        function updateMiniCartCount() {
            const cart = JSON.parse(localStorage.getItem('eymen_cart')) || [];
            const count = cart.reduce((sum, item) => sum + Number(item.qty || 0), 0);

            if (miniCartCount) {
                miniCartCount.textContent = count;
            }
        }

        document.addEventListener('click', function(e) {
            const heart = e.target.closest('.heart-btn');

            if (!heart) return;

            heart.classList.toggle('active');

            const total = document.querySelectorAll('.heart-btn.active').length;

            if (favoriteCount) {
                favoriteCount.textContent = total;
            }
        });

        // coupon copy functionality removed

        updateMiniCartCount();

        document.addEventListener('click', function(e) {
            if (e.target.closest('.js-add-cart')) {
                setTimeout(updateMiniCartCount, 100);
            }
        });

        document.addEventListener('click', async function(e) {
            const paginationLink = e.target.closest('.orders-pagination a');

            if (!paginationLink || paginationLink.getAttribute('aria-disabled') === 'true') {
                return;
            }

            e.preventDefault();

            const targetUrl = paginationLink.getAttribute('href');

            if (!targetUrl || targetUrl === '#') {
                return;
            }

            try {
                if (ordersPanel) {
                    ordersPanel.classList.add('is-loading');
                }

                const response = await fetch(targetUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html',
                    },
                });

                if (!response.ok) {
                    throw new Error('Pagination request failed');
                }

                const html = await response.text();
                const doc = new DOMParser().parseFromString(html, 'text/html');
                const nextOrdersContent = doc.getElementById('ordersCardContent');
                const currentOrdersContent = document.getElementById('ordersCardContent');

                if (nextOrdersContent && currentOrdersContent) {
                    currentOrdersContent.classList.remove('orders-fade');
                    void currentOrdersContent.offsetWidth;
                    currentOrdersContent.innerHTML = nextOrdersContent.innerHTML;
                    currentOrdersContent.classList.add('orders-fade');
                    window.history.pushState({}, '', targetUrl);
                }
            } catch (error) {
                window.location.href = targetUrl;
            } finally {
                if (ordersPanel) {
                    ordersPanel.classList.remove('is-loading');
                }
            }
        });

        window.addEventListener('popstate', async function() {
            const currentUrl = window.location.href;

            try {
                const response = await fetch(currentUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html',
                    },
                });

                if (!response.ok) {
                    return;
                }

                const html = await response.text();
                const doc = new DOMParser().parseFromString(html, 'text/html');
                const nextOrdersContent = doc.getElementById('ordersCardContent');
                const currentOrdersContent = document.getElementById('ordersCardContent');

                if (nextOrdersContent && currentOrdersContent) {
                    currentOrdersContent.classList.remove('orders-fade');
                    void currentOrdersContent.offsetWidth;
                    currentOrdersContent.innerHTML = nextOrdersContent.innerHTML;
                    currentOrdersContent.classList.add('orders-fade');
                }
            } catch (error) {
                window.location.reload();
            }
        });
    });
</script>

@endsection