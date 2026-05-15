@extends('frontend.layout')

@section('title', $product->name . ' | Eymen Optik')

@section('content')

<main class="product-page">

    <section class="product-hero">
        <div class="container">
            <div class="product-grid-two reveal">

                <div class="product-media">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                </div>

                <div class="product-info">
                    <h1>{{ $product->name }}</h1>
                    <div class="product-meta">
                        <span>{{ $product->category?->name ?? 'Ürün' }}</span>
                        <span>{{ $product->brand?->name ?? 'Eymen' }}</span>
                    </div>

                    <p class="short-desc">{{ $product->short_description ?: 'Eymen Optik ürünü.' }}</p>

                    <div class="price-row">
                        <strong>₺{{ number_format($product->final_price, 0, ',', '.') }}</strong>
                        @if($product->discount_price)
                        <small>₺{{ number_format($product->price, 0, ',', '.') }}</small>
                        @endif
                    </div>

                    <div class="product-actions-row">
                        <button class="btn btn-fav" type="button" id="favBtn" data-id="{{ $product->id }}">♡
                            Favori</button>
                        <button class="btn btn-add js-add-cart" type="button" data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}" data-price="{{ $product->final_price }}"
                            data-img="{{ $product->image_url }}">Sepete Ekle</button>
                    </div>

                    <div class="stock-and-model">
                        <span>{{ $product->stock > 0 ? 'Stokta: '.$product->stock : 'Tükendi' }}</span>
                        @if($product->model_code)
                        <span>Model: {{ $product->model_code }}</span>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section class="product-details">
        <div class="container">
            <div class="description reveal">
                {!! $product->description ?: '<p>Ürün açıklaması bulunamadı.</p>' !!}
            </div>

            @if($relatedProducts && $relatedProducts->count())
            <h3>Benzer Ürünler</h3>
            <div class="product-grid related">
                @foreach($relatedProducts as $related)
                <article class="product-card">
                    <a href="{{ route('products.show', $related->slug) }}" class="product-media">
                        <img src="{{ $related->image_url }}" alt="{{ $related->name }}">
                    </a>
                    <div class="product-body">
                        <h4>{{ $related->name }}</h4>
                        <div class="price-row">
                            <strong>₺{{ number_format($related->final_price, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            @endif
        </div>
    </section>

</main>

@endsection

@section('page_css')
<style>
    /* Product detail responsive layout */
    .product-grid-two {
        display: flex;
        gap: 28px;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .product-media {
        flex: 0 0 45%;
        max-width: 45%;
        background: #fafafa;
        padding: 18px;
        display: grid;
        place-items: center;
        border: 1px solid #eee;
        border-radius: 8px;
    }

    .product-media img {
        width: 100%;
        height: auto;
        max-height: 520px;
        object-fit: contain;
    }

    .product-info {
        flex: 1 1 50%;
        max-width: 50%;
    }

    .product-actions-row {
        display: flex;
        gap: 10px;
        margin: 16px 0;
    }

    .btn {
        padding: 10px 14px;
        border-radius: 8px;
        border: 0;
        cursor: pointer;
        font-weight: 800
    }

    .btn-fav {
        background: #fff;
        border: 1px solid #ddd
    }

    .btn-fav.active {
        background: #ff6b6b;
        color: #fff;
        border-color: #ff6b6b
    }

    .btn-add {
        background: #000;
        color: #fff
    }

    .product-details .description {
        margin-top: 18px;
        background: #fff;
        padding: 18px;
        border: 1px solid #eee;
        border-radius: 8px
    }

    @media (max-width: 900px) {

        .product-media,
        .product-info {
            flex: 0 0 100%;
            max-width: 100%
        }

        .product-media {
            order: -1
        }
    }
</style>
@endsection

@section('page_js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const favBtn = document.getElementById('favBtn');
        if (favBtn) {
            favBtn.addEventListener('click', function() {
                this.classList.toggle('active');
                // TODO: AJAX call to save favorite for authenticated user
            });
        }

        document.querySelectorAll('.js-add-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                // Basic client-side feedback; integrate with cart logic as needed
                this.textContent = 'Eklendi ✓';
                this.disabled = true;
                console.log('Add to cart', id);
            });
        });
    });
</script>
@endsection