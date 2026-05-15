@extends('frontend.layout')

@section('title', 'Eymen Optik | Ana Sayfa')

@section('content')

<section class="hero-banner reveal">
    <div class="container">

        <div class="hero-full">

            <img
                src="https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=1800&q=90"
                alt="Eymen Optik Banner"
            >

            <div class="hero-overlay"></div>

            <div class="hero-content-full">

                <div class="discount-badge">
                    %25<br>İNDİRİM
                </div>

                <span class="hero-small-title">
                    Yeni Sezon Koleksiyonu
                </span>

                <h1>
                    Tarzın Gözlerinden<br>
                    Okunsun
                </h1>

                <p>
                    Eymen Optik’te güneş gözlükleri, optik çerçeveler ve seçili premium modellerde özel fırsatlar.
                </p>

                <a href="{{ route('products.index') }}">
                    ALIŞVERİŞE BAŞLA
                </a>

            </div>

        </div>

        <div class="marquee">
            <span>
                %25 İNDİRİME EK YENİ ÜYELERE ÖZEL %10 İNDİRİM • ÜCRETSİZ KARGO • ORİJİNAL ÜRÜN GARANTİSİ •
                %25 İNDİRİME EK YENİ ÜYELERE ÖZEL %10 İNDİRİM • ÜCRETSİZ KARGO • ORİJİNAL ÜRÜN GARANTİSİ •
            </span>
        </div>

    </div>
</section>

<section class="mini-feature-section">
    <div class="container">
        <div class="mini-feature-grid">
            <div class="mini-feature reveal">
                <strong>🚚 Ücretsiz Kargo</strong>
                <span>Belirli tutar üzeri siparişlerde.</span>
            </div>

            <div class="mini-feature reveal">
                <strong>🕶️ Orijinal Ürün</strong>
                <span>Tüm ürünlerde güvenilir alışveriş.</span>
            </div>

            <div class="mini-feature reveal">
                <strong>💳 Taksit İmkanı</strong>
                <span>Ödeme adımında taksit seçenekleri.</span>
            </div>

            <div class="mini-feature reveal">
                <strong>📞 Destek</strong>
                <span>Sipariş ve ürün danışmanlığı.</span>
            </div>
        </div>
    </div>
</section>

