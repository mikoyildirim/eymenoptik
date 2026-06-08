@extends('frontend.layout')

@section('title', 'Markalar')

@section('content')

<style>
    .brands-section {
        padding: 70px 0;
        background: #f7f7f7;
    }

    .brands-header {
        margin-bottom: 35px;
    }

    .brands-badge {
        background: #000;
        color: #fff;
        padding: 8px 14px;
        font-size: 12px;
        font-weight: 900;
        display: inline-block;
    }

    .brands-title {
        font-size: 56px;
        line-height: 1;
        margin-top: 18px;
    }

    .brands-desc {
        color: #666;
        margin-top: 12px;
    }

    .brands-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .brand-card {
        background: #fff;
        padding: 30px;
        border: 1px solid #eee;
        display: block;
        text-decoration: none;
        color: #000;
        transition: .25s ease;
    }

    .brand-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 35px rgba(0, 0, 0, .08);
        border-color: #000;
    }

    .brand-card h3 {
        font-size: 24px;
        margin-bottom: 8px;
    }

    .brand-card span {
        color: #777;
        font-weight: 700;
    }

    .brands-empty {
        grid-column: 1 / -1;
        background: #fff;
        padding: 30px;
        color: #777;
    }

    @media (max-width: 992px) {
        .brands-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .brands-title {
            font-size: 42px;
        }
    }

    @media (max-width: 576px) {
        .brands-section {
            padding: 45px 0;
        }

        .brands-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .brands-title {
            font-size: 34px;
        }

        .brand-card {
            padding: 22px;
        }

        .brand-card h3 {
            font-size: 21px;
        }
    }
</style>

<section class="brands-section">
    <div class="container">

        <div class="brands-header">
            <span class="brands-badge">
                MARKALAR
            </span>

            <h1 class="brands-title">
                Eymen Optik Markaları
            </h1>

            <p class="brands-desc">
                Mağazamızdaki aktif markaları inceleyebilirsiniz.
            </p>
        </div>

        <div class="brands-grid">

            @forelse($brands as $brand)

            <a
                href="{{ route('products.index') }}?brand={{ $brand->slug }}"
                class="brand-card">
                <h3>
                    {{ $brand->name }}
                </h3>

                <span>
                    {{ $brand->products_count }} ürün
                </span>
            </a>

            @empty

            <div class="brands-empty">
                Henüz marka bulunmuyor.
            </div>

            @endforelse

        </div>

    </div>
</section>

@endsection