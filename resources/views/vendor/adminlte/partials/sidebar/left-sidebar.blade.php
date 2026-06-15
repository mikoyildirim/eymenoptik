<aside class="main-sidebar elevation-0 eo-sidebar">

    <a href="{{ route('admin.dashboard') }}" class="eo-brand">
        <div class="eo-logo">
            <i class="fas fa-glasses"></i>
        </div>
        <div>
            <strong>Eymen Optik</strong>
        </div>
    </a>

    <div class="sidebar eo-sidebar-inner">

        <div class="eo-admin-card">
            <div class="eo-admin-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div>
                <b>{{ auth()->user()->name ?? 'Admin' }}</b>
                <small>Yönetici Hesabı</small>
            </div>
        </div>

        <nav class="eo-menu">
            <div class="eo-menu-title">ANA MENÜ</div>

            <a href="{{ route('admin.dashboard') }}"
                class="eo-menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span><i class="fas fa-chart-pie"></i></span>
                <p>Dashboard</p>
            </a>

            <a href="https://mt-arnor-da.guzelhosting.com/roundcube/" target="_blank" class="eo-menu-link">
                <span><i class="fas fa-envelope"></i></span>
                <p>Maillere Git</p>
            </a>

            <div class="eo-menu-title">KATALOG</div>

            <a href="{{ route('admin.products.index') }}"
                class="eo-menu-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                <span><i class="fas fa-glasses"></i></span>
                <p>Ürünler</p>
            </a>

            <a href="{{ route('admin.products.create') }}"
                class="eo-menu-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                <span><i class="fas fa-plus"></i></span>
                <p>Yeni Ürün</p>
            </a>

            <a href="{{ route('admin.categories.index') }}"
                class="eo-menu-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span><i class="fas fa-layer-group"></i></span>
                <p>Kategoriler</p>
            </a>

            <a href="{{ route('admin.brands.index') }}"
                class="eo-menu-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                <span><i class="fas fa-tags"></i></span>
                <p>Markalar</p>
            </a>

            <a href="{{ route('admin.sliders.index') }}"
                class="eo-menu-link {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                <span><i class="fas fa-images"></i></span>
                <p>Sliderlar</p>
            </a>

            <div class="eo-menu-title">SATIŞ</div>

            <a href="{{ route('admin.orders.index') }}"
                class="eo-menu-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <span><i class="fas fa-shopping-bag"></i></span>
                <p>Siparişler</p>
            </a>

            <div class="eo-menu-title">SİSTEM</div>

            <a href="/" class="eo-menu-link">
                <span><i class="fas fa-store"></i></span>
                <p>Mağazaya Git</p>
            </a>
        </nav>

        <div class="eo-sidebar-footer">
            <div>
                <b>Mağaza Durumu</b>
                <span>Aktif</span>
            </div>
            <i class="fas fa-circle"></i>
        </div>

        <a href="{{ route('admin.settings.edit') }}"
            class="eo-settings-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <span><i class="fas fa-cog"></i></span>
            <p>Ayarlar</p>
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="eo-logout">
                <i class="fas fa-power-off"></i>
                Çıkış Yap
            </button>
        </form>

    </div>
