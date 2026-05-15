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
                    <a href="#coupon">Kuponlarım</a>
                </nav>

            </aside>

            <div class="account-main">

                <div class="stats-grid reveal" id="overview">

                    <div class="stat-card">
                        <span>📦</span>
                        <b>3</b>
                        <p>Aktif Sipariş</p>
                    </div>

                    <div class="stat-card">
                        <span>♡</span>
                        <b id="favoriteCount">0</b>
                        <p>Favori Ürün</p>
                    </div>

                    <div class="stat-card">
                        <span>🎁</span>
                        <b>1</b>
                        <p>Aktif Kupon</p>
                    </div>

                    <div class="stat-card">
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

                            <a href="#">Tümünü Gör</a>
                        </div>

                        <div class="order-list">

                            <div class="order-item">
                                <div class="order-icon">🕶️</div>

                                <div>
                                    <b>#EO-1024 • Milano Black</b>
                                    <small>12 Mayıs 2026 • ₺1.249</small>
                                </div>

                                <span class="status delivered">Teslim Edildi</span>
                            </div>

                            <div class="order-item">
                                <div class="order-icon">👓</div>

                                <div>
                                    <b>#EO-1025 • Classic Frame</b>
                                    <small>15 Mayıs 2026 • ₺899</small>
                                </div>

                                <span class="status cargo">Kargoda</span>
                            </div>

                            <div class="order-item">
                                <div class="order-icon">✨</div>

                                <div>
                                    <b>#EO-1026 • Gold Edition</b>
                                    <small>17 Mayıs 2026 • ₺2.499</small>
                                </div>

                                <span class="status preparing">Hazırlanıyor</span>
                            </div>

                        </div>

                    </div>

                    <div class="coupon-panel reveal" id="coupon">

                        <span>ÜYE KUPONU</span>

                        <h2>%15 Ekstra İndirim</h2>

                        <p>
                            Yeni sezon seçili gözlüklerde kullanılabilir özel üye kuponu.
                        </p>

                        <div class="coupon-code">
                            <b>EYEMEN15</b>
                            <button type="button" id="copyCoupon">Kopyala</button>
                        </div>

                    </div>

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

                        <a href="{{ route('products.index') }}?category={{ $category->slug }}" class="category-card">

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
                                        {{ $product->stock <= 0 ? 'disabled' : '' }}
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
    }

    .account-hero-box {
        min-height: 320px;
        background:
            linear-gradient(90deg, rgba(0,0,0,.72), rgba(0,0,0,.18)),
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
        color: rgba(255,255,255,.78);
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
        box-shadow: 0 18px 45px rgba(0,0,0,.05);
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
    }

    .account-menu a.active,
    .account-menu a:hover {
        background: #000;
        color: #fff;
        border-color: #000;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid #eee;
        padding: 24px;
        transition: .25s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 45px rgba(0,0,0,.06);
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
        grid-template-columns: 1.2fr .8fr;
        gap: 24px;
        margin-bottom: 28px;
    }

    .account-panel,
    .coupon-panel {
        background: #fff;
        border: 1px solid #eee;
        padding: 28px;
        box-shadow: 0 18px 45px rgba(0,0,0,.04);
    }

    .panel-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 22px;
    }

    .panel-head span,
    .section-title span,
    .coupon-panel > span {
        color: #c79a3a;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 1px;
    }

    .panel-head h2,
    .section-title h2 {
        font-size: 32px;
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
        gap: 12px;
    }

    .order-item {
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 14px;
        align-items: center;
        background: #fafafa;
        border: 1px solid #eee;
        padding: 14px;
    }

    .order-icon {
        width: 48px;
        height: 48px;
        background: #fff;
        display: grid;
        place-items: center;
        font-size: 22px;
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

    .coupon-panel {
        background:
            radial-gradient(circle at 100% 0%, rgba(199,154,58,.35), transparent 35%),
            linear-gradient(135deg, #07111f, #183b67);
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 290px;
    }

    .coupon-panel h2 {
        font-size: 38px;
        line-height: 1;
        margin: 16px 0;
    }

    .coupon-panel p {
        color: rgba(255,255,255,.7);
        line-height: 1.7;
    }

    .coupon-code {
        margin-top: 24px;
        border: 1px dashed rgba(255,255,255,.35);
        padding: 14px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .coupon-code button {
        border: 0;
        background: transparent;
        color: #fff;
        font-weight: 900;
        cursor: pointer;
    }

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
        color: rgba(255,255,255,.7);
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
        box-shadow: 0 24px 70px rgba(0,0,0,.1);
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
        background: rgba(255,255,255,.9);
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
        height: 100%;
        object-fit: contain;
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