@extends('frontend.layout')

@section('title', 'Eymen Optik | Ana Sayfa')

@section('content')

@php
$freeShippingThreshold = (float) $siteSettings->shipping_free_threshold;
@endphp

@php
$hasSliders = isset($sliders) && $sliders->isNotEmpty();
@endphp

<section class="hero-slider-section reveal">
    <div class="container">

        <div class="hero-slider" id="heroSlider">

            @if($hasSliders)

            @foreach($sliders as $index => $slider)
            <div class="hero-slide {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ asset($slider->image) }}" alt="{{ $slider->title ?? 'Slider' }}">

                <div class="hero-overlay"></div>

                <div class="hero-content">
                    <span>Eymen Optik</span>

                    <h1>{{ $slider->title }}</h1>

                    @if(!empty($slider->subtitle))
                    <p>{{ $slider->subtitle }}</p>
                    @endif

                    @if(!empty($slider->button_text))
                    <a href="{{ $slider->button_url ?: route('products.index') }}">
                        {{ $slider->button_text }}
                    </a>
                    @endif
                </div>
            </div>
            @endforeach

            @else

            <div class="hero-slide active">
                <img src="https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=1800&q=90"
                    alt="Eymen Optik">

                <div class="hero-overlay"></div>

                <div class="hero-content">
                    <span>Yeni Sezon Koleksiyonu</span>
                    <h1>Tarzın Gözlerinden Okunsun</h1>
                    <p>Güneş gözlükleri, optik çerçeveler ve premium modelleri keşfet.</p>

                    <a href="{{ route('products.index') }}">
                        Ürünleri İncele
                    </a>
                </div>
            </div>

            @endif

            @if($hasSliders && $sliders->count() > 1)
            <button class="slider-btn prev" type="button" id="sliderPrev">‹</button>
            <button class="slider-btn next" type="button" id="sliderNext">›</button>

            <div class="slider-dots" id="sliderDots">
                @foreach($sliders as $index => $slider)
                <button class="{{ $index === 0 ? 'active' : '' }}" type="button"></button>
                @endforeach
            </div>
            @endif

        </div>

        <div class="marquee">
            @php
            $marqueeText = $freeShippingThreshold == 0
            ? 'ÜCRETSİZ KARGO'
            : number_format($freeShippingThreshold, 0, ',', '.') . ' TL ÜZERİ ÜCRETSİZ KARGO';
            @endphp

            <span>
                {{ $marqueeText }} • ORİJİNAL ÜRÜN GARANTİSİ • GÜVENLİ ALIŞVERİŞ •
            </span>
            <span>
                {{ $marqueeText }} • ORİJİNAL ÜRÜN GARANTİSİ • GÜVENLİ ALIŞVERİŞ •
            </span>
        </div>

    </div>
</section>

