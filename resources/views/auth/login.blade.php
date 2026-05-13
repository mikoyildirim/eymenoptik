<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eymen Optik | Giriş & Kayıt</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #f4f6fb;
            --dark: #07111f;
            --text: #1a2435;
            --muted: #707b8d;
            --white: #ffffff;
            --soft: #eef2f8;
            --line: rgba(7,17,31,.09);
            --gold: #c79a3a;
            --blue: #2854d9;
            --green: #16a36b;
            --shadow: 0 28px 90px rgba(7,17,31,.13);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: "Inter", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 0% 0%, rgba(40,84,217,.16), transparent 34%),
                radial-gradient(circle at 100% 10%, rgba(199,154,58,.22), transparent 30%),
                linear-gradient(180deg, #f9fbff 0%, var(--bg) 100%);
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(7,17,31,.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(7,17,31,.025) 1px, transparent 1px);
            background-size: 46px 46px;
            mask-image: linear-gradient(to bottom, black, transparent 80%);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input {
            font-family: inherit;
        }

        .auth-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1.04fr;
            padding: 24px;
            gap: 24px;
            position: relative;
            z-index: 1;
        }

        .auth-visual {
            position: relative;
            overflow: hidden;
            border-radius: 42px;
            background:
                radial-gradient(circle at 80% 10%, rgba(199,154,58,.32), transparent 32%),
                linear-gradient(135deg, var(--dark), #17375f);
            color: white;
            min-height: calc(100vh - 48px);
            box-shadow: var(--shadow);
        }

        .auth-visual::before {
            content: "";
            position: absolute;
            width: 720px;
            height: 720px;
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 50%;
            left: -260px;
            top: -150px;
        }

        .auth-visual::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            right: -140px;
            bottom: -120px;
            background: rgba(199,154,58,.2);
            filter: blur(4px);
        }

        .visual-content {
            position: relative;
            z-index: 2;
            height: 100%;
            padding: 38px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
            font-weight: 950;
            font-size: 22px;
            letter-spacing: -.8px;
        }

        .brand-mark {
            width: 50px;
            height: 50px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.18);
            backdrop-filter: blur(12px);
        }

        .brand small {
            display: block;
            margin-top: 5px;
            font-size: 10px;
            letter-spacing: 2.6px;
            color: rgba(255,255,255,.62);
        }

        .visual-main {
            max-width: 560px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 9px 13px;
            border-radius: 999px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.18);
            color: rgba(255,255,255,.88);
            font-size: 13px;
            font-weight: 900;
            margin-bottom: 18px;
        }

        .dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--green);
            box-shadow: 0 0 0 7px rgba(22,163,107,.15);
        }

        .visual-main h1 {
            font-size: clamp(38px, 5vw, 68px);
            line-height: .98;
            letter-spacing: -3.8px;
            margin-bottom: 20px;
        }

        .visual-main h1 span {
            color: var(--gold);
        }

        .visual-main p {
            color: rgba(255,255,255,.72);
            line-height: 1.8;
            font-size: 16px;
            max-width: 500px;
        }

        .visual-card {
            margin-top: 28px;
            max-width: 520px;
            border-radius: 30px;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.16);
            backdrop-filter: blur(18px);
            padding: 18px;
            display: grid;
            grid-template-columns: 86px 1fr auto;
            align-items: center;
            gap: 15px;
        }

        .product-img {
            height: 78px;
            border-radius: 22px;
            overflow: hidden;
            background: rgba(255,255,255,.16);
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .visual-card b {
            display: block;
            margin-bottom: 6px;
            font-size: 16px;
        }

        .visual-card span {
            color: rgba(255,255,255,.65);
            font-size: 13px;
            font-weight: 800;
        }

        .visual-card strong {
            font-size: 24px;
            color: white;
        }

        .visual-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 34px;
        }

        .visual-stat {
            border-radius: 24px;
            padding: 16px;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.14);
        }

        .visual-stat b {
            display: block;
            font-size: 24px;
            letter-spacing: -1px;
        }

        .visual-stat span {
            color: rgba(255,255,255,.62);
            font-size: 12px;
            font-weight: 800;
        }

        .visual-bottom {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            color: rgba(255,255,255,.62);
            font-size: 13px;
            font-weight: 700;
        }

        .auth-panel {
            min-height: calc(100vh - 48px);
            display: grid;
            place-items: center;
            padding: 40px 20px;
        }

        .auth-box {
            width: min(500px, 100%);
            background: rgba(255,255,255,.84);
            border: 1px solid var(--line);
            border-radius: 38px;
            padding: 26px;
            box-shadow: 0 24px 70px rgba(7,17,31,.1);
            backdrop-filter: blur(24px);
        }

        .auth-tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: var(--soft);
            border-radius: 22px;
            padding: 6px;
            margin-bottom: 26px;
        }

        .tab-btn {
            border: 0;
            border-radius: 17px;
            background: transparent;
            padding: 13px 12px;
            color: var(--muted);
            font-size: 14px;
            font-weight: 950;
            cursor: pointer;
            transition: .28s ease;
        }

        .tab-btn.active {
            background: white;
            color: var(--dark);
            box-shadow: 0 12px 28px rgba(7,17,31,.08);
        }

        .form-head {
            margin-bottom: 23px;
        }

        .form-head h2 {
            color: var(--dark);
            font-size: 34px;
            letter-spacing: -1.8px;
            margin-bottom: 9px;
        }

        .form-head p {
            color: var(--muted);
            line-height: 1.65;
            font-size: 14px;
        }

        .form {
            display: none;
        }

        .form.active {
            display: block;
            animation: formFade .28s ease;
        }

        @keyframes formFade {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .field {
            margin-bottom: 14px;
        }

        .field label {
            display: block;
            color: var(--dark);
            font-size: 13px;
            font-weight: 900;
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap input {
            width: 100%;
            height: 54px;
            border: 1px solid var(--line);
            background: white;
            border-radius: 18px;
            outline: none;
            padding: 0 48px 0 15px;
            color: var(--dark);
            font-size: 14px;
            font-weight: 650;
            transition: .25s ease;
        }

        .input-wrap input:focus {
            border-color: rgba(40,84,217,.36);
            box-shadow: 0 0 0 5px rgba(40,84,217,.08);
        }

        .input-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 18px;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            margin: 4px 0 18px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 800;
        }

        .form-options label {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-options a {
            color: var(--blue);
        }

        .btn {
            width: 100%;
            height: 55px;
            border: 0;
            border-radius: 18px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 950;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: .28s ease;
        }

        .btn-primary {
            background: var(--dark);
            color: white;
            box-shadow: 0 20px 44px rgba(7,17,31,.22);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 26px 58px rgba(7,17,31,.27);
        }

        .divider {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 12px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 900;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: "";
            height: 1px;
            background: var(--line);
        }

        .social-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .social-btn {
            height: 50px;
            border: 1px solid var(--line);
            border-radius: 17px;
            background: white;
            cursor: pointer;
            font-weight: 900;
            color: var(--dark);
            transition: .25s ease;
        }

        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(7,17,31,.08);
        }

        .switch-text {
            margin-top: 20px;
            color: var(--muted);
            text-align: center;
            font-size: 14px;
            font-weight: 750;
        }

        .switch-text button {
            border: 0;
            background: transparent;
            color: var(--blue);
            font-weight: 950;
            cursor: pointer;
        }

        .policy-text {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
            margin: 12px 0 18px;
        }

        .policy-text a {
            color: var(--blue);
            font-weight: 900;
        }

        @media (max-width: 980px) {
            .auth-page {
                grid-template-columns: 1fr;
            }

            .auth-visual {
                min-height: auto;
            }

            .visual-content {
                gap: 60px;
            }

            .auth-panel {
                min-height: auto;
            }
        }

        @media (max-width: 620px) {
            .auth-page {
                padding: 12px;
            }

            .auth-visual {
                border-radius: 30px;
            }

            .visual-content {
                padding: 24px;
            }

            .visual-main h1 {
                letter-spacing: -2.4px;
            }

            .visual-card {
                grid-template-columns: 70px 1fr;
            }

            .visual-card strong {
                display: none;
            }

            .visual-stats,
            .form-grid,
            .social-grid {
                grid-template-columns: 1fr;
            }

            .auth-panel {
                padding: 18px 0;
            }

            .auth-box {
                border-radius: 30px;
                padding: 18px;
            }

            .form-options {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <main class="auth-page">
        <section class="auth-visual">
            <div class="visual-content">
                <a href="index.html" class="brand">
                    <span class="brand-mark">EO</span>
                    <span>Eymen Optik<small>PREMIUM EYEWEAR</small></span>
                </a>

                <div class="visual-main">
                    <div class="eyebrow"><span class="dot"></span> Güvenli Üyelik Alanı</div>
                    <h1>Tarzına uygun gözlüğe <span>daha hızlı</span> ulaş.</h1>
                    <p>
                        Üye girişi ile favorilerini kaydet, siparişlerini takip et ve Eymen Optik’e özel kampanyalardan önce sen haberdar ol.
                    </p>

                    <div class="visual-card">
                        <div class="product-img">
                            <img src="https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=400&q=80" alt="Eymen Optik ürün">
                        </div>
                        <div>
                            <b>Eymen Milano Black</b>
                            <span>UV400 • Polarize • Yeni sezon</span>
                        </div>
                        <strong>₺1.249</strong>
                    </div>

                    <div class="visual-stats">
                        <div class="visual-stat"><b>350+</b><span>Ürün seçeneği</span></div>
                        <div class="visual-stat"><b>%100</b><span>Orijinal ürün</span></div>
                        <div class="visual-stat"><b>4.9</b><span>Müşteri puanı</span></div>
                    </div>
                </div>

                <div class="visual-bottom">
                    <span>© 2026 Eymen Optik</span>
                    <span>Güvenli Alışveriş • Hızlı Kargo • WhatsApp Destek</span>
                </div>
            </div>
        </section>

        <section class="auth-panel">
            <div class="auth-box">
                <div class="auth-tabs">
                    <button class="tab-btn active" data-tab="login">Giriş Yap</button>
                    <button class="tab-btn" data-tab="register">Kayıt Ol</button>
                </div>

                @if ($errors->any())<div style="padding:12px;border-radius:14px;background:#fff0f0;color:#e33b3b;margin-bottom:14px;font-weight:800;">{{ $errors->first() }}</div>@endif
                <form class="form active" id="loginForm" method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="form-head">
                        <h2>Tekrar hoş geldiniz</h2>
                        <p>Siparişlerinizi takip etmek ve favori ürünlerinize ulaşmak için hesabınıza giriş yapın.</p>
                    </div>

                    <div class="field">
                        <label>E-posta Adresi</label>
                        <div class="input-wrap">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="ornek@mail.com" required autofocus>
                            <span class="input-icon">✉</span>
                        </div>
                    </div>

                    <div class="field">
                        <label>Şifre</label>
                        <div class="input-wrap">
                            <input type="password" name="password" placeholder="••••••••" required>
                            <span class="input-icon">🔒</span>
                        </div>
                    </div>

                    <div class="form-options">
                        <label><input type="checkbox" name="remember"> Beni hatırla</label>
                        <a href="#">Şifremi unuttum</a>
                    </div>

                    <button type="submit" class="btn btn-primary">Giriş Yap →</button>

                    <div class="divider">veya</div>

                    <div class="social-grid">
                        <button type="button" class="social-btn">Google ile Giriş</button>
                        <button type="button" class="social-btn">Apple ile Giriş</button>
                    </div>

                    <p class="switch-text">
                        Hesabınız yok mu?
                        <button type="button" data-switch="register">Kayıt olun</button>
                    </p>
                </form>

                <form class="form" id="registerForm" method="POST" action="{{ route('register.post') }}">
                    @csrf
                    <div class="form-head">
                        <h2>Yeni hesap oluştur</h2>
                        <p>Favorilerinizi kaydedin, kampanyaları takip edin ve alışverişinizi daha hızlı tamamlayın.</p>
                    </div>

                    <div class="form-grid">
                        <div class="field">
                            <label>Ad</label>
                            <div class="input-wrap">
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Adınız" required>
                                <span class="input-icon">👤</span>
                            </div>
                        </div>

                        <div class="field">
                            <label>Soyad</label>
                            <div class="input-wrap">
                                <input type="text" placeholder="Soyadınız" required>
                                <span class="input-icon">👤</span>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label>E-posta Adresi</label>
                        <div class="input-wrap">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="ornek@mail.com" required>
                            <span class="input-icon">✉</span>
                        </div>
                    </div>

                    <div class="field">
                        <label>Telefon</label>
                        <div class="input-wrap">
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="05xx xxx xx xx">
                            <span class="input-icon">☎</span>
                        </div>
                    </div>

                    <div class="field">
                        <label>Şifre</label>
                        <div class="input-wrap">
                            <input type="password" name="password" placeholder="En az 8 karakter" required>
                            <span class="input-icon">🔒</span>
                        </div>
                    </div>

                    <div class="field">
                        <label>Şifre Tekrar</label>
                        <div class="input-wrap">
                            <input type="password" name="password_confirmation" placeholder="Şifrenizi tekrar girin" required>
                            <span class="input-icon">🔒</span>
                        </div>
                    </div>

                    <p class="policy-text">
                        Kayıt olarak <a href="#">Üyelik Sözleşmesi</a> ve <a href="#">KVKK Aydınlatma Metni</a> şartlarını kabul etmiş olursunuz.
                    </p>

                    <button type="submit" class="btn btn-primary">Hesap Oluştur →</button>

                    <div class="divider">veya</div>

                    <div class="social-grid">
                        <button type="button" class="social-btn">Google ile Kayıt</button>
                        <button type="button" class="social-btn">Apple ile Kayıt</button>
                    </div>

                    <p class="switch-text">
                        Zaten hesabınız var mı?
                        <button type="button" data-switch="login">Giriş yapın</button>
                    </p>
                </form>
            </div>
        </section>
    </main>

    <script>
        const tabButtons = document.querySelectorAll('.tab-btn');
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const switchButtons = document.querySelectorAll('[data-switch]');

        function setActiveForm(type) {
            tabButtons.forEach(button => {
                button.classList.toggle('active', button.dataset.tab === type);
            });

            loginForm.classList.toggle('active', type === 'login');
            registerForm.classList.toggle('active', type === 'register');
        }

        tabButtons.forEach(button => {
            button.addEventListener('click', () => setActiveForm(button.dataset.tab));
        });

        switchButtons.forEach(button => {
            button.addEventListener('click', () => setActiveForm(button.dataset.switch));
        });

        

        
    </script>
</body>
</html>
