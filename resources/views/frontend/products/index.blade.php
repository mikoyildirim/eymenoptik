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

                        <div class="filter-list filter-scroll">
                            <button class="filter-btn active" type="button" data-filter-group="category"
                                data-filter="all" data-label="Tüm Ürünler">
                                Tüm Ürünler <span>{{ $allProductsCount }}</span>
                            </button>

                            @foreach($categories as $category)
                            <button class="filter-btn" type="button" data-filter-group="category"
                                data-filter="{{ $category->slug }}" data-label="{{ $category->name }}">
                                {{ $category->name }}
                                <span>{{ $category->products_count }}</span>
                            </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="sidebar-block">
                        <h3>Markalar</h3>

                        <div class="filter-list filter-scroll">
                            <button class="filter-btn active" type="button" data-filter-group="brand" data-filter="all"
                                data-label="Tüm Markalar">
                                Tüm Markalar <span>{{ $allProductsCount }}</span>
                            </button>

                            @foreach($brands as $brand)
                            <button class="filter-btn" type="button" data-filter-group="brand"
                                data-filter="{{ $brand->slug }}" data-label="{{ $brand->name }}">
                                {{ $brand->name }}
                                <span>{{ $brand->products_count }}</span>
                            </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="sidebar-block">
                        <h3>Çerçeve Rengi</h3>

                        <div class="filter-list filter-scroll">
                            <button class="filter-btn active" type="button" data-filter-group="frame_color"
                                data-filter="all" data-label="Tümü">Tümü</button>
                            @foreach(['siyah'=>'Siyah','beyaz'=>'Beyaz','kahverengi'=>'Kahverengi','fume'=>'Füme','saydam'=>'Şeffaf','altin'=>'Altın','gumus'=>'Gümüş','kirmizi'=>'Kırmızı','mavi'=>'Mavi','yesil'=>'Yeşil','karisik'=>'Karışık
                            Renkler']
                            as $key => $label)
                            <button class="filter-btn" type="button" data-filter-group="frame_color"
                                data-filter="{{ $key }}" data-label="{{ $label }}">{{ $label }}</button>
                            @endforeach
                        </div>
                    </div>

                    <div class="sidebar-block">
                        <h3>Cam Rengi</h3>

                        <div class="filter-list filter-scroll">
                            <button class="filter-btn active" type="button" data-filter-group="glass_color"
                                data-filter="all" data-label="Tümü">Tümü</button>
                            @foreach(['siyah'=>'Siyah','beyaz'=>'Beyaz','kahverengi'=>'Kahverengi','fume'=>'Füme','saydam'=>'Şeffaf','altin'=>'Altın','gumus'=>'Gümüş','kirmizi'=>'Kırmızı','mavi'=>'Mavi','yesil'=>'Yeşil','karisik'=>'Karışık
                            Renkler']
                            as $key => $label)
                            <button class="filter-btn" type="button" data-filter-group="glass_color"
                                data-filter="{{ $key }}" data-label="{{ $label }}">{{ $label }}</button>
                            @endforeach
                        </div>
                    </div>

                    <div class="sidebar-block">
                        <h3>Cinsiyet</h3>

                        <div class="filter-list filter-scroll">
                            <button class="filter-btn active" type="button" data-filter-group="gender" data-filter="all"
                                data-label="Tümü">Tümü</button>
                            @foreach(['unisex'=>'Unisex','erkek'=>'Erkek','kadin'=>'Kadın','cocuk'=>'Çocuk'] as $key =>
                            $label)
                            <button class="filter-btn" type="button" data-filter-group="gender" data-filter="{{ $key }}"
                                data-label="{{ $label }}">{{ $label }}</button>
                            @endforeach
                        </div>
                    </div>

                </aside>

                <div class="shop-main">

                    <div class="shop-toolbar reveal">
                        <div>
                            <b id="productResult">{{ $allProductsCount }} ürün listeleniyor</b>
                            <span>Arama, kategori, marka, renk, cinsiyet ve sıralama aktif çalışır.</span>
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

                    <div class="filter-summary-bar reveal">
                        <div>
                            <span>Aktif filtreler</span>
                            <strong id="activeFilterText">Tüm ürünler</strong>
                        </div>

                        <button type="button" id="resetFiltersBtn">Filtreleri Temizle</button>
                    </div>

                    <div class="product-grid" id="productGrid">

                        @forelse($products as $product)

                        <article class="product-card reveal" data-category="{{ $product->category?->slug }}"
                            data-brand="{{ $product->brand?->slug }}" data-name="{{ $product->name }}"
                            data-price="{{ $product->final_price }}" data-frame-color="{{ $product->frame_color }}"
                            data-glass-color="{{ $product->glass_color }}" data-gender="{{ $product->gender }}">

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

                                    <button class="add-cart js-add-cart" type="button" data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}" data-price="{{ $product->final_price }}"
                                        data-img="{{ $product->image_url }}"
                                        {{ $product->stock <= 0 ? 'disabled' : '' }}>
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

                    @section('page_js')
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const productGrid = document.getElementById('productGrid');
                        const productCards = Array.from(document.querySelectorAll(
                            '#productGrid .product-card'));
                        const productResult = document.getElementById('productResult');
                        const activeFilterText = document.getElementById('activeFilterText');
                        const resetFiltersBtn = document.getElementById('resetFiltersBtn');
                        const sortSelect = document.getElementById('sortSelect');
                        const searchForm = document.getElementById('productSearchForm');
                        const searchInput = document.getElementById('productSearchInput');
                        const filterButtons = Array.from(document.querySelectorAll(
                            '.filter-btn[data-filter-group]'));

                        const filterGroups = ['category', 'brand', 'frame_color', 'glass_color', 'gender'];
                        const activeFilters = Object.fromEntries(filterGroups.map(group => [group, []]));
                        let activeSearch = '';

                        const noResult = document.createElement('div');
                        noResult.className = 'no-result';
                        noResult.textContent = 'Filtreye uygun ürün bulunamadı.';
                        productGrid?.appendChild(noResult);

                        function normalize(value) {
                            return (value || '').toString().trim().toLocaleLowerCase('tr-TR');
                        }

                        function getButtonLabel(button) {
                            return button.dataset.label || button.textContent.trim().replace(/\s+/g, ' ');
                        }

                        function setGroupState(group) {
                            const groupButtons = document.querySelectorAll(
                                `.filter-btn[data-filter-group="${group}"]`);
                            const selectedValues = activeFilters[group];
                            const hasSelection = selectedValues.length > 0;

                            groupButtons.forEach(button => {
                                const value = button.dataset.filter;
                                const isAll = value === 'all';
                                const isActive = isAll ? !hasSelection : selectedValues.includes(value);

                                button.classList.toggle('active', isActive);
                            });
                        }

                        function updateAllButton(group) {
                            const selectedValues = activeFilters[group];
                            const groupButtons = document.querySelectorAll(
                                `.filter-btn[data-filter-group="${group}"]`);
                            const allButton = Array.from(groupButtons).find(button => button.dataset.filter ===
                                'all');

                            if (allButton) {
                                allButton.classList.toggle('active', selectedValues.length === 0);
                            }
                        }

                        function updateFilterSummary() {
                            const parts = [];

                            filterGroups.forEach(group => {
                                const selectedValues = activeFilters[group];

                                if (selectedValues.length === 0) {
                                    return;
                                }

                                const labels = selectedValues.map(value => {
                                    const button = document.querySelector(
                                        `.filter-btn[data-filter-group="${group}"][data-filter="${CSS.escape(value)}"]`
                                    );

                                    return button ? getButtonLabel(button) : value;
                                });

                                const groupLabel = {
                                    category: 'Kategori',
                                    brand: 'Marka',
                                    frame_color: 'Çerçeve',
                                    glass_color: 'Cam',
                                    gender: 'Cinsiyet'
                                } [group] || group;

                                parts.push(`${groupLabel}: ${labels.join(', ')}`);
                            });

                            if (activeSearch) {
                                parts.push(`Arama: ${searchInput?.value?.trim() || ''}`.trim());
                            }

                            if (activeFilterText) {
                                activeFilterText.textContent = parts.length ? parts.join(' • ') : 'Tüm ürünler';
                            }
                        }

                        function matchesGroupFilter(card, group) {
                            const selectedValues = activeFilters[group];

                            if (!selectedValues || selectedValues.length === 0) {
                                return true;
                            }

                            const cardValue = normalize(card.dataset[group]);
                            return selectedValues.some(value => normalize(value) === cardValue);
                        }

                        function applyFilters() {
                            const sort = sortSelect?.value || 'default';

                            let visibleCards = productCards.filter(card => {
                                const searchText = normalize(
                                    `${card.dataset.name || ''} ${card.dataset.category || ''} ${card.dataset.brand || ''} ${card.dataset.frameColor || ''} ${card.dataset.glassColor || ''} ${card.dataset.gender || ''}`
                                );
                                const searchMatch = !activeSearch || searchText.includes(activeSearch);
                                const filterMatch = filterGroups.every(group => matchesGroupFilter(card,
                                    group));

                                return searchMatch && filterMatch;
                            });

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

                            updateFilterSummary();
                        }

                        filterButtons.forEach(button => {
                            button.addEventListener('click', function() {
                                const group = this.dataset.filterGroup;
                                const value = this.dataset.filter || 'all';
                                const selectedValues = activeFilters[group] || [];

                                if (value === 'all') {
                                    activeFilters[group] = [];
                                    setGroupState(group);
                                    applyFilters();
                                    return;
                                }

                                if (selectedValues.includes(value)) {
                                    activeFilters[group] = selectedValues.filter(item =>
                                        item !== value);
                                } else {
                                    activeFilters[group] = [...selectedValues, value];
                                }

                                setGroupState(group);
                                updateAllButton(group);
                                applyFilters();
                            });
                        });

                        searchForm?.addEventListener('submit', function(e) {
                            e.preventDefault();
                            activeSearch = normalize(searchInput?.value || '');
                            applyFilters();
                        });

                        searchInput?.addEventListener('input', function() {
                            activeSearch = normalize(this.value || '');
                            applyFilters();
                        });

                        sortSelect?.addEventListener('change', applyFilters);

                        resetFiltersBtn?.addEventListener('click', function() {
                            filterGroups.forEach(group => {
                                activeFilters[group] = [];
                                setGroupState(group);
                            });

                            activeSearch = '';

                            if (searchInput) {
                                searchInput.value = '';
                            }

                            if (sortSelect) {
                                sortSelect.value = 'default';
                            }

                            applyFilters();
                        });

                        document.addEventListener('click', function(e) {
                            const favoriteButton = e.target.closest('.small-action');

                            if (!favoriteButton) return;

                            if (favoriteButton.tagName.toLowerCase() === 'a') return;

                            favoriteButton.classList.toggle('active');
                        });

                        filterGroups.forEach(group => setGroupState(group));
                        applyFilters();
                    });
                    </script>
                    @endsection

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
        linear-gradient(90deg, rgba(0, 0, 0, .62), rgba(0, 0, 0, .12)),
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
    color: rgba(255, 255, 255, .8);
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
    padding: 18px;
    box-shadow: 0 18px 45px rgba(0, 0, 0, .05);
}

