@extends('frontend.layout')

@section('title', 'İletişim')

@section('content')

<section class="contact-page">

    <div class="container">

        <div class="contact-grid">

            <div class="contact-left">

                <span class="contact-badge">
                    İLETİŞİM
                </span>

                <h1>
                    Eymen Optik ile iletişime geçin
                </h1>

                <p>
                    Ürünler, siparişler, mağaza bilgileri veya destek talepleriniz için bizimle iletişime geçebilirsiniz.
                </p>

                <div class="contact-info">

                    <div class="contact-box">
                        <strong>Telefon</strong>
                        <span>0542 763 99 75</span>
                    </div>

                    <div class="contact-box">
                        <strong>E-Posta</strong>
                        <span>info@eymenoptik.com</span>
                    </div>

                    <div class="contact-box">
                        <strong>Adres</strong>
                        <span>Örtülüpınar, İnönü Blv. 42 C, 58030 Merkez/Sivas</span>
                    </div>

                </div>

            </div>

            <div class="contact-form-card">

                <form class="contact-form">

                    <div class="form-group">
                        <label>Ad Soyad</label>
                        <input type="text" placeholder="Adınızı giriniz">
                    </div>

                    <div class="form-group">
                        <label>E-Posta</label>
                        <input type="email" placeholder="E-posta adresiniz">
                    </div>

                    <div class="form-group">
                        <label>Telefon</label>
                        <input type="text" placeholder="Telefon numaranız">
                    </div>

                    <div class="form-group">
                        <label>Mesaj</label>
                        <textarea rows="5" placeholder="Mesajınızı yazın"></textarea>
                    </div>

                    <button type="submit" class="contact-btn">
                        Mesaj Gönder
                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

<style>

.contact-page{
    padding:80px 0;
    background:#f7f7f7;
    min-height:100vh;
}

.contact-grid{
    display:grid;
    grid-template-columns:1fr 520px;
    gap:40px;
    align-items:center;
}

.contact-badge{
    display:inline-flex;
    padding:10px 16px;
    background:#000;
    color:#fff;
    font-size:12px;
    font-weight:900;
    letter-spacing:1px;
    margin-bottom:24px;
}

.contact-left h1{
    font-size:72px;
    line-height:.95;
    letter-spacing:-4px;
    margin-bottom:22px;
    color:#111;
}

.contact-left p{
    color:#666;
    line-height:1.9;
    max-width:650px;
    margin-bottom:35px;
}

.contact-info{
    display:grid;
    gap:18px;
}

.contact-box{
    background:#fff;
    padding:24px;
    border:1px solid #eee;
}

.contact-box strong{
    display:block;
    font-size:14px;
    margin-bottom:8px;
    color:#999;
}

.contact-box span{
    font-size:22px;
    font-weight:800;
    color:#111;
}

.contact-form-card{
    background:#fff;
    padding:35px;
    border:1px solid #eee;
    box-shadow:0 20px 60px rgba(0,0,0,.05);
}

.contact-form{
    display:grid;
    gap:20px;
}

.form-group{
    display:grid;
    gap:10px;
}

.form-group label{
    font-size:13px;
    font-weight:800;
    color:#111;
}

.form-group input,
.form-group textarea{
    width:100%;
    border:1px solid #e5e5e5;
    background:#fafafa;
    padding:16px;
    outline:none;
    font-size:15px;
}

.contact-btn{
    height:56px;
    border:none;
    background:#000;
    color:#fff;
    font-size:15px;
    font-weight:800;
    cursor:pointer;
    transition:.3s ease;
}

.contact-btn:hover{
    opacity:.85;
}

@media(max-width:992px){

    .contact-grid{
        grid-template-columns:1fr;
    }

    .contact-left h1{
        font-size:52px;
    }

}

@media(max-width:680px){

    .contact-page{
        padding:50px 0;
    }

    .contact-left h1{
        font-size:40px;
        letter-spacing:-2px;
    }

    .contact-form-card{
        padding:22px;
    }

}

</style>

@endsection