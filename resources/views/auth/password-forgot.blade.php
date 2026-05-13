<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eymen Optik | Şifremi Unuttum</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f4f6fb;
            --dark: #07111f;
            --text: #1a2435;
            --muted: #707b8d;
            --line: rgba(7, 17, 31, .09);
            --blue: #2854d9;
            --shadow: 0 28px 90px rgba(7, 17, 31, .13)
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body {
            min-height: 100vh;
            font-family: "Inter", sans-serif;
            color: var(--text);
            background: linear-gradient(180deg, #f9fbff 0%, var(--bg) 100%);
            display: grid;
            place-items: center;
            padding: 24px
        }

        a {
            text-decoration: none;
            color: inherit
        }

        .box {
            width: min(480px, 100%);
            background: rgba(255, 255, 255, .9);
            border: 1px solid var(--line);
            border-radius: 34px;
            padding: 30px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(20px)
        }

        h1 {
            font-size: 34px;
            letter-spacing: -1.6px;
            color: var(--dark);
            margin-bottom: 8px
        }

        p {
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 20px
        }

        .field {
            margin-bottom: 14px
        }

        label {
            display: block;
            font-weight: 900;
            font-size: 13px;
            margin-bottom: 8px;
            color: var(--dark)
        }

        input {
            width: 100%;
            height: 54px;
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 0 15px;
            font-size: 14px;
            font-weight: 650;
            outline: 0
        }

        input:focus {
            border-color: rgba(40, 84, 217, .36);
            box-shadow: 0 0 0 5px rgba(40, 84, 217, .08)
        }

        .btn {
            width: 100%;
            height: 55px;
            border: 0;
            border-radius: 18px;
            background: var(--dark);
            color: #fff;
            font-weight: 950;
            font-size: 14px;
            cursor: pointer;
            margin-top: 6px
        }

        .status {
            padding: 12px 14px;
            border-radius: 14px;
            background: #eef7ff;
            color: var(--blue);
            margin-bottom: 14px;
            font-weight: 800;
            font-size: 13px
        }

        .error {
            padding: 12px 14px;
            border-radius: 14px;
            background: #fff0f0;
            color: #e33b3b;
            margin-bottom: 14px;
            font-weight: 800;
            font-size: 13px
        }

        .back {
            display: inline-block;
            margin-top: 16px;
            color: var(--blue);
            font-weight: 900;
            font-size: 13px
        }
    </style>
</head>

<body>
    <main class="box">
        <h1>Şifremi Unuttum</h1>
        <p>E-posta adresini yaz, sana şifre sıfırlama bağlantısı gönderelim.</p>

        @if (session('status'))<div class="status">{{ session('status') }}</div>@endif
        @if ($errors->any())<div class="error">{{ $errors->first() }}</div>@endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="field">
                <label>E-posta Adresi</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="ornek@mail.com" required autofocus>
            </div>
            <button class="btn" type="submit">Sıfırlama Bağlantısı Gönder</button>
        </form>

        <a class="back" href="{{ route('login') }}">Giriş ekranına dön</a>
    </main>
</body>

</html>