@extends('frontend.layout')

@section('title', 'Güvenli Ödeme | Eymen Optik')

@section('content')

<section class="payment-page">
    <div class="container">

        <div class="payment-card">
            <span>İYZİCO GÜVENLİ ÖDEME</span>

            <h1>Ödeme Bilgileri</h1>

            <p>
                Kart bilgilerinizi güvenli ödeme formu üzerinden girerek siparişinizi tamamlayabilirsiniz.
            </p>

            <div class="iyzico-box">
                {!! $checkoutFormContent !!}
            </div>
        </div>

    </div>
</section>

<style>
    .payment-page {
        padding: 70px 0;
        background: #f6f6f6;
        min-height: 70vh;
    }

    .payment-card {
        background: #fff;
        border: 1px solid #eee;
        padding: 40px;
        max-width: 900px;
        margin: auto;
        box-shadow: 0 20px 60px rgba(0,0,0,.06);
    }

    .payment-card > span {
        display: inline-flex;
        background: #000;
        color: #fff;
        padding: 9px 14px;
        font-size: 12px;
        font-weight: 900;
        margin-bottom: 20px;
    }

    .payment-card h1 {
        font-size: 48px;
        margin-bottom: 12px;
        letter-spacing: -2px;
    }

    .payment-card p {
        color: #666;
        line-height: 1.8;
        margin-bottom: 30px;
    }

    .iyzico-box {
        min-height: 400px;
    }
</style>

@endsection