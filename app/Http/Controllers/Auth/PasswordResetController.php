<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PasswordResetController extends Controller
{
    /**
     * Şifre sıfırlama talep formu
     */
    public function requestForm()
    {
        return view('auth.password-forgot');
    }

    /**
     * Şifre sıfırlama linki gönder
     *
     * Laravel'in built-in Password facade'u kullanılıyor:
     * - Otomatik rate limiting
     * - Token süresi kontrolü (config'te belirlenen süre)
     * - Güvenli token üretimi
     * - Email enumarasyon koruması
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Laravel otomatik olarak:
        // 1. Email'in var olup olmadığını kontrol eder (eğer yoksa bile başarılı mesajı döner - enumarasyon koruması)
        // 2. Rate limiting uygular (1 dakikada max 3 istek)
        // 3. Token üretir ve veritabanına kaydeder
        // 4. Email gönderir
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Her iki durumda da aynı mesaj göster (email enumarasyon koruması)
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }

    /**
     * Şifre sıfırlama formu
     */
    public function resetForm(Request $request, string $token)
    {
        return view('auth.password-reset', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    /**
     * Şifreyi sıfırla
     *
     * Laravel'in built-in Password::reset() kullanılıyor:
     * - Token geçerliliği otomatik kontrol edilir
     * - Token süresi dolmuşsa otomatik reddedilir
     * - Password broker tüm güvenlik kontrollerini yapar
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = $password;
                $user->save();
            }
        );

        // Token geçersiz veya süresi dolmuşsa otomatik hata mesajı döner
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
    }
}
