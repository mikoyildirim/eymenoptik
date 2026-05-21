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
        background: #111;
        color: #fff;
        min-height: 48px;
        display: flex;
        align-items: center;
    }

    .top-sale-inner {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .top-sale-text {
        text-align: center;
        font-size: 17px;
        font-weight: 900;
        letter-spacing: .3px;
    }

    .info-bar {
        padding: 13px 0;
        border-bottom: 1px solid #eee;
        background: #fff;
    }

    .info-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        font-size: 13px;
    }

    .info-left,
    .info-right {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .login-btn {
        background: #000;
        color: #fff;
        padding: 10px 18px;
        font-weight: 800;
        border-radius: 999px;
    }

    .main-header {
        padding: 18px 0;
        border-bottom: 1px solid #eee;
        background: rgba(255, 255, 255, .96);
        position: sticky;
        top: 0;
        z-index: 100;
        backdrop-filter: blur(16px);
    }

    .header-inner {
        display: grid;
        grid-template-columns: 190px 1fr 420px;
        align-items: center;
        gap: 24px;
    }

    .logo {
        display: inline-flex;
        align-items: center;
    }

    .logo img {
        width: auto;
        max-width: 165px;
        height: auto;
        object-fit: contain;
    }

    .main-menu {
        display: flex;
        align-items: center;
        gap: 26px;
        flex-wrap: wrap;
    }

    .menu-link {
        position: relative;
        font-size: 15px;
        font-weight: 800;
        color: #111;
        transition: .25s ease;
        white-space: nowrap;
    }

    .menu-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -8px;
        width: 0;
        height: 2px;
        background: #c79a3a;
        transition: .25s ease;
    }

    .menu-link:hover {
        color: #c79a3a;
    }

    .menu-link:hover::after {
        width: 100%;
    }

    .search-area {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .search-box {
        flex: 1;
        background: #f1f1f1;
        border-radius: 999px;
        display: flex;
        overflow: hidden;
        height: 48px;
        border: 1px solid #eee;
    }

    .search-box input {
        flex: 1;
        border: 0;
        background: transparent;
        outline: 0;
        padding: 0 20px;
        font-size: 14px;
    }

    .search-box button {
        width: 52px;
        border: 0;
        background: #000;
        color: #fff;
        cursor: pointer;
        font-size: 20px;
    }

    .head-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #f5f5f5;
        display: grid;
        place-items: center;
        font-size: 22px;
        position: relative;
    }

    .count {
        position: absolute;
        top: -6px;
        right: -6px;
        background: #000;
        color: #fff;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        font-size: 11px;
        display: grid;
        place-items: center;
    }

    .hamburger-btn {
        display: none;
        width: 46px;
        height: 46px;
        border: 0;
        background: #000;
        border-radius: 14px;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 5px;
    }

    .hamburger-btn span {
        width: 22px;
        height: 2px;
        background: #fff;
        border-radius: 20px;
        transition: .3s ease;
    }

    .hamburger-btn.active span:nth-child(1) {
        transform: translateY(7px) rotate(45deg);
    }

    .hamburger-btn.active span:nth-child(2) {
        opacity: 0;
    }

    .hamburger-btn.active span:nth-child(3) {
        transform: translateY(-7px) rotate(-45deg);
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
        border-bottom: 1px solid rgba(255, 255, 255, .12);
    }

    .footer h3 {
        margin-bottom: 16px;
        font-size: 17px;
    }

    .footer p,
    .footer a {
        display: block;
        color: rgba(255, 255, 255, .65);
        line-height: 1.9;
        font-size: 14px;
    }

    .copyright {
        padding-top: 22px;
        display: flex;
        justify-content: space-between;
        gap: 15px;
        flex-wrap: wrap;
        color: rgba(255, 255, 255, .5);
        font-size: 13px;
    }

    .cart-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .45);
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
        width: min(420px, 100%);
        height: 100vh;
        background: #fff;
        z-index: 999;
        box-shadow: -30px 0 80px rgba(0, 0, 0, .18);
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
        font-size: 26px;
        font-weight: 900;
    }

    #cartClose {
        width: 42px;
        height: 42px;
        border: 0;
        background: #000;
        color: #fff;
        font-size: 24px;
        cursor: pointer;
        border-radius: 12px;
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
        border-radius: 12px;
    }

    .cart-item h4 {
        font-size: 14px;
        margin-bottom: 6px;
    }

    .cart-bottom {
        padding: 22px;
        border-top: 1px solid #eee;
    }

    .cart-total-row {
        display: flex;
        justify-content: space-between;
        font-size: 21px;
        font-weight: 900;
        margin-bottom: 16px;
    }

    .btn-checkout {
        width: 100%;
        height: 52px;
        background: #000;
        color: #fff;
        display: grid;
        place-items: center;
        font-weight: 900;
        border-radius: 14px;
    }

    @media(max-width: 1200px) {
        .header-inner {
            grid-template-columns: 170px 1fr;
        }

        .main-menu {
            grid-column: 1 / -1;
            justify-content: center;
        }

        .search-area {
            grid-column: 1 / -1;
        }

        .footer-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width: 768px) {
        .container {
            width: min(100% - 28px, 1510px);
        }

        .top-sale {
            min-height: 42px;
        }

        .top-sale-text {
            font-size: 13px;
            line-height: 1.35;
        }

        .info-bar {
            display: none;
        }

        .main-header {
            padding: 12px 0;
            top: 0;
        }

        .header-inner {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 12px;
        }

        .logo img {
            max-width: 130px;
        }

        .hamburger-btn {
            display: flex;
        }

        .main-menu {
            position: fixed;
            top: 67px;
            left: 12px;
            right: 12px;
            width: auto;
            max-height: calc(100vh - 92px);
            overflow-y: auto;
            background: #fff;
            padding: 18px;
            border-radius: 24px;
            flex-direction: column;
            align-items: stretch;
            gap: 8px;
            box-shadow: 0 30px 90px rgba(0, 0, 0, .18);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-12px) scale(.98);
            transition: .3s ease;
            z-index: 999;
        }

        .main-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .menu-link {
            width: 100%;
            padding: 15px 16px;
            border-radius: 16px;
            background: #f7f7f7;
            font-size: 15px;
        }

        .menu-link::after {
            display: none;
        }

        .menu-link:hover {
            background: #111;
            color: #fff;
        }

        .search-area {
            grid-column: 1 / -1;
            width: 100%;
            gap: 10px;
        }

        .search-box {
            height: 46px;
            border-radius: 16px;
        }

        .search-box input {
            padding: 0 14px;
            font-size: 13px;
        }

        .search-box button {
            width: 48px;
            border-radius: 0;
        }

        .head-icon {
            width: 43px;
            height: 43px;
            min-width: 43px;
            font-size: 19px;
        }

        .footer {
            padding: 38px 0 22px;
        }

        .footer-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .copyright {
            font-size: 12px;
        }

        .cart-drawer {
            width: 100%;
            right: -100%;
            border-radius: 24px 24px 0 0;
        }

        .cart-item {
            grid-template-columns: 64px 1fr auto;
        }

        .cart-item img {
            height: 64px;
        }
    }
    </style>

    @yield('page_css')
