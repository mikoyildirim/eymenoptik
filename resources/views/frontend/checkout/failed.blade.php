@extends('frontend.layout')

@section('title', 'Ödeme Başarısız')

@section('content')

<section class="result-page">
    <div class="container">
        <div class="result-card">
            <div class="result-icon failed">!</div>

            <h1>Ödeme tamamlanamadı</h1>
            <p>
                Ödeme sırasında bir sorun oluştu. Bilgilerinizi kontrol ederek tekrar deneyebilirsiniz.
            </p>

            @php
            $paymentError = session('error') ?? session('payment_error');
            @endphp

            @if($paymentError)
            <div class="payment-error-box">
                {{ $paymentError }}
            </div>

            <script>
                console.error(@json($paymentError));
            </script>
            @endif
            <div class="result-actions">
                <a href="{{ route('checkout.index') }}">Tekrar Dene</a>
                <a href="{{ route('products.index') }}">Alışverişe Dön</a>
            </div>
        </div>
    </div>
</section>

<style>
    .result-page {
        min-height: 70vh;
        display: grid;
        place-items: center;
        padding: 70px 0;
        background: #f6f6f6;
    }

    .result-card {
        background: #fff;
        padding: 55px;
        text-align: center;
        max-width: 620px;
        margin: auto;
        border: 1px solid #eee;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .06);
    }

    .result-icon {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        margin: 0 auto 24px;
        font-size: 44px;
        font-weight: 900;
    }

    .result-icon.failed {
        background: #fff0f0;
        color: #e33b3b;
    }

    .result-card h1 {
        font-size: 44px;
        margin-bottom: 14px;
    }

    .result-card p {
        color: #666;
        line-height: 1.8;
        margin-bottom: 28px;
    }

    .result-actions {
        display: flex;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .result-actions a {
        background: #000;
        color: #fff;
        padding: 15px 24px;
        font-weight: 900;

    }

    .payment-error-box {
        margin: 20px 0 28px;
        padding: 16px;
        background: #fff0f0;
        border: 1px solid #ffd1d1;
        color: #c62828;
        font-weight: 700;
        line-height: 1.6;
    }
</style>

@endsection