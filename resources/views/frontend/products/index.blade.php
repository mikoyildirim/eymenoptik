@extends('frontend.layout')

@section('title', 'Eymen Optik | Ürünler')

@section('content')

<main class="shop-page">

    <section class="shop-hero">
        <div class="container">
            <div class="shop-hero-box reveal">
                <div>
                    <span>ÜRÜN KATALOĞU</span>
                    <h1>Gözlük koleksiyonunu keşfet</h1>
                    <p>Kategori, marka, arama ve fiyat sıralama özellikleriyle ürünleri hızlıca filtreleyebilirsin.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="shop-section" id="products">
        <div class="container">

            <div class="shop-layout">

                <aside class="shop-sidebar reveal">

                    <div class="sidebar-block">
                        <h3>Kategoriler</h3>

                        @php($allProductsCount = $products->count())

                        <div class="filter-list">
                            <button class="filter-btn active" type="button" data-filter-group="category" data-filter="all">
                                Tüm Ürünler <span>{{ $allProductsCount }}</span>
                            </button>

                            @foreach($categories as $category)
                                <button class="filter-btn" type="button" data-filter-group="category" data-filter="{{ $category->slug }}">
                                    {{ $category->name }}
                                    <span>{{ $category->products_count }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="sidebar-block">
                        <h3>Markalar</h3>

                        <div class="filter-list brand-filter-list">
                            <button class="filter-btn active" type="button" data-filter-group="brand" data-filter="all">
                                Tüm Markalar <span>{{ $allProductsCount }}</span>
                            </button>

                            @foreach($brands as $brand)
                                <button class="filter-btn" type="button" data-filter-group="brand" data-filter="{{ $brand->slug }}">
                                    {{ $brand->name }}
                                    <span>{{ $brand->products_count }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                </aside>

                <div class="shop-main">

                    <div class="shop-toolbar reveal">
                        <div>
                            <b id="productResult">{{ $allProductsCount }} ürün listeleniyor</b>
                            <span>Arama, kategori, marka ve sıralama aktif çalışır.</span>
                        </div>

                        <div class="toolbar-actions">
                            <form class="shop-search" id="productSearchForm">
                                <input type="search" id="productSearchInput" placeholder="Ürün ara...">
                                <button type="submit">Ara</button>
                            </form>

                            <select id="sortSelect">
                                <option value="default">Varsayılan</option>
                                <option value="priceAsc">Fiyat: Artan</option>
                                <option value="priceDesc">Fiyat: Azalan</option>
                                <option value="nameAsc">İsim: A-Z</option>
                            </select>
                        </div>
                    </div>

                    <div class="product-grid" id="productGrid">

                        @forelse($products as $product)

                            <article
                                class="product-card reveal"
                                data-category="{{ $product->category?->slug }}"
                                data-brand="{{ $product->brand?->slug }}"
                                data-name="{{ $product->name }}"
                                data-price="{{ $product->final_price }}"
                            >

                                <span class="product-label">
                                    {{ $product->is_featured ? 'Öne Çıkan' : 'Yeni' }}
                                </span>

                                <div class="product-actions">
                                    <button class="small-action" type="button">♡</button>

                                    <a class="small-action" href="{{ route('products.show', $product->slug) }}">
                                        ↗
                                    </a>
                                </div>

                                <a href="{{ route('products.show', $product->slug) }}" class="product-media">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                </a>

                                <div class="product-body">

                                    <div class="product-meta">
                                        <span>{{ $product->category?->name ?? 'Ürün' }}</span>
                                        <span>{{ $product->brand?->name ?? 'Eymen' }}</span>
                                    </div>

                                    <h3>{{ $product->name }}</h3>

                                    <p>
                                        {{ $product->short_description ?: 'Eymen Optik koleksiyonundan seçili ürün.' }}
                                    </p>

                                    <div class="specs">
                                        <span>{{ $product->gender === 'unisex' ? 'Unisex' : ucfirst($product->gender) }}</span>
                                        <span>{{ $product->stock > 0 ? 'Stokta' : 'Tükendi' }}</span>

                                        @if($product->discount_price)
                                            <span>İndirimli</span>
                                        @endif
                                    </div>

                                    <div class="price-row">
                                        <div>
                                            <strong>₺{{ number_format($product->final_price, 0, ',', '.') }}</strong>

                                            @if($product->discount_price)
                                                <small>₺{{ number_format($product->price, 0, ',', '.') }}</small>
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

                            <div class="empty-products">
                                Aktif ürün bulunamadı.
                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>
    </section>

</main>

@endsection

@section('page_css')

<style>
    .shop-page {
        background: #f6f6f6;
        padding-bottom: 70px;
    }

    .shop-hero {
        padding: 34px 0 24px;
    }

    .shop-hero-box {
        min-height: 270px;
        background:
            linear-gradient(90deg, rgba(0,0,0,.62), rgba(0,0,0,.12)),
            url('https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=1800&q=90');
        background-size: cover;
        background-position: center;
        color: #fff;
        display: flex;
        align-items: center;
        padding: 48px;
        overflow: hidden;
    }

    .shop-hero-box span {
        display: inline-block;
        background: #fff;
        color: #000;
        padding: 9px 15px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        margin-bottom: 18px;
    }

    .shop-hero-box h1 {
        font-size: clamp(42px, 5vw, 76px);
        line-height: .95;
        letter-spacing: -3px;
        max-width: 720px;
        margin-bottom: 16px;
    }

    .shop-hero-box p {
        max-width: 560px;
        line-height: 1.8;
        color: rgba(255,255,255,.8);
    }

    .shop-section {
        padding-top: 20px;
    }

    .shop-layout {
        display: grid;
        grid-template-columns: 290px 1fr;
        gap: 24px;
        align-items: start;
    }

    .shop-sidebar {
        position: sticky;
        top: 120px;
        background: #fff;
        border: 1px solid #eee;
        padding: 22px;
        box-shadow: 0 18px 45px rgba(0,0,0,.05);
    }

    .sidebar-block + .sidebar-block {
        margin-top: 24px;
        padding-top: 22px;
        border-top: 1px solid #eee;
    }

    .sidebar-block h3 {
        font-size: 18px;
        margin-bottom: 14px;
        font-weight: 900;
    }

    .filter-list {
        display: grid;
        gap: 9px;
    }

    .brand-filter-list {
        max-height: 330px;
        overflow-y: auto;
        padding-right: 6px;
    }

    .filter-btn {
        border: 1px solid #eee;
        background: #fff;
        padding: 13px 14px;
        display: flex;
        justify-content: space-between;
        gap: 12px;
        cursor: pointer;
        font-weight: 800;
        color: #333;
        transition: .22s ease;
        text-align: left;
    }

    .filter-btn span {
        color: #999;
        font-size: 12px;
        font-weight: 800;
    }

    .filter-btn.active,
    .filter-btn:hover {
        background: #000;
        color: #fff;
        border-color: #000;
    }

    .filter-btn.active span,
    .filter-btn:hover span {
        color: rgba(255,255,255,.7);
    }

    .shop-toolbar {
        background: #fff;
        border: 1px solid #eee;
        padding: 16px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        box-shadow: 0 18px 45px rgba(0,0,0,.04);
    }

    .shop-toolbar b {
        display: block;
        font-size: 18px;
        margin-bottom: 4px;
    }

    .shop-toolbar span {
        color: #777;
        font-size: 13px;
        font-weight: 600;
    }

    .toolbar-actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .shop-search {
        height: 46px;
        background: #f1f1f1;
        display: flex;
        overflow: hidden;
    }

    .shop-search input {
        width: 240px;
        border: 0;
        background: transparent;
        outline: 0;
        padding: 0 15px;
    }

    .shop-search button {
        width: 70px;
        border: 0;
        background: #000;
        color: #fff;
        font-weight: 900;
        cursor: pointer;
    }

    .toolbar-actions select {
        height: 46px;
        border: 1px solid #eee;
        background: #fff;
        padding: 0 14px;
        font-weight: 800;
        outline: 0;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .product-card {
        background: #fff;
        border: 1px solid #eee;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        min-height: 460px;
        transition: .28s ease;
    }

    .product-card:hover {
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

    .product-actions {
        position: absolute;
        top: 14px;
        right: 14px;
        z-index: 3;
        display: grid;
        gap: 8px;
    }

    .small-action {
        width: 38px;
        height: 38px;
        border: 1px solid #eee;
        background: rgba(255,255,255,.9);
        display: grid;
        place-items: center;
        cursor: pointer;
        font-weight: 900;
        transition: .22s ease;
    }

    .small-action:hover,
    .small-action.active {
        background: #000;
        color: #fff;
    }

    .product-media {
        height: 250px;
        background: #fafafa;
        padding: 28px;
        display: grid;
        place-items: center;
        overflow: hidden;
    }

    .product-media img {
        height: 100%;
        object-fit: contain;
        transition: .3s ease;
    }

    .product-card:hover .product-media img {
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
        gap: 10px;
        color: #888;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 9px;
    }

    .product-body h3 {
        color: #111;
        font-size: 18px;
        line-height: 1.35;
        margin-bottom: 10px;
    }

    .product-body p {
        color: #777;
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 14px;
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
        color: #333;
        font-size: 11px;
        font-weight: 900;
    }

    .price-row {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
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

    .empty-products {
        grid-column: 1 / -1;
        background: #fff;
        padding: 36px;
        text-align: center;
        color: #777;
        font-weight: 700;
    }

    .no-result {
        grid-column: 1 / -1;
        background: #fff;
        padding: 36px;
        text-align: center;
        color: #777;
        font-weight: 700;
        display: none;
    }

    @media(max-width: 1200px) {
        .shop-layout {
            grid-template-columns: 1fr;
        }

        .shop-sidebar {
            position: relative;
            top: 0;
        }

        .filter-list {
            grid-template-columns: repeat(3, 1fr);
        }

        .product-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .shop-toolbar {
            align-items: flex-start;
            flex-direction: column;
        }

        .toolbar-actions {
            width: 100%;
        }

        .shop-search {
            flex: 1;
        }

        .shop-search input {
            width: 100%;
        }
    }

    @media(max-width: 680px) {
        .shop-hero-box {
            padding: 30px;
            min-height: 230px;
        }

        .shop-hero-box h1 {
            font-size: 40px;
        }

        .filter-list,
        .product-grid,
        .toolbar-actions {
            grid-template-columns: 1fr;
            flex-direction: column;
        }

        .shop-search,
        .toolbar-actions select {
            width: 100%;
        }

        .product-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@endsection

@section('page_js')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryButtons = document.querySelectorAll('[data-filter-group="category"]');
        const brandButtons = document.querySelectorAll('[data-filter-group="brand"]');
        const productGrid = document.getElementById('productGrid');
        const productCards = Array.from(document.querySelectorAll('.product-card'));
        const productResult = document.getElementById('productResult');
        const sortSelect = document.getElementById('sortSelect');
        const searchForm = document.getElementById('productSearchForm');
        const searchInput = document.getElementById('productSearchInput');

        let activeCategoryFilter = 'all';
        let activeBrandFilter = 'all';
        let activeSearch = '';

        const noResult = document.createElement('div');
        noResult.className = 'no-result';
        noResult.textContent = 'Filtreye uygun ürün bulunamadı.';
        productGrid?.appendChild(noResult);

        categoryButtons.forEach(button => {
            button.addEventListener('click', function () {
                categoryButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                activeCategoryFilter = button.dataset.filter || 'all';

                applyProducts();
            });
        });

        brandButtons.forEach(button => {
            button.addEventListener('click', function () {
                brandButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                activeBrandFilter = button.dataset.filter || 'all';

                applyProducts();
            });
        });

        searchForm?.addEventListener('submit', function (e) {
            e.preventDefault();

            activeSearch = searchInput.value.trim().toLocaleLowerCase('tr-TR');

            applyProducts();
        });

        searchInput?.addEventListener('input', function () {
            activeSearch = searchInput.value.trim().toLocaleLowerCase('tr-TR');

            applyProducts();
        });

        sortSelect?.addEventListener('change', applyProducts);

        function applyProducts() {
            let visibleCards = productCards.filter(card => {
                const categoryMatch =
                    activeCategoryFilter === 'all'
                    || card.dataset.category === activeCategoryFilter;

                const brandMatch =
                    activeBrandFilter === 'all'
                    || card.dataset.brand === activeBrandFilter;

                const searchMatch =
                    !activeSearch
                    || (card.dataset.name || '')
                        .toLocaleLowerCase('tr-TR')
                        .includes(activeSearch)
                    || card.innerText
                        .toLocaleLowerCase('tr-TR')
                        .includes(activeSearch);

                return categoryMatch && brandMatch && searchMatch;
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

            if (noResult) {
                noResult.style.display = visibleCards.length === 0 ? 'block' : 'none';
                productGrid.appendChild(noResult);
            }

            if (productResult) {
                productResult.textContent = `${visibleCards.length} ürün listeleniyor`;
            }
        }

        document.addEventListener('click', function (e) {
            const favoriteButton = e.target.closest('.small-action');

            if (!favoriteButton) return;

            if (favoriteButton.tagName.toLowerCase() === 'a') return;

            favoriteButton.classList.toggle('active');
        });

        applyProducts();
    });
</script>

@endsection