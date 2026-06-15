@extends('frontend.layout')

@section('title', 'Eymen Optik | Ana Sayfa')

@section('content')

@php
    $freeShippingThreshold = (float) $siteSettings->shipping_free_threshold;
@endphp

<section class="hero-slider-section reveal">
    <div class="container">

        <div class="hero-slider" id="heroSlider">

            <div class="hero-slide active">
                <img src="https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=1800&q=90"
                    alt="Eymen Optik">

                <div class="hero-overlay"></div>

                <div class="hero-content">
                    <span>Yeni Sezon Koleksiyonu</span>
                    <h1>Tarzın Gözlerinden Okunsun</h1>
                    <p>Güneş gözlükleri, optik çerçeveler ve premium modelleri keşfet.</p>
                    <a href="{{ route('products.index') }}">Ürünleri İncele</a>
                </div>
            </div>

            <div class="hero-slide">
                <img src="https://images.unsplash.com/photo-1574258495973-f010dfbb5371?auto=format&fit=crop&w=1800&q=90"
                    alt="Kadın Gözlükleri">

                <div class="hero-overlay"></div>

                <div class="hero-content">
                    <span>Premium Seçimler</span>
                    <h1>Modern ve Şık Gözlükler</h1>
                    <p>Günlük stilini tamamlayan özel optik modeller burada.</p>
                    <a href="{{ route('products.index') }}">Koleksiyonu Gör</a>
                </div>
            </div>

            <div class="hero-slide">
                <img src="https://images.unsplash.com/photo-1509695507497-903c140c43b0?auto=format&fit=crop&w=1800&q=90"
                    alt="Erkek Gözlükleri">

                <div class="hero-overlay"></div>

            <div class="hero-content">
    <span>Ücretsiz Kargo</span>

    @if($freeShippingThreshold == 0)
        <h1>Ücretsiz Kargo</h1>
        <p>Tüm siparişlerinizde ücretsiz kargo fırsatını kaçırmayın.</p>
    @else
        <h1>₺{{ number_format($freeShippingThreshold, 0, ',', '.') }} ve Üzeri</h1>
        <p>{{ number_format($freeShippingThreshold, 0, ',', '.') }} TL ve üzeri alışverişlerinizde ücretsiz kargo fırsatını kaçırmayın.</p>
    @endif

    <a href="{{ route('products.index') }}">Alışverişe Başla</a>
</div>
            </div>

            <button class="slider-btn prev" type="button" id="sliderPrev">‹</button>
            <button class="slider-btn next" type="button" id="sliderNext">›</button>

            <div class="slider-dots" id="sliderDots">
                <button class="active" type="button"></button>
                <button type="button"></button>
                <button type="button"></button>
            </div>

        </div>

  <div class="marquee">
    <span>
        {{ $freeShippingThreshold == 0 
            ? 'ÜCRETSİZ KARGO' 
            : number_format($freeShippingThreshold, 0, ',', '.') . ' TL ÜZERİ ÜCRETSİZ KARGO' }}
        • ORİJİNAL ÜRÜN GARANTİSİ • GÜVENLİ ALIŞVERİŞ •
    </span>
</div>
</section>