.sidebar-block+.sidebar-block {
    margin-top: 24px;
    padding-top: 22px;
    border-top: 1px solid #eee;
}

.sidebar-block h3 {
    font-size: 15px;
    margin-bottom: 10px;
    font-weight: 900;
}

.filter-list {
    display: grid;
    gap: 7px;
}

.filter-scroll {
    max-height: 220px;
    overflow-y: auto;
    padding-right: 4px;
}

.filter-btn {
    border: 1px solid #eee;
    background: #fff;
    padding: 10px 12px;
    display: flex;
    justify-content: space-between;
    gap: 12px;
    cursor: pointer;
    font-weight: 700;
    font-size: 12px;
    color: #333;
    transition: .22s ease;
    text-align: left;
    border-radius: 12px;
    line-height: 1.2;
}

.filter-btn span {
    color: #999;
    font-size: 11px;
    font-weight: 700;
}

.filter-btn.active,
.filter-btn:hover {
    background: #000;
    color: #fff;
    border-color: #000;
}

.filter-btn.active span,
.filter-btn:hover span {
    color: rgba(255, 255, 255, .7);
}

.shop-toolbar {
    background: #fff;
    border: 1px solid #eee;
    padding: 14px 16px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    box-shadow: 0 18px 45px rgba(0, 0, 0, .04);
}

