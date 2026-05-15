<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eymen Optik | Kayıt Ol</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background:
                linear-gradient(90deg, rgba(255,255,255,.88), rgba(255,255,255,.62)),
                url('https://images.unsplash.com/photo-1574258495973-f010dfbb5371?auto=format&fit=crop&w=1800&q=90');
            background-size: cover;
            background-position: center;
            display: grid;
            place-items: center;
            padding: 30px;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .auth-card {
            width: min(500px, 100%);
            background: #fff;
            padding: 42px;
            box-shadow: 0 30px 90px rgba(0,0,0,.12);
            animation: authIn .7s ease both;
        }

        @keyframes authIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            display: block;
            text-align: center;
            font-size: 36px;
            letter-spacing: 12px;
            font-weight: 900;
            line-height: 1;
            margin-bottom: 32px;
        }

        .logo small {
            display: block;
            font-size: 14px;
            letter-spacing: 9px;
            font-weight: 600;
            margin-top: 7px;
        }

        .auth-title {
            text-align: center;
            margin-bottom: 28px;
        }

        .auth-title h1 {
            font-size: 30px;
            font-weight: 900;
            margin-bottom: 6px;
        }

        .auth-title p {
            color: #777;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 800;
        }

        .form-control {
            width: 100%;
            height: 52px;
            border: 1px solid #ddd;
            padding: 0 16px;
            outline: none;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #000;
        }

        .btn {
            width: 100%;
            height: 54px;
            border: 0;
            background: #000;
            color: #fff;
            font-weight: 900;
            cursor: pointer;
            font-size: 15px;
            transition: .25s ease;
            margin-top: 5px;
        }

        .btn:hover {
            background: #c79a3a;
        }

        .auth-footer {
            text-align: center;
            margin-top: 22px;
            color: #777;
            font-size: 14px;
        }

        .auth-footer a {
            color: #000;
            font-weight: 900;
        }

        .alert {
            padding: 13px 15px;
            background: #fff0f0;
            color: #c62828;
            margin-bottom: 18px;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="auth-card">
    <a href="{{ route('home') }}" class="logo">
        EYMEN
        <small>OPTİK</small>
    </a>

    <div class="auth-title">
        <h1>Kayıt Ol</h1>
        <p>Eymen Optik hesabınızı oluşturun.</p>
    </div>

    @if ($errors->any())
        <div class="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
        @csrf

        <div class="form-group">
            <label>Ad Soyad</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="form-control"
                placeholder="Adınız Soyadınız"
                required
            >
        </div>

        <div class="form-group">
            <label>E-posta</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control"
                placeholder="ornek@mail.com"
                required
            >
        </div>

        <div class="form-group">
            <label>Şifre</label>
            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="En az 8 karakter"
                required
            >
        </div>

        <div class="form-group">
            <label>Şifre Tekrar</label>
            <input
                type="password"
                name="password_confirmation"
                class="form-control"
                placeholder="Şifrenizi tekrar girin"
                required
            >
        </div>

        <button class="btn" type="submit">
            KAYIT OL
        </button>
    </form>

    <div class="auth-footer">
        Zaten hesabınız var mı?
        <a href="{{ route('login') }}">Giriş Yap</a>
    </div>
</div>

</body>
</html>