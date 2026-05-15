@extends('frontend.layout')

@section('title', 'Eymen Optik | Hesabım')

@section('content')

<main class="account-page">

    <div class="container account-grid">

        <aside class="account-sidebar reveal">

            <div class="profile-card">
                <div class="profile-top">
                    <span class="profile-avatar">
                        {{ mb_substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </span>

                    <div>
                        <b>Merhaba, {{ auth()->user()->name ?? 'Kullanıcı' }}</b>
                        <span>Premium Üye</span>
                    </div>
                </div>

                <p>
                    Siparişlerini, favorilerini ve sana özel ürün önerilerini buradan yönetebilirsin.
                </p>
            </div>

            <nav class="side-menu">
                <a href="#overview" class="active">Genel Bakış <span>→</span></a>
                <a href="#orders">Siparişlerim <span>3</span></a>
                <a href="#favorites">Favorilerim <span>3</span></a>
                <a href="#products">Alışveriş <span>{{ $products->count() }}</span></a>
                <a href="#coupon">Kuponlarım <span>1</span></a>
            </nav>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="logout-btn" type="submit">
                    Çıkış Yap
                </button>
            </form>

        </aside>

        <section>

            <div class="welcome-card reveal" id="overview">

                <div>
                    <span class="eyebrow">
                        <i></i>
                        Giriş Başarılı
                    </span>

                    <h1>
                        Hoş geldin {{ auth()->user()->name ?? 'Kullanıcı' }},
                        <span>alışverişe devam edelim.</span>
                    </h1>

                    <p>
                        Senin için seçilen yeni sezon gözlükleri, favorilerini ve devam eden siparişlerini tek ekranda topladık.
                    </p>

                    <div class="hero-actions">
                        <a href="#products" class="account-btn dark">Ürünleri İncele →</a>
                        <a href="#orders" class="account-btn light">Siparişlerime Git</a>
                    </div>
                </div>

                <div class="welcome-product">
                    <img
                        src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?auto=format&fit=crop&w=900&q=85"
                        alt="Yeni sezon gözlük"
                    >

                    <div class="floating-badge">
                        <b>Yeni sezon önerisi</b>
                        <span>Royal Smoke • ₺2.899</span>
                    </div>
                </div>

            </div>

            <div class="stats-grid reveal">

                <div class="stat-card">
                    <div class="stat-icon">📦</div>
                    <b>3</b>
                    <span>Aktif sipariş</span>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">♡</div>
                    <b id="favoriteCount">3</b>
                    <span>Favori ürün</span>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">🎁</div>
                    <b>1</b>
                    <span>Aktif kupon</span>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">🛒</div>
                    <b id="miniCartCount">0</b>
                    <span>Sepette ürün</span>
                </div>

            </div>

            <div class="content-grid">

                <div class="panel reveal" id="orders">

                    <div class="panel-head">
                        <h2>Son Siparişler</h2>
                        <a href="#">Tümünü Gör</a>
                    </div>

                    <div class="order-list">

                        <div class="order-item">
                            <div class="order-icon">🕶️</div>

                            <div>
                                <b>#EO-1024 • Milano Black</b>
                                <span>12 Mayıs 2026 • ₺1.249</span>
                            </div>

                            <span class="status green">Teslim edildi</span>
                        </div>

                        <div class="order-item">
                            <div class="order-icon">👓</div>

                            <div>
                                <b>#EO-1025 • Classic Frame</b>
                                <span>15 Mayıs 2026 • ₺899</span>
                            </div>

                            <span class="status blue">Kargoda</span>
                        </div>

                        <div class="order-item">
                            <div class="order-icon">✨</div>

                            <div>
                                <b>#EO-1026 • Gold Edition</b>
                                <span>17 Mayıs 2026 • ₺2.499</span>
                            </div>

                            <span class="status gold">Hazırlanıyor</span>
                        </div>

                    </div>

                </div>

                <div class="panel reveal" id="coupon">

                    <div class="panel-head">
                        <h2>Kuponum</h2>
                        <a href="#">Detay</a>
                    </div>

                    <div class="coupon-card">
                        <div>
                            <h3>%15 ekstra indirim</h3>
                            <p>Yeni sezon seçili gözlüklerde kullanılabilir özel üye kuponu.</p>
                        </div>

                        <div class="coupon-code">
                            <span>EYEMEN15</span>
                            <button type="button" id="copyCoupon">Kopyala</button>
                        </div>
                    </div>

                </div>

            </div>

            <div class="section-title reveal">
                <div>
                    <h2>Kategoriler</h2>
                    <p>Hızlıca kategori seçip alışverişe devam et.</p>
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

            <div class="category-row reveal">

                @forelse($categories as $category)

                    <a href="{{ route('products.index') }}?category={{ $category->slug }}" class="category-card">
                        <div class="cat-icon">
                            {{ $categoryIcons[$category->slug] ?? '◦' }}
                        </div>

                        <b>{{ $category->name }}</b>

                        <span>{{ $category->products_count }} ürün</span>
                    </a>

                @empty

                    <div class="empty-box">
                        Henüz kategori bulunmuyor.
                    </div>

                @endforelse

            </div>

            <div class="section-title reveal" id="products">
                <div>
                    <h2>Sana Özel Öneriler</h2>
                    <p>Giriş yapan kullanıcı için önerilen ürün alanı.</p>
                </div>
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

                        <a href="{{ route('products.show', $product->slug) }}" class="product-img">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        </a>

                        <div class="product-body">

                            <div class="product-meta">
                                <span>{{ $product->category?->name ?? 'Ürün' }}</span>
                            </div>

                            <h3>{{ $product->name }}</h3>

                            <div class="specs">
                                <span>{{ $product->brand?->name ?? 'Eymen' }}</span>
                                <span>{{ $product->gender === 'unisex' ? 'Unisex' : ucfirst($product->gender) }}</span>
                                <span>{{ $product->stock > 0 ? 'Stokta' : 'Tükendi' }}</span>
                            </div>

                            <div class="price-row">
                                <span class="price">
                                    ₺{{ number_format($product->final_price, 0, ',', '.') }}
                                </span>

                                <button
                                    class="add-cart js-add-cart"
                                    type="button"
                                    data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}"
                                    data-price="{{ $product->final_price }}"
                                    data-img="{{ $product->image_url }}"
                                >
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

        </section>

    </div>

</main>

@endsection

@section('page_css')

<style>
    .account-page {
        padding: 34px 0 70px;
        background:
            radial-gradient(circle at 0% 0%, rgba(40,84,217,.08), transparent 32%),
            radial-gradient(circle at 100% 0%, rgba(199,154,58,.12), transparent 28%),
            #f4f6fb;
    }

    .account-grid {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 22px;
        align-items: start;
    }

    .account-sidebar {
        position: sticky;
        top: 112px;
        background: rgba(255,255,255,.88);
        border: 1px solid rgba(7,17,31,.09);
        border-radius: 32px;
        padding: 18px;
        box-shadow: 0 24px 70px rgba(7,17,31,.1);
        backdrop-filter: blur(20px);
    }

    .profile-card {
        padding: 18px;
        border-radius: 26px;
        background:
            radial-gradient(circle at 80% 0%, rgba(199,154,58,.25), transparent 32%),
            linear-gradient(135deg, #07111f, #17375f);
        color: white;
        margin-bottom: 16px;
    }

    .profile-top {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .profile-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2854d9, #c79a3a);
        color: white;
        display: grid;
        place-items: center;
        font-size: 17px;
        font-weight: 950;
        text-transform: uppercase;
    }

    .profile-card b {
        display: block;
        font-size: 16px;
        margin-bottom: 4px;
    }

    .profile-card span,
    .profile-card p {
        color: rgba(255,255,255,.68);
        font-size: 12px;
        font-weight: 800;
    }

    .profile-card p {
        line-height: 1.55;
        font-size: 13px;
    }

    .side-menu {
        display: grid;
        gap: 8px;
    }

    .side-menu a {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 13px 14px;
        border-radius: 17px;
        color: #394456;
        font-weight: 850;
        font-size: 14px;
        transition: .25s ease;
    }

    .side-menu a.active,
    .side-menu a:hover {
        background: #07111f;
        color: white;
    }

    .logout-btn {
        margin-top: 14px;
        width: 100%;
        border: 0;
        background: #fff0f0;
        color: #e33b3b;
        border-radius: 18px;
        padding: 13px;
        font-weight: 950;
        cursor: pointer;
    }

    .welcome-card {
        border-radius: 38px;
        padding: 32px;
        background:
            radial-gradient(circle at 86% 0%, rgba(199,154,58,.28), transparent 34%),
            radial-gradient(circle at 20% 80%, rgba(40,84,217,.18), transparent 34%),
            rgba(255,255,255,.9);
        border: 1px solid rgba(7,17,31,.09);
        box-shadow: 0 24px 70px rgba(7,17,31,.1);
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 26px;
        align-items: center;
        margin-bottom: 22px;
        overflow: hidden;
    }

    .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 9px 13px;
        border-radius: 999px;
        background: white;
        border: 1px solid rgba(7,17,31,.09);
        color: #07111f;
        font-size: 13px;
        font-weight: 900;
        margin-bottom: 17px;
    }

    .eyebrow i {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: #16a36b;
        box-shadow: 0 0 0 7px rgba(22,163,107,.12);
    }

    .welcome-card h1 {
        color: #07111f;
        font-size: clamp(34px, 4.5vw, 58px);
        line-height: 1;
        letter-spacing: -2.8px;
        margin-bottom: 14px;
    }

    .welcome-card h1 span {
        background: linear-gradient(135deg, #2854d9, #c79a3a);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .welcome-card p {
        color: #707b8d;
        line-height: 1.75;
        max-width: 620px;
        margin-bottom: 22px;
    }

    .hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .account-btn {
        border-radius: 18px;
        padding: 14px 20px;
        display: inline-flex;
        font-size: 14px;
        font-weight: 950;
    }

    .account-btn.dark {
        background: #07111f;
        color: white;
        box-shadow: 0 20px 44px rgba(7,17,31,.22);
    }

    .account-btn.light {
        background: white;
        color: #07111f;
        border: 1px solid rgba(7,17,31,.09);
    }

    .welcome-product {
        position: relative;
        min-height: 260px;
        border-radius: 30px;
        background: linear-gradient(180deg, #f8fafc, #e9eef7);
        overflow: hidden;
    }

    .welcome-product img {
        height: 260px;
        object-fit: cover;
    }

    .floating-badge {
        position: absolute;
        left: 18px;
        bottom: 18px;
        background: rgba(255,255,255,.86);
        border: 1px solid rgba(7,17,31,.09);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 13px 15px;
    }

    .floating-badge b {
        display: block;
        color: #07111f;
        margin-bottom: 3px;
    }

    .floating-badge span {
        color: #707b8d;
        font-size: 12px;
        font-weight: 850;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }

    .stat-card {
        background: rgba(255,255,255,.9);
        border: 1px solid rgba(7,17,31,.09);
        border-radius: 26px;
        padding: 18px;
    }

    .stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 17px;
        background: #eef2f8;
        display: grid;
        place-items: center;
        font-size: 22px;
        margin-bottom: 14px;
    }

    .stat-card b {
        display: block;
        color: #07111f;
        font-size: 25px;
        letter-spacing: -1.2px;
        margin-bottom: 4px;
    }

    .stat-card span {
        color: #707b8d;
        font-size: 13px;
        font-weight: 800;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 1.2fr .8fr;
        gap: 22px;
        margin-bottom: 22px;
    }

    .panel {
        background: rgba(255,255,255,.9);
        border: 1px solid rgba(7,17,31,.09);
        border-radius: 32px;
        padding: 22px;
    }

    .panel-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
    }

    .panel-head h2 {
        color: #07111f;
        font-size: 24px;
        letter-spacing: -1px;
    }

    .panel-head a {
        color: #2854d9;
        font-size: 13px;
        font-weight: 950;
    }

    .order-list {
        display: grid;
        gap: 12px;
    }

    .order-item {
        border: 1px solid rgba(7,17,31,.09);
        background: white;
        border-radius: 22px;
        padding: 14px;
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 13px;
        align-items: center;
    }

    .order-icon {
        width: 50px;
        height: 50px;
        border-radius: 18px;
        background: #eef2f8;
        display: grid;
        place-items: center;
        font-size: 22px;
    }

    .order-item b {
        display: block;
        color: #07111f;
        margin-bottom: 5px;
    }

    .order-item span {
        color: #707b8d;
        font-size: 13px;
        font-weight: 750;
    }

    .status {
        padding: 8px 10px;
        border-radius: 999px;
        font-size: 11px !important;
        font-weight: 950 !important;
        white-space: nowrap;
    }

    .status.green {
        background: rgba(22,163,107,.12);
        color: #16a36b;
    }

    .status.gold {
        background: rgba(199,154,58,.14);
        color: #9b741d;
    }

    .status.blue {
        background: rgba(40,84,217,.12);
        color: #2854d9;
    }

    .coupon-card {
        min-height: 252px;
        border-radius: 28px;
        padding: 22px;
        background:
            radial-gradient(circle at 100% 0%, rgba(199,154,58,.32), transparent 34%),
            linear-gradient(135deg, #07111f, #183b67);
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .coupon-card h3 {
        font-size: 32px;
        letter-spacing: -1.6px;
        line-height: 1.05;
        margin-bottom: 10px;
    }

    .coupon-card p {
        color: rgba(255,255,255,.68);
        line-height: 1.6;
        font-size: 14px;
    }

    .coupon-code {
        background: rgba(255,255,255,.13);
        border: 1px dashed rgba(255,255,255,.32);
        border-radius: 18px;
        padding: 13px;
        display: flex;
        justify-content: space-between;
        gap: 10px;
        font-weight: 950;
    }

    .coupon-code button {
        border: 0;
        background: transparent;
        color: white;
        cursor: pointer;
        font-weight: 950;
    }

    .section-title {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin: 26px 0 18px;
    }

    .section-title h2 {
        color: #07111f;
        font-size: 30px;
        letter-spacing: -1.4px;
    }

    .section-title p {
        color: #707b8d;
        font-size: 14px;
        font-weight: 700;
    }

    .category-row {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
        margin-bottom: 24px;
    }

    .category-card {
        background: rgba(255,255,255,.9);
        border: 1px solid rgba(7,17,31,.09);
        border-radius: 26px;
        padding: 17px;
        transition: .28s ease;
    }

    .category-card:hover {
        background: #07111f;
        color: white;
        transform: translateY(-6px);
    }

    .cat-icon {
        width: 48px;
        height: 48px;
        border-radius: 17px;
        background: #eef2f8;
        display: grid;
        place-items: center;
        font-size: 22px;
        margin-bottom: 16px;
    }

    .category-card:hover .cat-icon {
        background: rgba(255,255,255,.12);
    }

    .category-card b {
        display: block;
        margin-bottom: 5px;
        font-size: 15px;
    }

    .category-card span {
        color: #707b8d;
        font-size: 12px;
        font-weight: 850;
    }

    .category-card:hover span {
        color: rgba(255,255,255,.68);
    }

    .account-product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
    }

    .account-product-card {
        background: rgba(255,255,255,.9);
        border: 1px solid rgba(7,17,31,.09);
        border-radius: 30px;
        overflow: hidden;
        position: relative;
        transition: .32s ease;
        display: flex;
        flex-direction: column;
        min-height: 400px;
    }

    .account-product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 28px 70px rgba(7,17,31,.12);
    }

    .product-label {
        position: absolute;
        top: 14px;
        left: 14px;
        z-index: 3;
        padding: 8px 11px;
        border-radius: 999px;
        background: #07111f;
        color: white;
        font-size: 11px;
        font-weight: 950;
    }

    .heart-btn {
        position: absolute;
        top: 14px;
        right: 14px;
        z-index: 3;
        width: 38px;
        height: 38px;
        border: 1px solid rgba(7,17,31,.09);
        background: rgba(255,255,255,.9);
        border-radius: 14px;
        cursor: pointer;
    }

    .heart-btn.active,
    .heart-btn:hover {
        background: #fff0f5;
        color: #e11d48;
    }

    .product-img {
        height: 220px;
        background: linear-gradient(180deg, #f8fafc, #e9eef7);
        padding: 25px;
        overflow: hidden;
        display: block;
    }

    .product-img img {
        height: 100%;
        object-fit: contain;
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
        color: #707b8d;
        font-size: 12px;
        font-weight: 850;
        margin-bottom: 8px;
    }

    .product-body h3 {
        color: #07111f;
        font-size: 17px;
        letter-spacing: -.5px;
        margin-bottom: 11px;
    }

    .specs {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin-bottom: 14px;
    }

    .specs span {
        background: #eef2f8;
        color: #425066;
        border-radius: 999px;
        padding: 7px 9px;
        font-size: 11px;
        font-weight: 900;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-top: auto;
    }

    .price {
        font-size: 22px;
        font-weight: 950;
        color: #07111f;
        letter-spacing: -1px;
    }

    .add-cart {
        width: 46px;
        height: 46px;
        border: 0;
        border-radius: 16px;
        background: #07111f;
        color: white;
        font-size: 20px;
        cursor: pointer;
        transition: .28s ease;
    }

    .add-cart:hover {
        background: #c79a3a;
        transform: rotate(8deg) scale(1.06);
    }

    .empty-box {
        grid-column: 1 / -1;
        background: white;
        border-radius: 24px;
        padding: 30px;
        text-align: center;
        color: #707b8d;
    }

    @media(max-width: 1120px) {
        .account-grid,
        .welcome-card,
        .content-grid {
            grid-template-columns: 1fr;
        }

        .account-sidebar {
            position: relative;
            top: 0;
        }

        .side-menu {
            grid-template-columns: repeat(3, 1fr);
        }

        .stats-grid,
        .account-product-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .category-row {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media(max-width: 680px) {
        .side-menu,
        .stats-grid,
        .category-row,
        .account-product-grid {
            grid-template-columns: 1fr;
        }

        .welcome-card {
            padding: 23px;
            border-radius: 30px;
        }

        .section-title {
            display: block;
        }

        .order-item {
            grid-template-columns: auto 1fr;
        }

        .order-item .status {
            grid-column: 1 / -1;
            width: max-content;
        }
    }
</style>

@endsection

@section('page_js')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const miniCartCount = document.getElementById('miniCartCount');
        const favoriteCount = document.getElementById('favoriteCount');
        const copyCoupon = document.getElementById('copyCoupon');

        function updateMiniCartCount() {
            const cart = JSON.parse(localStorage.getItem('eymen_cart')) || [];
            const count = cart.reduce((sum, item) => sum + Number(item.qty || 0), 0);

            if (miniCartCount) {
                miniCartCount.textContent = count;
            }
        }

        document.addEventListener('click', function (e) {
            const heart = e.target.closest('.heart-btn');

            if (!heart) return;

            heart.classList.toggle('active');

            const total = document.querySelectorAll('.heart-btn.active').length;

            if (favoriteCount) {
                favoriteCount.textContent = total;
            }
        });

        copyCoupon?.addEventListener('click', function () {
            navigator.clipboard.writeText('EYEMEN15');
            copyCoupon.textContent = 'Kopyalandı';
        });

        updateMiniCartCount();

        document.addEventListener('click', function (e) {
            if (e.target.closest('.js-add-cart')) {
                setTimeout(updateMiniCartCount, 100);
            }
        });
    });
</script>

@endsection