.shop-toolbar b {
    display: block;
    font-size: 16px;
    margin-bottom: 4px;
}

.shop-toolbar span {
    color: #777;
    font-size: 12px;
    font-weight: 600;
}

.filter-summary-bar {
    background: #fff;
    border: 1px solid #eee;
    padding: 12px 16px;
    margin-bottom: 18px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    box-shadow: 0 18px 45px rgba(0, 0, 0, .03);
}

.filter-summary-bar span {
    display: block;
    color: #888;
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 4px;
    text-transform: uppercase;
    letter-spacing: .08em;
}

.filter-summary-bar strong {
    font-size: 14px;
}

#resetFiltersBtn {
    border: 0;
    background: #f1f1f1;
    color: #111;
    height: 38px;
    padding: 0 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 800;
    cursor: pointer;
}

.toolbar-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

.shop-search {
    height: 42px;
    background: #f1f1f1;
    display: flex;
    overflow: hidden;
    border-radius: 999px;
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
    height: 42px;
    border: 1px solid #eee;
    background: #fff;
    padding: 0 12px;
    font-weight: 700;
    outline: 0;
    border-radius: 999px;
    font-size: 12px;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}

.product-card {
    background: #fff;
    border: 1px solid #eee;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    min-height: 420px;
    transition: .28s ease;
}