<section class="mini-feature-section">
    <div class="container">

        <div class="mini-feature-grid">

            <div class="mini-feature reveal">
                <strong>🚚 Ücretsiz Kargo</strong>
                <span>{{ number_format($freeShippingThreshold, 0, ',', '.') }} TL üzeri siparişlerde.</span>
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

                <button class="wishlist-btn js-fav-toggle" type="button" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-img="{{ $product->image_url }}" data-price="{{ $product->final_price }}">♡</button>
                <a href="{{ route('products.show', $product->slug) }}">
                    <div class="product-image">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    </div>
                </a>

                <div class="product-content">
                    <span class="product-category">
                        {{ $product->category?->name ?? 'Ürün' }}
                    </span>

                    <h3>{{ $product->name }} @if($product->lens_degree) ({{ $product->lens_degree }}) @endif</h3>


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

                    <button class="cart-btn js-add-cart" type="button" data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}" data-price="{{ $product->final_price }}"
                        data-img="{{ $product->image_url }}" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        {{ $product->stock > 0 ? 'Sepete Ekle' : 'Stokta Yok' }}
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

                <button class="wishlist-btn js-fav-toggle" type="button" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-img="{{ $product->image_url }}" data-price="{{ $product->final_price }}">♡</button>
                <a href="{{ route('products.show', $product->slug) }}">
                    <div class="product-image">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    </div>
                </a>

                <div class="product-content">
                    <span class="product-category">
                        {{ $product->category?->name ?? 'Ürün' }}
                    </span>

                    <h3>{{ $product->name }} @if($product->lens_degree) ({{ $product->lens_degree }}) @endif</h3>

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

                    <button class="cart-btn js-add-cart" type="button" data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}" data-price="{{ $product->final_price }}"
                        data-img="{{ $product->image_url }}">
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

            <a href="{{ route('products.index', ['gender' => 'erkek']) }}" class="image-banner reveal">
                <img src="https://images.unsplash.com/photo-1509695507497-903c140c43b0?auto=format&fit=crop&w=1000&q=90"
                    alt="Erkek Gözlükleri">

                <div>
                    <span>Yeni Sezon</span>
                    <h3>Erkek Güneş Gözlükleri</h3>
                </div>
            </a>

            <a href="{{ route('products.index', ['gender' => 'kadin']) }}" class="image-banner reveal">
                <img src="https://images.unsplash.com/photo-1574258495973-f010dfbb5371?auto=format&fit=crop&w=1000&q=90"
                    alt="Kadın Gözlükleri">

                <div>
                    <span>Yeni Ürün</span>
                    <h3>Kadın Güneş Gözlükleri</h3>
                </div>
            </a>

        </div>
    </div>
</section>

@endsection

@section('page_css')

