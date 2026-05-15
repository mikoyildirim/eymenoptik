@extends('frontend.layout')

@section('title', 'Sipariş Başarılı')

@section('content')

<section class="result-page">
    <div class="container">
        <div class="result-card">
            <div class="result-icon success">✓</div>

            <h1>Siparişiniz alındı</h1>

            <p>
                Ödeme süreciniz başarıyla tamamlandı. Siparişiniz hazırlanma aşamasına alınacaktır.
            </p>

            <div class="result-actions">
                <a href="{{ route('home') }}">Ana Sayfa</a>
                <a href="{{ route('products.index') }}">Alışverişe Devam Et</a>
            </div>
        </div>
    </div>
</section>

<script>
    localStorage.removeItem('eymen_cart');
</script>

<style>
    .result-page {
        min-height:70vh;
        display:grid;
        place-items:center;
        padding:70px 0;
        background:#f6f6f6;
    }

    .result-card {
        background:#fff;
        padding:55px;
        text-align:center;
        max-width:620px;
        margin:auto;
        border:1px solid #eee;
        box-shadow:0 20px 60px rgba(0,0,0,.06);
    }

    .result-icon {
        width:90px;
        height:90px;
        border-radius:50%;
        display:grid;
        place-items:center;
        margin:0 auto 24px;
        font-size:44px;
        font-weight:900;
    }

    .result-icon.success {
        background:#e8fff4;
        color:#16a36b;
    }

    .result-card h1 {
        font-size:44px;
        margin-bottom:14px;
    }

    .result-card p {
        color:#666;
        line-height:1.8;
        margin-bottom:28px;
    }

    .result-actions {
        display:flex;
        justify-content:center;
        gap:12px;
        flex-wrap:wrap;
    }

    .result-actions a {
        background:#000;
        color:#fff;
        padding:15px 24px;
        font-weight:900;
    }
</style>

@endsection