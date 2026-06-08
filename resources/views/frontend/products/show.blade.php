@extends('frontend.layout')

@section('title', $product->name . ' | Eymen Optik')

@section('content')

<main class="product-page">

    <section class="product-detail-section">
        <div class="container">

            <div class="product-detail-card reveal">

                <div class="product-gallery">
                    <div class="product-image-box">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" id="productMainImage">
                    </div>

                    @if($product->gallery_images->count() > 1)
                    <div class="product-thumbs">
                        @foreach($product->gallery_images as $imagePath)
                        <button type="button" class="product-thumb {{ $loop->first ? 'active' : '' }}" data-image="{{ asset('storage/' . $imagePath) }}">
                            <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $product->name }}">
                        </button>
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="product-info-box">

                    <div class="product-tags">
                        <span>{{ $product->category?->name ?? 'Ürün' }}</span>
                        <span>{{ $product->brand?->name ?? 'Eymen Optik' }}</span>
                    </div>

                    <h1>{{ $product->name }} @if($product->lens_degree)({{ $product->lens_degree }})@endif</h1>

                    <p class="short-desc">
                        @if($product->category?->slug === 'lens' && $product->glass_color) Renk: {{ ucfirst($product->glass_color) }} · @endif {{ $product->short_description ?: 'Eymen Optik kalitesiyle seçilmiş özel ürün.' }}
                    </p>

                    <div class="price-area">
                        <strong>₺{{ number_format($product->final_price, 0, ',', '.') }}</strong>

                        @if($product->discount_price)
                        <small>₺{{ number_format($product->price, 0, ',', '.') }}</small>
                        <span class="discount-badge">İndirimli</span>
                        @endif
                    </div>

                    <div class="info-list">
                        <div>
                            <span>Stok Durumu</span>
                            <strong class="{{ $product->stock > 0 ? 'in-stock' : 'out-stock' }}">
                                {{ $product->stock > 0 ? 'Stokta var' : 'Tükendi' }}
                            </strong>
                        </div>

                        @if($product->model_code)
                        <div>
                            <span>Model Kodu</span>
                            <strong>{{ $product->model_code }}</strong>
                        </div>
                        @endif

                        @if($product->lens_degree)
                        <div>
                            <span>Lens Derecesi</span>
                            <strong>{{ $product->lens_degree }}</strong>
                        </div>
                        @endif
                    </div>
                    <div class="product-actions-row">
                        <button class="btn btn-fav js-fav-toggle" type="button" id="favBtn" data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}" data-img="{{ $product->image_url }}" data-price="{{ $product->final_price }}">
                            ♡ Favori
                        </button>

                        <button class="btn btn-add js-add-cart" type="button" data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}" data-price="{{ $product->final_price }}"
                            data-img="{{ $product->image_url }}" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            {{ $product->stock > 0 ? 'Sepete Ekle' : 'Stokta Yok' }}
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <section class="product-description-section">
        <div class="container">
            <div class="description-card reveal">
                <h2>Ürün Özellikleri</h2>
                @php
                $lensDetails = [
                'Lens Tipi' => $product->lens_type,
                'Lens Rengi' => $product->glass_color,
                'Kullanım Şekli' => $product->lens_usage,
                'Ambalaj İçeriği' => $product->lens_package_content,
                'Su İçeriği' => $product->lens_water_content,
                'Base Curve (BC)' => $product->lens_base_curve,
                'Çap (Dia.)' => $product->lens_diameter,
                'Lens Materyali' => $product->lens_material,
                'Merkez Kalınlığı' => $product->lens_center_thickness,
                'Oksijen Aktarılabilirliği' => $product->lens_oxygen_permeability,
                ];

                foreach ($lensDetails as $key => $value) {
                if ($value) {
                $lensDetails[$key] = ucwords($value);
                }
                }
                @endphp

                @php
                $glassDetails = [
                'Çerçeve Rengi' => $product->frame_color,
                'Cam Rengi' => $product->glass_color,
                'Çerçeve Materyali' => $product->frame_material,
                'Cam Tipi' => $product->glass_type,
                ];

                foreach ($glassDetails as $key => $value) {
                if ($value) {
                $glassDetails[$key] = ucwords($value);
                }
                }
                @endphp

                @if(collect($lensDetails)->filter()->isNotEmpty() && $product->category?->slug === 'lens')
                <div class="lens-details-grid">
                    @foreach($lensDetails as $label => $value)
                    @if($value)
                    <div>
                        <span>{{ $label }}</span>
                        <strong>{{ $value }}</strong>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endif

                @if(collect($glassDetails)->filter()->isNotEmpty() && $product->category?->slug !== 'lens')
                <div class="lens-details-grid">
                    @foreach($glassDetails as $label => $value)
                    @if($value)
                    <div>
                        <span>{{ $label }}</span>
                        <strong>{{ $value }}</strong>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>

    <section class="product-description-section">
        <div class="container">
            <div class="description-card reveal">
                <h2>Ürün Açıklaması</h2>

                <div class="description-content">
                    {!! $product->description ?: '<p>Bu ürün için açıklama henüz eklenmedi.</p>' !!}
                </div>
            </div>
        </div>
    </section>

    @if($relatedProducts && $relatedProducts->count())
    <section class="related-products-section">
        <div class="container">

            <div class="section-title">
                <h2>Benzer Ürünler</h2>
                <p>Bu ürüne yakın diğer modelleri inceleyebilirsiniz.</p>
            </div>

            <div class="related-products-grid">
                @foreach($relatedProducts as $related)
                <article class="related-product-card">

                    <a href="{{ route('products.show', $related->slug) }}" class="related-product-image">
                        <img src="{{ $related->image_url }}" alt="{{ $related->name }}">
                    </a>

                    <div class="related-product-body">
                        <div class="related-meta">
                            <span>{{ $related->category?->name ?? 'Ürün' }}</span>
                        </div>

                        <h4>
                            <a href="{{ route('products.show', $related->slug) }}">
                                {{ $related->name }} @if($related->lens_degree) ({{ $related->lens_degree }}) @endif
                            </a>
                        </h4>
                        <div class="eo-product-details">
                            @if($product->glass_color && $product->category?->slug === 'lens')
                            <small class="text-muted d-block">
                                Renk: {{ $product->glass_color }}
                            </small>
                            @endif
                        </div>
                        <div class="related-price">
                            <strong>₺{{ number_format($related->final_price, 0, ',', '.') }}</strong>

                            @if($related->discount_price)
                            <small>₺{{ number_format($related->price, 0, ',', '.') }}</small>
                            @endif
                        </div>
                    </div>

                </article>
                @endforeach
            </div>

        </div>
    </section>
    @endif