<section class="product-section" id="featured-products">
    <div class="container">

        <div class="section-title reveal">
            <div>
                <span>FIRSAT ÜRÜNLERİ</span>
                <h2>İndirimdeki Ürünler</h2>
                <p>İndirimdeki ürünler arasından ihtiyacınız olan ürünü satın alabilirsiniz.</p>
            </div>

            <a href="{{ route('products.index') }}">
                Tümünü Gör →
            </a>
        </div>

        <div class="product-grid">

            @forelse($discountProducts as $product)

                <div class="product-card reveal">

                    @if($product->discount_price && $product->price > 0)
                        <div class="product-badge">
                            %{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}
                        </div>
                    @else
                        <div class="product-badge">
                            Yeni
                        </div>
                    @endif

                    <button class="wishlist-btn" type="button">
                        ♡
                    </button>

                    <a href="{{ route('products.show', $product->slug) }}">
                        <div class="product-image">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        </div>
                    </a>

                    <div class="product-content">
                        <span class="product-category">
                            {{ $product->category?->name ?? 'Ürün' }}
                        </span>

                        <h3>{{ $product->name }}</h3>

                        <div class="product-prices">
                            <strong>
                                ₺{{ number_format($product->final_price, 0, ',', '.') }}
                            </strong>

                            @if($product->discount_price)
                                <span>
                                    ₺{{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            @endif
                        </div>

                        <button
                            class="cart-btn js-add-cart"
                            type="button"
                            data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}"
                            data-price="{{ $product->final_price }}"
                            data-img="{{ $product->image_url }}"
                        >
                            Sepete Ekle
                        </button>
                    </div>

                </div>

            @empty

                <div class="empty-products">
                    Henüz ürün bulunmuyor.
                </div>

            @endforelse

        </div>

    </div>
</section>

<section class="double-banner">
    <div class="container">
        <div class="double-banner-grid">

            <a href="{{ route('products.index') }}" class="image-banner reveal">
                <img
                    src="https://images.unsplash.com/photo-1509695507497-903c140c43b0?auto=format&fit=crop&w=1000&q=90"
                    alt="Erkek Gözlükleri"
                >

                <div>
                    <span>Yeni Sezon</span>
                    <h3>Erkek Güneş Gözlükleri</h3>
                </div>
            </a>

            <a href="{{ route('products.index') }}" class="image-banner reveal">
                <img
                    src="https://images.unsplash.com/photo-1574258495973-f010dfbb5371?auto=format&fit=crop&w=1000&q=90"
                    alt="Kadın Gözlükleri"
                >

                <div>
                    <span>Yeni Ürün</span>
                    <h3>Kadın Güneş Gözlükleri</h3>
                </div>
            </a>

        </div>
    </div>
</section>

<section class="product-section bg-soft">
    <div class="container">

        <div class="section-title reveal">
            <div>
                <span>TREND KOLEKSİYON</span>
                <h2>Çok Satanlar</h2>
                <p>Çok satan ürünlerimizi inceleyebilirsiniz.</p>
            </div>

            <a href="{{ route('products.index') }}">
                Tümünü Gör →
            </a>
        </div>

        <div class="product-grid">

            @forelse($bestSellerProducts as $product)

                <div class="product-card reveal">

                    <button class="wishlist-btn" type="button">
                        ♡
                    </button>

                    <a href="{{ route('products.show', $product->slug) }}">
                        <div class="product-image">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        </div>
                    </a>

                    <div class="product-content">
                        <span class="product-category">
                            {{ $product->category?->name ?? 'Ürün' }}
                        </span>

                        <h3>{{ $product->name }}</h3>

                        <div class="product-prices">
                            <strong>
                                ₺{{ number_format($product->final_price, 0, ',', '.') }}
                            </strong>

                            @if($product->discount_price)
                                <span>
                                    ₺{{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            @endif
                        </div>

                        <button
                            class="cart-btn js-add-cart"
                            type="button"
                            data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}"
                            data-price="{{ $product->final_price }}"
                            data-img="{{ $product->image_url }}"
                        >
                            Sepete Ekle
                        </button>
                    </div>

                </div>

            @empty

                <div class="empty-products">
                    Henüz ürün bulunmuyor.
                </div>

            @endforelse

        </div>

    </div>
</section>

@endsection

@section('page_css')

<style>
    .hero-banner {
        padding: 25px 0 35px;
    }

    .hero-full {
        height: 640px;
        position: relative;
        overflow: hidden;
        background: #f5f5f5;
        box-shadow: 0 26px 70px rgba(0,0,0,.08);
    }

    .hero-full::before {
        content: "";
        position: absolute;
        inset: 0;
        z-index: 2;
        background:
            linear-gradient(90deg,rgba(255,255,255,.08),rgba(255,255,255,.75)),
            radial-gradient(circle at 70% 40%,rgba(255,255,255,.35),transparent 35%);
    }

    .hero-full img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transform: scale(1.04);
        animation: heroZoom 8s ease-in-out infinite alternate;
    }

    @keyframes heroZoom {
        from {
            transform: scale(1.04);
        }

        to {
            transform: scale(1.11);
        }
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        z-index: 3;
        background: linear-gradient(
            90deg,
            rgba(255,255,255,.08) 0%,
            rgba(255,255,255,.52) 52%,
            rgba(255,255,255,.82) 100%
        );
    }

    .hero-content-full {
        position: absolute;
        right: 110px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 5;
        text-align: center;
        animation: heroText .9s ease both;
        max-width: 620px;
    }

    .hero-small-title {
        display: inline-block;
        background: #fff;
        color: #111;
        padding: 10px 18px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 900;
        margin-bottom: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,.08);
    }

    .discount-badge {
        position: absolute;
        left: -290px;
        top: 50%;
        transform: translateY(-50%);
        width: 190px;
        height: 190px;
        border-radius: 50%;
        background: #000;
        color: #fff;
        display: grid;
        place-items: center;
        text-align: center;
        font-size: 39px;
        font-weight: 900;
        line-height: 1.1;
        border: 5px dotted #fff;
        animation: badgePulse 2.4s infinite ease-in-out;
    }

    .hero-content-full h1 {
        font-family: Georgia,'Times New Roman',serif;
        font-size: 78px;
        line-height: 1.02;
        font-weight: 500;
        color: #111;
        letter-spacing: -2px;
        margin-bottom: 18px;
    }

    .hero-content-full p {
        color: #535353;
        line-height: 1.8;
        font-size: 16px;
        margin-bottom: 28px;
    }

    .hero-content-full a {
        background: #111;
        color: #fff;
        padding: 18px 54px;
        font-size: 23px;
        font-weight: 800;
        display: inline-block;
        transition: .25s ease;
    }

    .hero-content-full a:hover {
        background: #c79a3a;
        transform: translateY(-4px);
    }

    .marquee {
        height: 42px;
        background: #000;
        color: #fff;
        overflow: hidden;
        display: flex;
        align-items: center;
        white-space: nowrap;
        font-size: 24px;
        font-weight: 900;
    }

    .marquee span {
        display: inline-block;
        animation: marqueeMove 18s linear infinite;
    }

    @keyframes marqueeMove {
        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(-50%);
        }
    }

    @keyframes badgePulse {
        0%,100% {
            scale: 1;
        }

        50% {
            scale: 1.06;
        }
    }

    @keyframes heroText {
        from {
            opacity: 0;
            transform: translateY(-42%);
        }

        to {
            opacity: 1;
            transform: translateY(-50%);
        }
    }

    .mini-feature-section {
        padding: 10px 0 35px;
    }

    .mini-feature-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .mini-feature {
        background: #fff;
        border: 1px solid #eee;
        padding: 22px;
        box-shadow: 0 14px 35px rgba(0,0,0,.04);
    }

    .mini-feature strong {
        display: block;
        font-size: 17px;
        margin-bottom: 8px;
    }

    .mini-feature span {
        color: #777;
        font-size: 13px;
    }

    .product-section {
        padding: 42px 0 60px;
    }

    .bg-soft {
        background: #f6f6f6;
        padding: 55px 0 70px;
    }

    .section-title {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: 25px;
    }

    .section-title span {
        display: inline-block;
        color: #c79a3a;
        font-weight: 900;
        font-size: 12px;
        margin-bottom: 6px;
        letter-spacing: 1px;
    }

    .section-title h2 {
        font-size: 36px;
        font-weight: 900;
        color: #000;
        margin: 0;
    }

    .section-title p {
        margin-top: 5px;
        color: #a1a1aa;
        font-size: 15px;
    }

    .section-title a {
        font-size: 14px;
        font-weight: 800;
        color: #000;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 18px;
    }

    .product-card {
        background: #fff;
        position: relative;
        overflow: hidden;
        border: 1px solid #eee;
        transition: .28s ease;
    }

    .product-card:hover {
        box-shadow: 0 18px 50px rgba(0,0,0,.08);
        transform: translateY(-6px);
    }

    .product-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 3;
        background: #000;
        color: #fff;
        padding: 7px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
    }

    .wishlist-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 38px;
        height: 38px;
        border: 0;
        border-radius: 50%;
        background: #fff;
        font-size: 22px;
        cursor: pointer;
        z-index: 3;
        box-shadow: 0 8px 22px rgba(0,0,0,.08);
        transition: .22s ease;
    }

    .wishlist-btn:hover {
        background: #000;
        color: #fff;
    }

    .product-image {
        height: 260px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 22px;
        background: #fff;
        overflow: hidden;
    }

    .product-image img {
        height: 100%;
        object-fit: contain;
        transition: .32s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.06);
    }

    .product-content {
        padding: 16px;
        text-align: center;
    }

    .product-category {
        display: block;
        color: #8b8b8b;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .product-content h3 {
        color: #111;
        font-size: 15px;
        font-weight: 700;
        line-height: 1.45;
        min-height: 44px;
        margin-bottom: 12px;
    }

    .product-prices {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-bottom: 14px;
    }

    .product-prices strong {
        color: #000;
        font-size: 20px;
        font-weight: 900;
    }

    .product-prices span {
        color: #999;
        text-decoration: line-through;
        font-size: 13px;
        font-weight: 700;
    }

    .cart-btn {
        width: 100%;
        height: 43px;
        border: 0;
        background: #000;
        color: #fff;
        font-weight: 800;
        cursor: pointer;
        transition: .25s ease;
    }

    .cart-btn:hover {
        background: #c79a3a;
    }

    .double-banner {
        padding: 0 0 55px;
    }

    .double-banner-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
    }

    .image-banner {
        position: relative;
        height: 320px;
        overflow: hidden;
        background: #eee;
    }

    .image-banner img {
        height: 100%;
        object-fit: cover;
        transition: .4s ease;
    }

    .image-banner:hover img {
        transform: scale(1.06);
    }

    .image-banner::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent, rgba(0,0,0,.48));
    }

    .image-banner div {
        position: absolute;
        left: 28px;
        bottom: 25px;
        z-index: 2;
        color: #fff;
    }

    .image-banner span {
        font-size: 13px;
        font-weight: 800;
    }

    .image-banner h3 {
        font-size: 32px;
        margin-top: 6px;
    }

    .empty-products {
        grid-column: 1 / -1;
        background: #fff;
        padding: 35px;
        text-align: center;
        color: #777;
    }

    @media(max-width: 1200px) {
        .product-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .mini-feature-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .hero-content-full {
            right: 70px;
        }

        .discount-badge {
            display: none;
        }
    }

    @media(max-width: 768px) {
        .hero-full {
            height: 480px;
        }

        .hero-content-full {
            left: 24px;
            right: 24px;
            text-align: left;
        }

        .hero-content-full h1 {
            font-size: 42px;
        }

        .hero-content-full p {
            font-size: 14px;
        }

        .hero-content-full a {
            font-size: 16px;
            padding: 14px 28px;
        }

        .section-title {
            display: block;
        }

        .product-grid,
        .double-banner-grid,
        .mini-feature-grid {
            grid-template-columns: 1fr;
        }

        .image-banner {
            height: 260px;
        }
    }
</style>

@endsection