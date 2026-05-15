<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Eymen Optik')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .main-menu{
    display:flex;
    align-items:center;
    gap:28px;
    flex-wrap:wrap;
}

.menu-link{
    position:relative;
    font-size:15px;
    font-weight:800;
    color:#111;
    transition:.25s ease;
}

.menu-link::after{
    content:"";
    position:absolute;
    left:0;
    bottom:-8px;
    width:0;
    height:2px;
    background:#c79a3a;
    transition:.25s ease;
}

.menu-link:hover{
    color:#c79a3a;
}

.menu-link:hover::after{
    width:100%;
}

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fff;
            color: #111;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            width: 100%;
            display: block;
        }

        button,
        input {
            font-family: inherit;
        }

        .container {
            width: min(1510px, calc(100% - 70px));
            margin: auto;
        }

        .top-sale {
            background: #f1f2f4;
            min-height: 70px;
            display: flex;
            align-items: center;
        }

        .top-sale-inner {
            display: grid;
            grid-template-columns: 180px 1fr 280px;
            align-items: center;
            gap: 20px;
        }

        .top-sale-logo {
            font-size: 21px;
            line-height: 1;
            font-weight: 900;
        }

        .top-sale-logo span {
            display: block;
            color: #aaa;
            font-style: italic;
        }

        .top-sale-text {
            text-align: center;
            font-size: 42px;
            font-weight: 900;
            letter-spacing: -1px;
        }

        .top-sale-text span {
            font-weight: 300;
        }

        .app-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .app-buttons div {
            background: #000;
            color: #fff;
            border-radius: 7px;
            padding: 8px 14px;
            font-size: 12px;
            font-weight: 700;
        }

        .info-bar {
            padding: 18px 0;
            border-bottom: 1px solid #eee;
        }

        .info-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            font-size: 14px;
        }

        .info-left,
        .info-right {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .login-btn {
            background: #000;
            color: #fff;
            padding: 11px 20px;
            font-weight: 700;
        }

        .main-header {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
            background: rgba(255,255,255,.96);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(16px);
        }

        .header-inner {
            display: grid;
            grid-template-columns: 200px 1fr 430px;
            align-items: center;
            gap: 25px;
        }

        .logo {
            font-size: 38px;
            letter-spacing: 12px;
            font-weight: 900;
            line-height: 1;
        }

        .logo small {
            display: block;
            font-size: 16px;
            letter-spacing: 9px;
            font-weight: 600;
            margin-left: 44px;
        }

        .menu {
            display: flex;
            align-items: center;
            gap: 24px;
            font-size: 14px;
            font-weight: 700;
            white-space: nowrap;
        }

        .menu a {
            transition: .22s ease;
        }

        .menu a:hover {
            color: #c79a3a;
        }

        .search-area {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .search-box {
            flex: 1;
            background: #eee;
            border-radius: 999px;
            display: flex;
            overflow: hidden;
            height: 46px;
        }

        .search-box input {
            flex: 1;
            border: 0;
            background: transparent;
            outline: 0;
            padding: 0 22px;
        }

        .search-box button {
            width: 54px;
            border: 0;
            background: #000;
            color: #fff;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
        }

        .head-icon {
            font-size: 27px;
            position: relative;
        }

        .count {
            position: absolute;
            top: -9px;
            right: -11px;
            background: #000;
            color: #fff;
            width: 21px;
            height: 21px;
            border-radius: 50%;
            font-size: 12px;
            display: grid;
            place-items: center;
        }

        .footer {
            background: #070707;
            color: #fff;
            padding: 55px 0 25px;
            margin-top: 60px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.3fr repeat(4, 1fr);
            gap: 35px;
            padding-bottom: 35px;
            border-bottom: 1px solid rgba(255,255,255,.12);
        }

        .footer h3 {
            margin-bottom: 16px;
            font-size: 17px;
        }

        .footer p,
        .footer a {
            display: block;
            color: rgba(255,255,255,.65);
            line-height: 1.9;
            font-size: 14px;
        }

        .footer a:hover {
            color: #fff;
        }

        .copyright {
            padding-top: 22px;
            display: flex;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            color: rgba(255,255,255,.5);
            font-size: 13px;
        }

        .reveal {
            opacity: 0;
            transform: translateY(34px);
            transition: .8s ease;
        }

        .reveal.show {
            opacity: 1;
            transform: translateY(0);
        }

        .cart-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            opacity: 0;
            visibility: hidden;
            z-index: 998;
            transition: .3s;
        }

        .cart-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .cart-drawer {
            position: fixed;
            top: 0;
            right: -430px;
            width: min(420px,100%);
            height: 100vh;
            background: #fff;
            z-index: 999;
            box-shadow: -30px 0 80px rgba(0,0,0,.18);
            transition: .35s ease;
            display: flex;
            flex-direction: column;
        }

        .cart-drawer.active {
            right: 0;
        }

        .cart-head {
            padding: 24px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-head h3 {
            font-size: 28px;
            font-weight: 900;
        }

        .cart-head span {
            color: #888;
            font-size: 13px;
        }

        #cartClose {
            width: 42px;
            height: 42px;
            border: 0;
            background: #000;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
        }

        .cart-list {
            flex: 1;
            overflow: auto;
            padding: 20px;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 74px 1fr auto;
            gap: 12px;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #eee;
        }

        .cart-item img {
            height: 70px;
            object-fit: contain;
            background: #f6f6f6;
        }

        .cart-item h4 {
            font-size: 14px;
            margin-bottom: 6px;
        }

        .cart-item-price {
            font-size: 13px;
            color: #777;
            font-weight: 700;
        }

        .cart-qty {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-top: 8px;
        }

        .cart-qty button,
        .cart-remove {
            width: 28px;
            height: 28px;
            border: 0;
            background: #f1f1f1;
            cursor: pointer;
            font-weight: 900;
        }

        .cart-remove {
            background: #fff0f0;
            color: #d22;
        }

        .cart-bottom {
            padding: 22px;
            border-top: 1px solid #eee;
        }

        .cart-total-row {
            display: flex;
            justify-content: space-between;
            font-size: 22px;
            font-weight: 900;
            margin-bottom: 16px;
        }

        .checkout-btn {
            width: 100%;
            height: 52px;
            border: 0;
            background: #000;
            color: #fff;
            font-weight: 900;
            cursor: pointer;
        }

        @media(max-width: 1200px) {
            .top-sale-inner,
            .header-inner {
                grid-template-columns: 1fr;
            }

            .top-sale {
                height: auto;
                padding: 16px 0;
            }

            .top-sale-text {
                font-size: 28px;
            }

            .app-buttons {
                justify-content: flex-start;
            }

            .menu {
                overflow-x: auto;
                padding-bottom: 6px;
            }
        }

        @media(max-width: 768px) {
            .container {
                width: min(100% - 28px, 1510px);
            }

            .top-sale-logo,
            .app-buttons,
            .info-left {
                display: none;
            }

            .top-sale-text {
                font-size: 22px;
            }

            .info-inner {
                justify-content: center;
            }

            .info-right {
                gap: 12px;
                font-size: 12px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .header-inner {
                gap: 16px;
            }

            .logo {
                font-size: 30px;
            }

            .search-area {
                gap: 10px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @yield('page_css')
</head>

<body>

<div class="top-sale">
    <div class="container top-sale-inner">
        <div class="top-sale-logo">
            FARKLI <span>GÖRÜN</span>
        </div>

        <div class="top-sale-text">
            %25 İNDİRİM <span>- EK %10 YENİ ÜYE İNDİRİMİ SİZİNLE!</span>
        </div>

        <div class="app-buttons">
            <div>Google Play</div>
            <div>App Store</div>
        </div>
    </div>
</div>

<div class="info-bar">
    <div class="container info-inner">
        <div class="info-left">
            <span>☎ 0555 000 00 00</span>
            <span>✉ info@eymenoptik.com.tr</span>
        </div>

        <div class="info-right">
            <a href="#">Facebook</a>
            <a href="#">Instagram</a>
            <a href="#">Twitter</a>

            @auth
                <a href="{{ route('account') }}" class="login-btn">Hesabım</a>
            @else
                <a href="{{ route('login') }}" class="login-btn">Giriş Yap</a>
            @endauth

            <span>TR⌄</span>
        </div>
    </div>
</div>

<header class="main-header">
    <div class="container header-inner">
      <a href="{{ route('home') }}" class="logo">
    <img src="{{ asset('images/eymen.svg') }}" alt="Eymen Optik">
</a>

  <nav class="main-menu">

    {{-- Dinamik Kategoriler --}}
    @isset($categories)
        @foreach($categories as $category)
            <a
                href="{{ route('products.index', ['category' => $category->slug]) }}"
                class="menu-link"
            >
                {{ $category->name }}
            </a>
        @endforeach
    @endisset

    {{-- Sabit Menü --}}
    <a href="{{ route('blog.index') }}" class="menu-link">
        Blog
    </a>

    <a href="{{ route('brands.index') }}" class="menu-link">
        Markalar
    </a>

    <a href="{{ route('contact') }}" class="menu-link">
        İletişim
    </a>

</nav>
        <div class="search-area">
            <form class="search-box" action="{{ route('products.index') }}" method="GET">
                <input type="text" name="q" placeholder="Aramak istediğiniz ürünü yazınız......">
                <button type="submit">⌕</button>
            </form>

            <a href="#" class="head-icon">♡</a>
            <a href="#" class="head-icon" id="cartOpenBtn">🛍<span class="count">0</span></a>
        </div>
    </div>
</header>

@yield('content')

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <h3>Eymen Optik</h3>
                <p>Modern, güvenilir ve premium optik alışveriş deneyimi.</p>
            </div>

            <div>
                <h3>Kategoriler</h3>
                <a href="{{ route('products.index') }}">Güneş Gözlükleri</a>
                <a href="{{ route('products.index') }}">Optik Gözlükler</a>
                <a href="{{ route('products.index') }}">Lensler</a>
            </div>

            <div>
                <h3>Mağaza</h3>
                <a href="#">Kampanyalar</a>
                <a href="#">Çok Satanlar</a>
                <a href="#">Yeni Sezon</a>
            </div>

            <div>
                <h3>Destek</h3>
                <a href="#">Sipariş Takibi</a>
                <a href="#">İade Politikası</a>
                <a href="#">Sık Sorulanlar</a>
            </div>

            <div>
                <h3>İletişim</h3>
                <p>0555 000 00 00</p>
                <p>info@eymenoptik.com.tr</p>
                <p>Sivas / Merkez</p>
            </div>
        </div>

        <div class="copyright">
            <span>© 2026 Eymen Optik. Tüm hakları saklıdır.</span>
            <span>Website by MK Digital</span>
        </div>
    </div>
</footer>

<div class="cart-overlay" id="cartOverlay"></div>

<aside class="cart-drawer" id="cartDrawer">
    <div class="cart-head">
        <div>
            <h3>Sepetim</h3>
            <span id="cartSubText">Sepetinizde ürün yok</span>
        </div>

        <button type="button" id="cartClose">×</button>
    </div>

    <div class="cart-list" id="cartList"></div>

    <div class="cart-bottom">
        <div class="cart-total-row">
            <span>Toplam</span>
            <strong id="cartTotal">₺0</strong>
        </div>

     @auth

<a href="{{ route('checkout.index') }}" class="btn-checkout">
    Ödemeye Geç
</a>

@else

<a href="{{ route('login') }}" class="btn-checkout">
    Giriş Yap ve Devam Et
</a>

@endauth
    </div>
</aside>

@yield('page_js')

<script>
    const revealItems = document.querySelectorAll('.reveal');

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('show');
                }, index * 70);
            }
        });
    }, {
        threshold: 0.12
    });

    revealItems.forEach(item => revealObserver.observe(item));

    const cartDrawer = document.getElementById('cartDrawer');
    const cartOverlay = document.getElementById('cartOverlay');
    const cartClose = document.getElementById('cartClose');
    const cartList = document.getElementById('cartList');
    const cartTotal = document.getElementById('cartTotal');
    const cartSubText = document.getElementById('cartSubText');
    const cartCounter = document.querySelector('.count');
    const cartOpenBtn = document.getElementById('cartOpenBtn');

    let cart = JSON.parse(localStorage.getItem('eymen_cart')) || [];

    function openCart() {
        cartDrawer.classList.add('active');
        cartOverlay.classList.add('active');
    }

    function closeCart() {
        cartDrawer.classList.remove('active');
        cartOverlay.classList.remove('active');
    }

    cartOpenBtn?.addEventListener('click', function(e) {
        e.preventDefault();
        openCart();
    });

    cartClose?.addEventListener('click', closeCart);
    cartOverlay?.addEventListener('click', closeCart);

    function saveCart() {
        localStorage.setItem('eymen_cart', JSON.stringify(cart));
        renderCart();
    }

    function addToCart(product) {
        const exists = cart.find(item => item.id === product.id);

        if (exists) {
            exists.qty += 1;
        } else {
            cart.push({
                ...product,
                qty: 1
            });
        }

        saveCart();
        openCart();
    }

    function removeCart(id) {
        cart = cart.filter(item => item.id !== id);
        saveCart();
    }

    function changeQty(id, type) {
        const item = cart.find(item => item.id === id);

        if (!item) return;

        if (type === 'plus') {
            item.qty += 1;
        }

        if (type === 'minus') {
            item.qty -= 1;
        }

        if (item.qty <= 0) {
            removeCart(id);
            return;
        }

        saveCart();
    }

    function renderCart() {
        const totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
        const totalPrice = cart.reduce((sum, item) => sum + (Number(item.price) * item.qty), 0);

        if (cartCounter) {
            cartCounter.textContent = totalQty;
        }

        if (cartSubText) {
            cartSubText.textContent = totalQty > 0 ? `${totalQty} ürün sepetinizde` : 'Sepetinizde ürün yok';
        }

        if (cartTotal) {
            cartTotal.textContent = '₺' + totalPrice.toLocaleString('tr-TR');
        }

        if (!cartList) return;

        if (cart.length === 0) {
            cartList.innerHTML = `<div style="padding:30px;text-align:center;color:#777;">Sepetiniz boş.</div>`;
            return;
        }

        cartList.innerHTML = cart.map(item => `
            <div class="cart-item">
                <img src="${item.img}" alt="${item.name}">
                <div>
                    <h4>${item.name}</h4>
                    <div class="cart-item-price">₺${Number(item.price).toLocaleString('tr-TR')}</div>
                    <div class="cart-qty">
                        <button onclick="changeQty('${item.id}','minus')">-</button>
                        <strong>${item.qty}</strong>
                        <button onclick="changeQty('${item.id}','plus')">+</button>
                    </div>
                </div>
                <button class="cart-remove" onclick="removeCart('${item.id}')">×</button>
            </div>
        `).join('');
    }

    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.js-add-cart');

        if (!btn) return;

        addToCart({
            id: btn.dataset.id,
            name: btn.dataset.name,
            price: Number(btn.dataset.price),
            img: btn.dataset.img
        });
    });

    document.getElementById('checkoutBtn')?.addEventListener('click', function() {
        if (cart.length === 0) {
            alert('Sepetiniz boş.');
            return;
        }

        window.location.href = '/checkout';
    });

    renderCart();
</script>

</body>
</html>