<section class="mini-feature-section">
    <div class="container">

        <div class="mini-feature-grid">

            <div class="mini-feature reveal">
                <strong>🚚 Ücretsiz Kargo</strong>
                <span>
                    @if($freeShippingThreshold == 0)
                    Tüm siparişlerde ücretsiz kargo.
                    @else
                    {{ number_format($freeShippingThreshold, 0, ',', '.') }} TL üzeri siparişlerde.
                    @endif
                </span>
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

                <button class="wishlist-btn js-fav-toggle" type="button"
                    data-id="{{ $product->id }}"
                    data-name="{{ $product->name }}"
                    data-img="{{ $product->image_url }}"
                    data-price="{{ $product->final_price }}">♡</button>

                <a href="{{ route('products.show', $product->slug) }}">
                    <div class="product-image">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    </div>
                </a>

                <div class="product-content">
                    <span class="product-category">
                        {{ $product->category?->name ?? 'Ürün' }}
                    </span>

                    <h3>
                        {{ $product->name }}
                        @if($product->lens_degree)
                        ({{ $product->lens_degree }})
                        @endif
                    </h3>

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

                    <button class="cart-btn js-add-cart" type="button"
                        data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}"
                        data-price="{{ $product->final_price }}"
                        data-img="{{ $product->image_url }}"
                        {{ $product->stock <= 0 ? 'disabled' : '' }}>
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

                <button class="wishlist-btn js-fav-toggle" type="button"
                    data-id="{{ $product->id }}"
                    data-name="{{ $product->name }}"
                    data-img="{{ $product->image_url }}"
                    data-price="{{ $product->final_price }}">♡</button>

                <a href="{{ route('products.show', $product->slug) }}">
                    <div class="product-image">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    </div>
                </a>

                <div class="product-content">
                    <span class="product-category">
                        {{ $product->category?->name ?? 'Ürün' }}
                    </span>

                    <h3>
                        {{ $product->name }}
                        @if($product->lens_degree)
                        ({{ $product->lens_degree }})
                        @endif
                    </h3>

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

                    <button class="cart-btn js-add-cart" type="button"
                        data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}"
                        data-price="{{ $product->final_price }}"
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
                <img src="{{ asset('images/erkekgns.jpg') }}" alt="Erkek Güneş Gözlükleri">

                <div>
                    <span>Yeni Sezon</span>
                    <h3>Erkek Güneş Gözlükleri</h3>
                </div>
            </a>

            <a href="{{ route('products.index', ['gender' => 'kadin']) }}" class="image-banner reveal">
                <img src="{{ asset('images/kadinngns.jpg') }}" alt="Kadın Güneş Gözlükleri">

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
        transform: scale(1.04);
        transition: transform 6s ease;
    }

    .hero-slide.active img {
        transform: scale(1.10);
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        z-index: 3;
        background:
            linear-gradient(90deg,
                rgba(0, 0, 0, .62) 0%,
                rgba(0, 0, 0, .34) 45%,
                rgba(255, 255, 255, .18) 100%);
    }

    .hero-content {
        position: absolute;
        left: clamp(24px, 6vw, 80px);
        top: 50%;
        transform: translateY(-50%);
        z-index: 5;
        max-width: 620px;
        width: calc(100% - 48px);
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
        font-size: clamp(38px, 6vw, 78px);
        line-height: 1.02;
        font-weight: 500;
        letter-spacing: -2px;
        margin-bottom: 18px;
    }

    .hero-content p {
        line-height: 1.8;
        font-size: clamp(14px, 1.4vw, 17px);
        margin-bottom: 28px;
        color: rgba(255, 255, 255, .88);
        max-width: 560px;
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
            transform: translateX(-100%);
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
        padding: 35px 0 70px;
        background: #f6f6f6;
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

    .wishlist-btn:hover,
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
        max-width: 100%;
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
        width: 100%;
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

    @media(max-width: 1200px) {
        .product-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .mini-feature-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width: 900px) {
        .section-title {
            display: block;
        }

        .section-title a {
            display: inline-block;
            margin-top: 12px;
        }

        .product-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width: 768px) {
        .hero-slider-section {
            padding: 12px 0 24px;
        }

        .hero-slider {
            height: 520px;
            border-radius: 0;
        }

        .hero-slide img {
            object-position: center;
        }

        .hero-overlay {
            background:
                linear-gradient(180deg,
                    rgba(0, 0, 0, .18) 0%,
                    rgba(0, 0, 0, .55) 55%,
                    rgba(0, 0, 0, .76) 100%);
        }

        .hero-content {
            left: 20px;
            right: 20px;
            top: auto;
            bottom: 72px;
            transform: none;
            width: auto;
        }

        .hero-content span {
            font-size: 11px;
            padding: 8px 13px;
            margin-bottom: 13px;
        }

        .hero-content h1 {
            font-size: 39px;
            line-height: 1.05;
            letter-spacing: -1.2px;
            margin-bottom: 12px;
        }

        .hero-content p {
            font-size: 14px;
            line-height: 1.65;
            margin-bottom: 18px;
        }

        .hero-content a {
            font-size: 14px;
            padding: 13px 24px;
        }

        .slider-btn {
            display: none;
        }

        .slider-dots {
            bottom: 28px;
        }

        .marquee {
            font-size: 17px;
            height: 38px;
        }

        .product-grid,
        .double-banner-grid {
            grid-template-columns: 1fr;
        }

        .image-banner {
            height: 260px;
        }
    }

    @media(max-width: 560px) {
        .hero-slider {
            height: 480px;
        }

        .hero-content {
            bottom: 66px;
        }

        .hero-content h1 {
            font-size: 34px;
        }

        .product-grid,
        .mini-feature-grid {
            grid-template-columns: 1fr;
        }

        .product-image {
            height: 300px;
        }

        .section-title h2 {
            font-size: 30px;
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
        let sliderTimer = null;

        function showSlide(index) {
            if (!slides.length) return;

            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            currentSlide = (index + slides.length) % slides.length;

            slides[currentSlide].classList.add('active');

            if (dots[currentSlide]) {
                dots[currentSlide].classList.add('active');
            }
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        function startSlider() {
            if (slides.length > 1) {
                sliderTimer = setInterval(nextSlide, 5000);
            }
        }

        function resetSlider() {
            if (sliderTimer) {
                clearInterval(sliderTimer);
            }

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

        document.addEventListener('click', function(e) {
            const wishBtn = e.target.closest('.wishlist-btn');

            if (!wishBtn) return;

            wishBtn.classList.toggle('active');
        });
    });
</script>

@endsection