.product-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 24px 70px rgba(0, 0, 0, .1);
}

.product-label {
    position: absolute;
    top: 12px;
    left: 12px;
    z-index: 3;
    background: #000;
    color: #fff;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 10px;
    font-weight: 800;
}

.product-actions {
    position: absolute;
    top: 12px;
    right: 12px;
    z-index: 3;
    display: grid;
    gap: 8px;
}

.small-action {
    width: 34px;
    height: 34px;
    border: 1px solid #eee;
    background: rgba(255, 255, 255, .9);
    display: grid;
    place-items: center;
    cursor: pointer;
    font-weight: 900;
    font-size: 13px;
    transition: .22s ease;
}

.small-action:hover,
.small-action.active {
    background: #000;
    color: #fff;
}

.product-media {
    height: 210px;
    background: #fafafa;
    padding: 22px;
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
    padding: 16px;
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
    font-size: 16px;
    line-height: 1.35;
    margin-bottom: 8px;
}

.product-body p {
    color: #777;
    font-size: 12px;
    line-height: 1.6;
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
    padding: 6px 8px;
    border-radius: 999px;
    color: #333;
    font-size: 10px;
    font-weight: 800;
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
    font-size: 19px;
    color: #000;
    font-weight: 900;
}

.price-row small {
    color: #999;
    text-decoration: line-through;
    font-weight: 700;
}

.add-cart {
    width: 42px;
    height: 42px;
    border: 0;
    background: #000;
    color: #fff;
    font-size: 18px;
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
    padding: 28px;
    text-align: center;
    color: #777;
    font-weight: 700;
}

.no-result {
    grid-column: 1 / -1;
    background: #fff;
    padding: 28px;
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
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .filter-scroll {
        max-height: 190px;
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

    .filter-summary-bar {
        align-items: flex-start;
    }
}

@media(max-width: 992px) {
    .toolbar-actions {
        flex-wrap: wrap;
    }

    .shop-search,
    .toolbar-actions select {
        width: 100%;
    }

    .shop-search input {
        width: 100%;
    }

    .filter-summary-bar {
        flex-direction: column;
        align-items: stretch;
    }

    #resetFiltersBtn {
        width: 100%;
    }
}

@media(max-width: 768px) {
    .shop-hero-box {
        padding: 24px;
        min-height: 210px;
    }

    .shop-hero-box h1 {
        font-size: 32px;
        letter-spacing: -1.8px;
    }

    .shop-toolbar {
        padding: 12px;
    }

    .shop-toolbar b {
        font-size: 15px;
    }

    .shop-toolbar span {
        font-size: 11px;
    }

    .filter-list,
    .product-grid {
        grid-template-columns: 1fr;
    }

    .toolbar-actions {
        flex-direction: column;
    }

    .filter-scroll {
        max-height: 155px;
    }

    .filter-btn {
        padding: 9px 10px;
        font-size: 11px;
    }

    .shop-search,
    .toolbar-actions select,
    .shop-search input,
    #resetFiltersBtn {
        width: 100%;
    }

    .product-grid {
        grid-template-columns: 1fr;
    }

    .product-card {
        min-height: 390px;
    }

    .product-media {
        height: 190px;
        padding: 18px;
    }

    .product-body {
        padding: 14px;
    }

    .product-body h3 {
        font-size: 15px;
    }

    .product-body p {
        font-size: 11px;
    }

    .price-row strong {
        font-size: 17px;
    }

    .add-cart {
        width: 40px;
        height: 40px;
        font-size: 17px;
    }

    .filter-summary-bar {
        padding: 12px;
    }
}

@media(max-width: 480px) {
    .shop-page {
        padding-bottom: 56px;
    }

    .shop-hero {
        padding: 26px 0 18px;
    }

    .shop-hero-box span {
        padding: 8px 12px;
        font-size: 11px;
        margin-bottom: 12px;
    }

    .shop-hero-box p {
        line-height: 1.65;
        font-size: 13px;
    }

    .sidebar-block h3 {
        font-size: 14px;
    }

    .filter-btn {
        padding: 8px 10px;
        border-radius: 10px;
    }

    .shop-toolbar,
    .filter-summary-bar {
        gap: 12px;
    }

    .shop-search button {
        width: 62px;
        font-size: 12px;
    }

    .toolbar-actions select {
        font-size: 11px;
    }

    .product-card {
        min-height: 372px;
    }

    .product-label {
        left: 10px;
        top: 10px;
    }

    .product-actions {
        right: 10px;
        top: 10px;
    }

    .specs {
        gap: 6px;
    }

    .specs span {
        font-size: 9px;
    }
}
</style>