</head>

<body>

    <div class="top-sale">
        <div class="container top-sale-inner">
            <div class="top-sale-text">
                3000 TL VE ÜZERİ ÜCRETSİZ KARGO
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
            </div>
        </div>
    </div>

    <header class="main-header">
        <div class="container header-inner">

            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('images/eymen.svg') }}" alt="Eymen Optik">
            </a>

            <button type="button" class="hamburger-btn" id="hamburgerBtn">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav class="main-menu" id="mainMenu">
                @isset($categories)
                @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="menu-link">
                    {{ $category->name }}
                </a>
                @endforeach
                @endisset

                <a href="{{ route('blog.index') }}" class="menu-link">Yardım Merkezi</a>
                <a href="{{ route('brands.index') }}" class="menu-link">Markalar</a>
                <a href="{{ route('contact') }}" class="menu-link">İletişim</a>

                @auth
                <a href="{{ route('account') }}" class="menu-link">Hesabım</a>
                @else
                <a href="{{ route('login') }}" class="menu-link">Giriş Yap</a>
                @endauth
            </nav>

            <div class="search-area">
                <form class="search-box" action="{{ route('products.index') }}" method="GET">
                    <input type="text" name="q" placeholder="Ürün ara...">
                    <button type="submit">⌕</button>
                </form>

                <a href="#" class="head-icon">♡</a>

                <a href="#" class="head-icon" id="cartOpenBtn">
                    🛍
                    <span class="count">0</span>
                </a>
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
                   <!-- burası dinamik olacak -->
                    <h3>Kategoriler</h3>
                    @isset($categories)
                    @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                    @endforeach
                    @endisset
                </div>

                <div>
                    <h3>Mağaza</h3>
                    <a href="#">Çok Satanlar</a>
                    <a href="#">Yeni Sezon</a>
                </div>

                <div>
                    <h3>Destek</h3>
                    <a href="{{ route('blog.index') }}">Sıkça Sorulan Sorular</a>
                    <a href="{{ route('blog.index') }}#garanti-ve-iade">Garanti ve İade</a>
                    <a href="{{ route('blog.index') }}#kargo-ve-teslimat">Kargo ve Teslimat</a>
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
            <a href="{{ route('checkout.index') }}" class="btn-checkout">Ödemeye Geç</a>
            @else
            <a href="{{ route('login') }}" class="btn-checkout">Giriş Yap ve Devam Et</a>
            @endauth
        </div>
    </aside>

    @yield('page_js')

    <script>
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mainMenu = document.getElementById('mainMenu');

    hamburgerBtn?.addEventListener('click', function() {
        hamburgerBtn.classList.toggle('active');
        mainMenu.classList.toggle('active');
    });

    document.querySelectorAll('.main-menu a').forEach(link => {
        link.addEventListener('click', () => {
            hamburgerBtn?.classList.remove('active');
            mainMenu?.classList.remove('active');
        });
    });

    document.addEventListener('click', function(e) {
        if (!mainMenu || !hamburgerBtn) return;

        const clickedInsideMenu = mainMenu.contains(e.target);
        const clickedHamburger = hamburgerBtn.contains(e.target);

        if (!clickedInsideMenu && !clickedHamburger) {
            hamburgerBtn.classList.remove('active');
            mainMenu.classList.remove('active');
        }
    });

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

        if (type === 'plus') item.qty += 1;
        if (type === 'minus') item.qty -= 1;

        if (item.qty <= 0) {
            removeCart(id);
            return;
        }

        saveCart();
    }

    function renderCart() {
        const totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
        const totalPrice = cart.reduce((sum, item) => sum + (Number(item.price) * item.qty), 0);

        if (cartCounter) cartCounter.textContent = totalQty;

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
                    <div style="font-size:13px;color:#777;font-weight:800;">
                        ₺${Number(item.price).toLocaleString('tr-TR')}
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;margin-top:8px;">
                        <button onclick="changeQty('${item.id}','minus')" style="width:28px;height:28px;border:0;background:#eee;border-radius:8px;">-</button>
                        <strong>${item.qty}</strong>
                        <button onclick="changeQty('${item.id}','plus')" style="width:28px;height:28px;border:0;background:#eee;border-radius:8px;">+</button>
                    </div>
                </div>
                <button onclick="removeCart('${item.id}')" style="width:30px;height:30px;border:0;background:#fff0f0;color:#d22;border-radius:8px;">×</button>
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

    renderCart();
    </script>

</body>

</html>