<style>
    .hero-slider-section {
        padding: 25px 0 35px;
    }

    .hero-slider {
        height: 640px;
        position: relative;
        overflow: hidden;
        background: #f5f5f5;
        box-shadow: 0 26px 70px rgba(0, 0, 0, .08);
    }

    .hero-slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        visibility: hidden;
        transition: opacity .8s ease, visibility .8s ease;
    }

    .hero-slide.active {
        opacity: 1;
        visibility: visible;
        z-index: 2;
    }

    .hero-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transform: scale(1.06);
        transition: transform 6s ease;
    }

    .hero-slide.active img {
        transform: scale(1.13);
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        z-index: 3;
        background:
            linear-gradient(90deg,
                rgba(0, 0, 0, .55) 0%,
                rgba(0, 0, 0, .20) 45%,
                rgba(255, 255, 255, .40) 100%);
    }

    .hero-content {
        position: absolute;
        left: 80px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 5;
        max-width: 620px;
        color: #fff;
    }

    .hero-content span {
        display: inline-block;
        background: rgba(255, 255, 255, .16);
        border: 1px solid rgba(255, 255, 255, .35);
        backdrop-filter: blur(12px);
        color: #fff;
        padding: 10px 18px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 900;
        margin-bottom: 20px;
    }

    .hero-content h1 {
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 78px;
        line-height: 1.02;
        font-weight: 500;
        letter-spacing: -2px;
        margin-bottom: 18px;
    }

    .hero-content p {
        line-height: 1.8;
        font-size: 17px;
        margin-bottom: 28px;
        color: rgba(255, 255, 255, .86);
    }

    .hero-content a {
        background: #fff;
        color: #111;
        padding: 17px 45px;
        font-size: 17px;
        font-weight: 900;
        display: inline-block;
        transition: .25s ease;
    }

    .hero-content a:hover {
        background: #111;
        color: #fff;
        transform: translateY(-4px);
    }

    .slider-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        width: 54px;
        height: 54px;
        border: 0;
        background: rgba(255, 255, 255, .85);
        color: #111;
        font-size: 42px;
        cursor: pointer;
        transition: .25s ease;
    }

    .slider-btn:hover {
        background: #111;
        color: #fff;
    }

    .slider-btn.prev {
        left: 24px;
    }

    .slider-btn.next {
        right: 24px;
    }

    .slider-dots {
        position: absolute;
        left: 50%;
        bottom: 26px;
        transform: translateX(-50%);
        z-index: 12;
        display: flex;
        gap: 9px;
    }

    .slider-dots button {
        width: 10px;
        height: 10px;
        border: 0;
        border-radius: 999px;
        background: rgba(255, 255, 255, .6);
        cursor: pointer;
        transition: .25s ease;
    }

    .slider-dots button.active {
        width: 34px;
        background: #fff;
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

        0%,
        100% {
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
        box-shadow: 0 14px 35px rgba(0, 0, 0, .04);
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

    .home-category-filter {
        padding: 0 0 40px;
    }

    .bg-soft {
        background: #f6f6f6;
        padding: 55px 0 70px;
    }

    .category-filter-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: 18px;
    }

    .category-filter-top span,

    .category-filter-top h2,
    .section-title h2 {
        font-size: 36px;
        font-weight: 900;
        color: #000;
        margin: 0;
        letter-spacing: -1.5px;
    }

    .category-filter-top a {
        font-size: 14px;
        font-weight: 900;
        color: #000;
    }

    .category-filter-scroll {
        display: flex;
        gap: 12px;
        overflow-x: auto;
        padding-bottom: 8px;
    }

    .category-filter-scroll::-webkit-scrollbar {
        height: 6px;
    }

    .category-filter-scroll::-webkit-scrollbar-thumb {
        background: #d4d4d8;
    }

    .category-filter-btn {
        border: 1px solid #e5e7eb;
        background: #fff;
        min-height: 50px;
        padding: 0 24px;
        white-space: nowrap;
        cursor: pointer;
        font-weight: 900;
        transition: .25s ease;
    }

    .category-filter-btn:hover,
    .category-filter-btn.active {
        background: #000;
        color: #fff;
        border-color: #000;
    }

    .product-section {
        padding: 35px 0 70px;
        background: #f6f6f6;
    }

    .section-title {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: 18px;
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

    .home-search-sort {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .home-search-sort input,
    .home-search-sort select {
        height: 48px;
        border: 1px solid #e5e7eb;
        background: #fff;
        outline: 0;
        padding: 0 15px;
        font-weight: 800;
    }

    .home-search-sort input {
        width: 240px;
    }

    .product-result-text {
        margin-bottom: 20px;
        color: #555;
    }

    .product-result-text b {
        font-size: 15px;
        font-weight: 900;
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
        box-shadow: 0 18px 50px rgba(0, 0, 0, .08);
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
        box-shadow: 0 8px 22px rgba(0, 0, 0, .08);
        transition: .22s ease;
    }

    .wishlist-btn:hover {
        background: #000;
        color: #fff;
    }

    .wishlist-btn.active {
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

    .product-meta {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 14px;
    }

    .product-meta span {
        background: #f3f3f3;
        color: #555;
        border-radius: 999px;
        padding: 7px 10px;
        font-size: 11px;
        font-weight: 900;
    }

    .product-prices {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-bottom: 14px;
        margin-top: auto;
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

    .cart-btn:disabled {
        background: #aaa;
        cursor: not-allowed;
    }

    .double-banner {
        padding: 0 0 55px;
        background: #fff;
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
        background: linear-gradient(180deg, transparent, rgba(0, 0, 0, .48));
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

    .no-result {
        display: none;
    }

    @media(max-width: 1200px) {
        .product-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .mini-feature-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .hero-content h1 {
            font-size: 58px;
        }

        .hero-content-full {
            right: 70px;
        }

        .discount-badge {
            display: none;
        }
    }

    @media(max-width: 900px) {

        .section-title,
        .category-filter-top {
            display: block;
        }

        .home-search-sort {
            margin-top: 16px;
            width: 100%;
        }

        .home-search-sort input,
        .home-search-sort select {
            width: 100%;
        }

        .home-search-sort {
            flex-direction: column;
        }

        .product-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width: 768px) {
        .hero-slider {
            height: 500px;
        }

        .hero-content {
            left: 24px;
            right: 24px;
            max-width: none;
        }

        .hero-content h1 {
            font-size: 42px;
        }

        .hero-content p {
            font-size: 14px;
        }

        .hero-content a {
            font-size: 15px;
            padding: 14px 28px;
        }

        .slider-btn {
            width: 42px;
            height: 42px;
            font-size: 32px;
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

    @media(max-width: 560px) {
        .product-grid {
            grid-template-columns: 1fr;
        }

        .product-image {
            height: 300px;
        }

        .marquee {
            font-size: 17px;
        }
    }
</style>

@endsection

@section('page_js')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('#sliderDots button');
        const prevBtn = document.getElementById('sliderPrev');
        const nextBtn = document.getElementById('sliderNext');

        let currentSlide = 0;
        let sliderTimer;

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            currentSlide = (index + slides.length) % slides.length;

            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        function startSlider() {
            sliderTimer = setInterval(nextSlide, 5000);
        }

        function resetSlider() {
            clearInterval(sliderTimer);
            startSlider();
        }

        nextBtn?.addEventListener('click', function() {
            nextSlide();
            resetSlider();
        });

        prevBtn?.addEventListener('click', function() {
            prevSlide();
            resetSlider();
        });

        dots.forEach((dot, index) => {
            dot.addEventListener('click', function() {
                showSlide(index);
                resetSlider();
            });
        });

        startSlider();

        const filterButtons = document.querySelectorAll('.category-filter-btn');
        const productCards = Array.from(document.querySelectorAll('.js-product-card'));
        const searchInput = document.getElementById('homeProductSearch');
        const sortSelect = document.getElementById('homeSortSelect');
        const productGrid = document.getElementById('homeProductGrid');
        const resultText = document.getElementById('homeProductResult');
        const noResult = document.getElementById('homeNoResult');

        let activeFilter = 'all';
        let activeSearch = '';

        function applyHomeProducts() {
            let visibleCards = productCards.filter(card => {
                const categoryMatch =
                    activeFilter === 'all' ||
                    card.dataset.category === activeFilter;

                const searchMatch = !activeSearch ||
                    (card.dataset.name || '').includes(activeSearch) ||
                    card.innerText.toLocaleLowerCase('tr-TR').includes(activeSearch);

                return categoryMatch && searchMatch;
            });

            const sort = sortSelect?.value || 'default';

            visibleCards.sort((a, b) => {
                const priceA = Number(a.dataset.price || 0);
                const priceB = Number(b.dataset.price || 0);

                const nameA = a.dataset.name || '';
                const nameB = b.dataset.name || '';

                if (sort === 'priceAsc') return priceA - priceB;
                if (sort === 'priceDesc') return priceB - priceA;
                if (sort === 'nameAsc') return nameA.localeCompare(nameB, 'tr');

                return 0;
            });

            productCards.forEach(card => {
                card.style.display = 'none';
            });

            visibleCards.forEach(card => {
                card.style.display = 'flex';
                productGrid.appendChild(card);
            });

            if (resultText) {
                resultText.textContent = `${visibleCards.length} ürün listeleniyor`;
            }

            if (noResult) {
                noResult.style.display = visibleCards.length === 0 ? 'block' : 'none';
                productGrid.appendChild(noResult);
            }
        }

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active'));

                button.classList.add('active');

                activeFilter = button.dataset.filter || 'all';

                applyHomeProducts();
            });
        });

        searchInput?.addEventListener('input', function() {
            activeSearch = searchInput.value.trim().toLocaleLowerCase('tr-TR');

            applyHomeProducts();
        });

        sortSelect?.addEventListener('change', applyHomeProducts);

        document.addEventListener('click', function(e) {
            const wishBtn = e.target.closest('.wishlist-btn');

            if (!wishBtn) return;

            wishBtn.classList.toggle('active');
        });

        applyHomeProducts();
    });
</script>

@endsection