@endsection

@section('page_js')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productGrid = document.getElementById('productGrid');
    const productCards = Array.from(document.querySelectorAll('.product-card'));
    const filterButtons = Array.from(document.querySelectorAll('.filter-btn[data-filter-group]'));
    const productResult = document.getElementById('productResult');
    const activeFilterText = document.getElementById('activeFilterText');
    const resetFiltersBtn = document.getElementById('resetFiltersBtn');
    const sortSelect = document.getElementById('sortSelect');
    const searchForm = document.getElementById('productSearchForm');
    const searchInput = document.getElementById('productSearchInput');

    const filterGroups = ['category', 'brand', 'frame_color', 'glass_color', 'gender'];
    const activeFilters = Object.fromEntries(filterGroups.map(group => [group, 'all']));
    let activeSearch = '';

    const noResult = document.createElement('div');
    noResult.className = 'no-result';
    noResult.textContent = 'Filtreye uygun ürün bulunamadı.';
    productGrid?.appendChild(noResult);

    function getActiveButtonLabel(group) {
        const activeButton = document.querySelector(`.filter-btn[data-filter-group="${group}"].active`);
        if (!activeButton) return null;

        if (activeButton.dataset.filter === 'all') {
            return null;
        }

        return activeButton.dataset.label || activeButton.textContent.trim();
    }

    function updateFilterSummary() {
        const labels = [];

        filterGroups.forEach(group => {
            const label = getActiveButtonLabel(group);
            if (label) labels.push(label);
        });

        if (activeSearch) {
            labels.push(`Arama: ${searchInput?.value?.trim() || ''}`.trim());
        }

        activeFilterText.textContent = labels.length ? labels.join(' • ') : 'Tüm ürünler';
    }

    function setActiveButton(group, value) {
        document.querySelectorAll(`.filter-btn[data-filter-group="${group}"]`).forEach(btn => {
            btn.classList.toggle('active', btn.dataset.filter === value);
        });
    }

    function matchesFilter(card, group, value) {
        if (!value || value === 'all') return true;

        const cardValue = (card.dataset[group] || '').toString().trim().toLowerCase('tr-TR');
        return cardValue === value.toString().trim().toLowerCase('tr-TR');
    }

    function applyProducts() {
        const sort = sortSelect?.value || 'default';

        let visibleCards = productCards.filter(card => {
            const matchesAllFilters = filterGroups.every(group => matchesFilter(card, group,
                activeFilters[group]));

            const searchText =
                `${card.dataset.name || ''} ${card.dataset.category || ''} ${card.dataset.brand || ''}`
                .toLocaleLowerCase('tr-TR');
            const searchMatch = !activeSearch || searchText.includes(activeSearch);

            return matchesAllFilters && searchMatch;
        });

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

        updateFilterSummary();
    }

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const group = this.dataset.filterGroup;
            const value = this.dataset.filter || 'all';

            activeFilters[group] = value;
            setActiveButton(group, value);
            applyProducts();
        });
    });

    searchForm?.addEventListener('submit', function(e) {
        e.preventDefault();
        activeSearch = searchInput.value.trim().toLocaleLowerCase('tr-TR');
        applyProducts();
    });

    searchInput?.addEventListener('input', function() {
        activeSearch = searchInput.value.trim().toLocaleLowerCase('tr-TR');
        applyProducts();
    });

    sortSelect?.addEventListener('change', applyProducts);

    resetFiltersBtn?.addEventListener('click', function() {
        filterGroups.forEach(group => {
            activeFilters[group] = 'all';
            setActiveButton(group, 'all');
        });

        activeSearch = '';

        if (searchInput) {
            searchInput.value = '';
        }

        if (sortSelect) {
            sortSelect.value = 'default';
        }

        applyProducts();
    });

    document.addEventListener('click', function(e) {
        const favoriteButton = e.target.closest('.small-action');

        if (!favoriteButton) return;

        if (favoriteButton.tagName.toLowerCase() === 'a') return;

        favoriteButton.classList.toggle('active');
    });

    applyProducts();
});
</script>

@endsection