</main>

@endsection

@section('page_css')
<style>
    .product-page {
        background: #f7f7f8;
        padding-bottom: 60px;
    }

    .product-detail-section {
        padding: 42px 0 24px;
    }

    .product-detail-card {
        display: grid;
        grid-template-columns: minmax(0, 1.05fr) minmax(0, .95fr);
        gap: 34px;
        background: #fff;
        border: 1px solid #ececec;
        border-radius: 26px;
        padding: 28px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .06);
    }

    .product-gallery {
        min-width: 0;
    }

    .product-image-box {
        width: 100%;
        min-height: 520px;
        background: linear-gradient(180deg, #fafafa, #f1f1f1);
        border-radius: 22px;
        border: 1px solid #ededed;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 34px;
        overflow: hidden;
    }

    .product-image-box img {
        display: block;
        margin: 0 auto;
        max-width: 100%;
        max-height: 500px;
        width: auto;
        height: auto;
        object-fit: contain;
        object-position: center;
        transition: transform .35s ease;
    }

    .product-image-box:hover img {
        transform: scale(1.04);
    }

    .product-thumbs {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
        margin-top: 14px;
    }

    .product-thumb {
        border: 1px solid #e8e8e8;
        border-radius: 14px;
        padding: 8px;
        background: #fff;
        cursor: pointer;
        transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
    }

    .product-thumb.active {
        border-color: #111;
        box-shadow: 0 8px 18px rgba(17, 17, 17, .12);
    }

    .product-thumb img {
        width: 100%;
        height: 86px;
        object-fit: cover;
        border-radius: 10px;
    }

    .product-info-box {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        padding-top: 34px;
        min-width: 0;
    }

    .product-tags {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }

    .product-tags span {
        background: #f2f2f2;
        color: #222;
        border-radius: 999px;
        padding: 8px 13px;
        font-size: 13px;
        font-weight: 700;
    }

    .product-info-box h1 {
        font-size: clamp(30px, 4vw, 52px);
        line-height: 1.05;
        margin: 0 0 16px;
        color: #111;
        letter-spacing: -1.5px;
    }

    .short-desc {
        font-size: 16px;
        line-height: 1.7;
        color: #666;
        margin: 0 0 22px;
        max-width: 560px;
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

    .price-area {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .price-area strong {
        font-size: 36px;
        color: #111;
        letter-spacing: -1px;
    }

    .price-area small {
        font-size: 18px;
        color: #999;
        text-decoration: line-through;
    }

    .discount-badge {
        background: #111;
        color: #fff;
        border-radius: 999px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 800;
    }

    .info-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 12px;
        margin-bottom: 24px;
    }

    .info-list div {
        background: #fafafa;
        border: 1px solid #eee;
        border-radius: 16px;
        padding: 15px;
    }

    .info-list span {
        display: block;
        font-size: 12px;
        color: #777;
        margin-bottom: 6px;
    }

    .info-list strong {
        font-size: 15px;
        color: #111;
    }

    .in-stock {
        color: #159947 !important;
    }

    .out-stock {
        color: #d63031 !important;
    }

    .product-actions-row {
        display: grid;
        grid-template-columns: 150px 1fr;
        gap: 12px;
    }

    .lens-details-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .lens-details-grid div {
        background: #fbfbfc;
        border: 1px solid #eee;
        border-radius: 14px;
        padding: 12px 14px;
    }

    .lens-details-grid span {
        display: block;
        font-size: 12px;
        color: #777;
        margin-bottom: 6px;
    }

    .lens-details-grid strong {
        font-size: 14px;
        color: #111;
    }

    .btn {
        height: 54px;
        border-radius: 16px;
        border: 0;
        cursor: pointer;
        font-weight: 900;
        transition: all .25s ease;
        font-size: 15px;
    }

    .btn-fav {
        background: #fff;
        border: 1px solid #ddd;
        color: #111;
    }

    .btn-fav:hover,
    .btn-fav.active {
        background: #ff4d6d;
        color: #fff;
        border-color: #ff4d6d;
    }

    .btn-add {
        background: #111;
        color: #fff;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, .22);
    }

    .btn-add:disabled {
        opacity: .45;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .product-description-section {
        padding: 10px 0 28px;
    }

    .description-card {
        background: #fff;
        border: 1px solid #ececec;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 16px 45px rgba(0, 0, 0, .04);
    }

    .description-card h2,
    .section-title h2 {
        margin: 0 0 14px;
        font-size: 26px;
        color: #111;
    }

    .description-content {
        color: #555;
        line-height: 1.8;
        font-size: 16px;
    }

    .related-products-section {
        padding: 20px 0 20px;
    }

    .section-title {
        margin-bottom: 20px;
    }

    .section-title p {
        color: #666;
        margin: 0;
    }

    .related-products-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
    }

    .related-product-card {
        background: #fff;
        border: 1px solid #ececec;
        border-radius: 22px;
        overflow: hidden;
        transition: all .28s ease;
    }

    .related-product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 45px rgba(0, 0, 0, .08);
    }

    .related-product-image {
        height: 245px;
        background: #fafafa;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 22px;
    }

    .related-product-image img {
        display: block;
        margin: 0 auto;
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        object-position: center;
        transition: transform .3s ease;
    }

    .related-product-card:hover img {
        transform: scale(1.05);
    }

    .related-product-body {
        padding: 17px;
    }

    .related-meta span {
        color: #777;
        font-size: 12px;
        font-weight: 700;
    }

    .related-product-body h4 {
        margin: 8px 0 12px;
        font-size: 16px;
        line-height: 1.4;
    }

    .related-product-body h4 a {
        color: #111;
        text-decoration: none;
    }

    .related-price {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .related-price strong {
        color: #111;
        font-size: 18px;
    }

    .related-price small {
        color: #999;
        text-decoration: line-through;
    }

    @media (max-width: 1100px) {
        .related-products-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 900px) {
        .product-detail-card {
            grid-template-columns: 1fr;
            padding: 20px;
        }

        .product-image-box {
            min-height: 390px;
        }

        .product-thumbs {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .related-products-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .product-detail-section {
            padding-top: 20px;
        }

        .product-image-box {
            min-height: 310px;
            padding: 22px;
        }

        .product-actions-row {
            grid-template-columns: 1fr;
        }

        .info-list {
            grid-template-columns: 1fr;
        }

        .related-products-grid {
            grid-template-columns: 1fr;
        }

        .description-card {
            padding: 22px;
        }
    }
</style>
@endsection

@section('page_js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.product-thumb').forEach(button => {
            button.addEventListener('click', function() {
                const mainImage = document.getElementById('productMainImage');
                const nextImage = this.dataset.image;

                if (mainImage && nextImage) {
                    mainImage.src = nextImage;
                }

                document.querySelectorAll('.product-thumb').forEach(item => item.classList.remove('active'));
                this.classList.add('active');
            });
        });

        const favBtn = document.getElementById('favBtn');

        if (favBtn) {
            favBtn.addEventListener('click', function() {
                this.classList.toggle('active');
                this.innerHTML = this.classList.contains('active') ?
                    '♥ Favoride' :
                    '♡ Favori';
            });
        }

        document.querySelectorAll('.js-add-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.disabled) return;

                const originalText = this.textContent;
                this.textContent = 'Sepete Eklendi ✓';
                this.disabled = true;

                setTimeout(() => {
                    this.textContent = originalText;
                    this.disabled = false;
                }, 1400);
            });
        });
    });
</script>
@endsection