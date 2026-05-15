@extends('frontend.layout')

@section('title', 'Kayıt Ol | Eymen Optik')

@section('content')

<section class="auth-page">

    <div class="auth-bg"></div>

    <div class="container">

        <div class="auth-wrapper">

            <div class="auth-left reveal">

                <span class="auth-badge">
                    PREMIUM EYEWEAR
                </span>

                <h1>
                    Eymen Optik’e<br>
                    katılın.
                </h1>

                <p>
                    Siparişlerinizi takip edin, favori ürünlerinizi kaydedin ve premium alışveriş deneyimini keşfedin.
                </p>

                <div class="auth-features">

                    <div class="auth-feature">
                        <span>✓</span>
                        <div>
                            <b>Güvenli Alışveriş</b>
                            <small>256bit SSL koruması</small>
                        </div>
                    </div>

                    <div class="auth-feature">
                        <span>✓</span>
                        <div>
                            <b>Hızlı Sipariş</b>
                            <small>Tek tıkla ödeme akışı</small>
                        </div>
                    </div>

                    <div class="auth-feature">
                        <span>✓</span>
                        <div>
                            <b>Premium Ürünler</b>
                            <small>%100 orijinal ürün garantisi</small>
                        </div>
                    </div>

                </div>

            </div>

            <div class="auth-card reveal">

                <div class="auth-card-top">

                    <h2>Kayıt Ol</h2>

                    <p>
                        Hesabınızı oluşturun ve alışverişe başlayın.
                    </p>

                </div>

                @if ($errors->any())

                    <div class="auth-alert error">

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>

                @endif

                <form method="POST" action="{{ route('register.post') }}" class="auth-form">

                    @csrf

                    <div class="form-group">
                        <label>Ad Soyad</label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Adınız Soyadınız"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label>E-Posta</label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="ornek@mail.com"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label>Şifre</label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Minimum 8 karakter"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label>Şifre Tekrar</label>

                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="Şifrenizi tekrar girin"
                            required
                        >
                    </div>

                    <button type="submit" class="auth-btn">
                        Hesap Oluştur
                    </button>

                </form>

                <div class="auth-bottom">

                    <span>
                        Zaten hesabınız var mı?
                    </span>

                    <a href="{{ route('login') }}">
                        Giriş Yap
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection

@section('page_css')

<style>

.auth-page{
    min-height:100vh;
    position:relative;
    overflow:hidden;
    background:#f5f5f5;
    display:flex;
    align-items:center;
    padding:60px 0;
}

.auth-bg{
    position:absolute;
    inset:0;
    background:
        radial-gradient(circle at top left, rgba(199,154,58,.15), transparent 28%),
        radial-gradient(circle at bottom right, rgba(0,0,0,.08), transparent 32%);
    pointer-events:none;
}

.auth-wrapper{
    position:relative;
    z-index:2;
    display:grid;
    grid-template-columns:1fr 520px;
    gap:60px;
    align-items:center;
}

.auth-left h1{
    font-size:82px;
    line-height:.92;
    letter-spacing:-5px;
    margin-bottom:24px;
    color:#111;
}

.auth-left p{
    color:#666;
    font-size:16px;
    line-height:1.9;
    max-width:620px;
    margin-bottom:36px;
}

.auth-badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    height:42px;
    padding:0 18px;
    background:#000;
    color:#fff;
    font-size:12px;
    font-weight:900;
    letter-spacing:1px;
    margin-bottom:24px;
}

.auth-features{
    display:grid;
    gap:18px;
}

.auth-feature{
    display:flex;
    gap:16px;
    align-items:flex-start;
}

.auth-feature span{
    width:38px;
    height:38px;
    border-radius:50%;
    background:#000;
    color:#fff;
    display:grid;
    place-items:center;
    font-weight:900;
}

.auth-feature b{
    display:block;
    font-size:15px;
    margin-bottom:4px;
}

.auth-feature small{
    color:#777;
}

.auth-card{
    background:#fff;
    border:1px solid #eee;
    padding:42px;
    box-shadow:0 30px 80px rgba(0,0,0,.08);
}

.auth-card-top{
    margin-bottom:28px;
}

.auth-card-top h2{
    font-size:42px;
    margin-bottom:10px;
    letter-spacing:-2px;
}

.auth-card-top p{
    color:#777;
    line-height:1.7;
}

.auth-form{
    display:grid;
    gap:18px;
}

.form-group{
    display:grid;
    gap:10px;
}

.form-group label{
    font-size:13px;
    font-weight:900;
    color:#111;
}

.form-group input{
    width:100%;
    height:58px;
    border:1px solid #e5e5e5;
    background:#fafafa;
    padding:0 18px;
    font-size:14px;
    outline:none;
    transition:.25s ease;
}

.form-group input:focus{
    border-color:#000;
    background:#fff;
}

.auth-btn{
    width:100%;
    height:58px;
    border:none;
    background:#000;
    color:#fff;
    font-size:14px;
    font-weight:900;
    cursor:pointer;
    transition:.25s ease;
    margin-top:8px;
}

.auth-btn:hover{
    background:#c79a3a;
}

.auth-bottom{
    margin-top:24px;
    display:flex;
    justify-content:center;
    gap:8px;
    flex-wrap:wrap;
}

.auth-bottom span{
    color:#777;
}

.auth-bottom a{
    color:#000;
    font-weight:900;
}

.auth-alert{
    padding:16px;
    margin-bottom:20px;
    font-size:14px;
}

.auth-alert.error{
    background:#fff1f1;
    color:#d63031;
    border:1px solid #ffd4d4;
}

.auth-alert ul{
    margin:0;
    padding-left:18px;
}

@media(max-width:1100px){

    .auth-wrapper{
        grid-template-columns:1fr;
    }

    .auth-left{
        display:none;
    }

}

@media(max-width:680px){

    .auth-page{
        padding:30px 0;
    }

    .auth-card{
        padding:24px;
    }

    .auth-card-top h2{
        font-size:34px;
    }

}

</style>

@endsection

@section('page_js')

<script>

document.addEventListener('DOMContentLoaded', function(){

    const reveals = document.querySelectorAll('.reveal');

    const observer = new IntersectionObserver((entries)=>{

        entries.forEach(entry=>{

            if(entry.isIntersecting){

                entry.target.classList.add('show');

            }

        });

    }, { threshold:.12 });

    reveals.forEach(item=> observer.observe(item));

});

</script>

@endsection