<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifre Sıfırlama</title>
</head>

<body style="margin:0;padding:0;background:#f4f6fb;font-family:Arial,sans-serif;color:#1a2435;">
    <div style="max-width:640px;margin:0 auto;padding:32px 20px;">
        <div style="background:#ffffff;border:1px solid rgba(7,17,31,.08);border-radius:20px;padding:28px;box-shadow:0 20px 60px rgba(7,17,31,.08);">
            <h1 style="margin:0 0 14px;font-size:28px;line-height:1.2;color:#07111f;">Şifreni sıfırla</h1>
            <p style="margin:0 0 20px;font-size:15px;line-height:1.7;color:#707b8d;">Hesabın için bir şifre sıfırlama talebi aldık. Aşağıdaki buton ile yeni şifre belirleyebilirsin.</p>

            <p style="margin:0 0 24px;">
                <a href="{{ $resetUrl }}" style="display:inline-block;background:#07111f;color:#ffffff;text-decoration:none;font-weight:700;padding:14px 22px;border-radius:14px;">Şifreyi Sıfırla</a>
            </p>

            <p style="margin:0 0 10px;font-size:13px;line-height:1.7;color:#707b8d;">Buton çalışmıyorsa bağlantıyı kopyalayıp tarayıcıya yapıştır:</p>
            <p style="margin:0;font-size:13px;line-height:1.7;word-break:break-all;color:#2854d9;">{{ $resetUrl }}</p>
        </div>
    </div>
</body>

</html>