</aside>
<style>
    .eo-sidebar {
        background:
            radial-gradient(circle at 20% 0%, rgba(40, 84, 217, .28), transparent 28%),
            radial-gradient(circle at 100% 20%, rgba(199, 154, 58, .18), transparent 26%),
            linear-gradient(180deg, #050b16 0%, #07111f 48%, #0b1424 100%) !important;
        border-right: 1px solid rgba(255, 255, 255, .06);
        box-shadow: 18px 0 60px rgba(7, 17, 31, .18);
    }

    .eo-sidebar-inner {
        padding: 0 12px 18px;
    }

    .eo-brand {
        height: 86px;
        padding: 18px 18px;
        display: flex;
        align-items: center;
        gap: 13px;
        color: #fff !important;
        text-decoration: none !important;
        border-bottom: 1px solid rgba(255, 255, 255, .06);
    }

    .eo-logo {
        width: 48px;
        height: 48px;
        border-radius: 18px;
        background:
            radial-gradient(circle at 30% 20%, rgba(255, 255, 255, .28), transparent 34%),
            linear-gradient(135deg, #2854d9, #c79a3a);
        display: grid;
        place-items: center;
        color: #fff;
        font-size: 19px;
        box-shadow: 0 18px 36px rgba(40, 84, 217, .24);
    }

    .eo-brand strong {
        display: block;
        font-size: 20px;
        font-weight: 950;
        letter-spacing: -.8px;
        line-height: 1;
    }

    .eo-brand span {
        display: block;
        margin-top: 5px;
        color: rgba(255, 255, 255, .42);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.8px;
        text-transform: uppercase;
    }

    .eo-admin-card {
        margin: 18px 0 16px;
        padding: 14px;
        border-radius: 24px;
        display: flex;
        align-items: center;
        gap: 13px;
        background: rgba(255, 255, 255, .055);
        border: 1px solid rgba(255, 255, 255, .075);
        backdrop-filter: blur(16px);
    }

    .eo-admin-avatar {
        width: 48px;
        height: 48px;
        border-radius: 17px;
        display: grid;
        place-items: center;
        color: #fff;
        font-weight: 950;
        background: linear-gradient(135deg, #17375f, #2854d9);
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .12);
    }

    .eo-admin-card b {
        display: block;
        color: #fff;
        font-size: 14px;
        font-weight: 900;
    }

    .eo-admin-card small {
        display: block;
        margin-top: 3px;
        color: rgba(255, 255, 255, .45);
        font-size: 11px;
        font-weight: 700;
    }

    .eo-menu {
        display: grid;
        gap: 5px;
    }

    .eo-menu-title {
        color: rgba(255, 255, 255, .28);
        font-size: 10px;
        font-weight: 950;
        letter-spacing: 1.5px;
        margin: 14px 10px 6px;
    }

    .eo-menu-link {
        min-height: 48px;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 9px 10px;
        border-radius: 17px;
        color: rgba(255, 255, 255, .68) !important;
        text-decoration: none !important;
        position: relative;
        transition: .25s ease;
    }

    .eo-menu-link span {
        width: 34px;
        height: 34px;
        border-radius: 13px;
        display: grid;
        place-items: center;
        background: rgba(255, 255, 255, .055);
        color: rgba(255, 255, 255, .74);
        transition: .25s ease;
    }

    .eo-menu-link p {
        margin: 0;
        font-size: 14px;
        font-weight: 850;
    }

    .eo-menu-link:hover {
        background: rgba(255, 255, 255, .055);
        color: #fff !important;
        transform: translateX(3px);
    }

    .eo-menu-link:hover span {
        background: rgba(255, 255, 255, .1);
        color: #fff;
    }

    .eo-menu-link.active {
        color: #fff !important;
        background:
            radial-gradient(circle at 100% 0%, rgba(199, 154, 58, .25), transparent 32%),
            linear-gradient(135deg, rgba(40, 84, 217, .96), rgba(23, 55, 95, .96));
        box-shadow: 0 14px 34px rgba(40, 84, 217, .24);
    }

    .eo-menu-link.active::before {
        content: "";
        position: absolute;
        left: -12px;
        top: 12px;
        bottom: 12px;
        width: 4px;
        border-radius: 99px;
        background: #c79a3a;
    }

    .eo-menu-link.active span {
        background: rgba(255, 255, 255, .16);
        color: #fff;
    }

    .eo-sidebar-footer {
        margin-top: 18px;
        padding: 15px;
        border-radius: 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background:
            radial-gradient(circle at 0% 0%, rgba(22, 163, 107, .18), transparent 35%),
            rgba(255, 255, 255, .055);
        border: 1px solid rgba(255, 255, 255, .07);
    }

    .eo-sidebar-footer b {
        display: block;
        color: #fff;
        font-size: 13px;
        font-weight: 900;
    }

    .eo-sidebar-footer span {
        color: rgba(255, 255, 255, .48);
        font-size: 11px;
        font-weight: 800;
    }

    .eo-sidebar-footer i {
        color: #16a36b;
        font-size: 10px;
        filter: drop-shadow(0 0 8px rgba(22, 163, 107, .8));
    }

    .eo-settings-link {
        margin-top: 10px;
        min-height: 48px;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 9px 10px;
        border-radius: 17px;
        color: rgba(255, 255, 255, .68) !important;
        text-decoration: none !important;
        transition: .25s ease;
    }

    .eo-settings-link span {
        width: 34px;
        height: 34px;
        border-radius: 13px;
        display: grid;
        place-items: center;
        background: rgba(255, 255, 255, .055);
        color: rgba(255, 255, 255, .74);
        transition: .25s ease;
    }

    .eo-settings-link p {
        margin: 0;
        font-size: 14px;
        font-weight: 850;
    }

    .eo-settings-link:hover {
        background: rgba(255, 255, 255, .055);
        color: #fff !important;
        transform: translateX(3px);
    }

    .eo-settings-link:hover span {
        background: rgba(255, 255, 255, .1);
        color: #fff;
    }

    .eo-settings-link.active {
        color: #fff !important;
        background:
            radial-gradient(circle at 100% 0%, rgba(199, 154, 58, .25), transparent 32%),
            linear-gradient(135deg, rgba(40, 84, 217, .96), rgba(23, 55, 95, .96));
        box-shadow: 0 14px 34px rgba(40, 84, 217, .24);
    }

    .eo-settings-link.active span {
        background: rgba(255, 255, 255, .16);
        color: #fff;
    }

    .eo-logout {
        margin-top: 10px;
        width: 100%;
        height: 48px;
        border: 0;
        border-radius: 17px;
        background: rgba(227, 59, 59, .12);
        color: #ff8b8b;
        font-weight: 900;
        cursor: pointer;
        transition: .25s ease;
    }

    .eo-logout:hover {
        background: rgba(227, 59, 59, .2);
        color: #fff;
        transform: translateY(-2px);
    }

    .eo-logout i {
        margin-right: 8px;
    }
</style>