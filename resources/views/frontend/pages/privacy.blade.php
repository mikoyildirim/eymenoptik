@extends('frontend.layout')

@section('title','Gizlilik Sözleşmesi')


@section('page_css')
<style>
    .legal-page{padding:80px 0;background:#f7f7f7;}
    .legal-card{background:#fff;border:1px solid #eee;padding:45px;border-radius:26px;box-shadow:0 25px 70px rgba(0,0,0,.06);}
    .legal-card span{display:inline-block;background:#000;color:#fff;padding:8px 14px;font-size:12px;font-weight:900;margin-bottom:18px;}
    .legal-card h1{font-size:44px;line-height:1.1;margin-bottom:18px;}
    .legal-card h2{font-size:22px;margin:28px 0 10px;}
    .legal-card p,.legal-card li{color:#555;line-height:1.9;font-size:15px;}
    .legal-card ul{padding-left:20px;margin-top:10px;}
    @media(max-width:768px){.legal-page{padding:45px 0}.legal-card{padding:28px;border-radius:20px}.legal-card h1{font-size:32px}}
</style>
@endsection


@section('content')
<section class="legal-page">
    <div class="container">
        <div class="legal-card">
            <span>GİZLİLİK</span>
            <h1>Gizlilik Sözleşmesi</h1>
            <p>Eymen Optik, kullanıcı bilgilerinin gizliliğine önem verir. Web sitemiz üzerinden paylaşılan kişisel bilgiler yalnızca sipariş, iletişim, üyelik ve yasal yükümlülüklerin yerine getirilmesi amacıyla kullanılır.</p>
<h2>Kişisel Veriler</h2><p>Ad, soyad, telefon, e-posta, adres ve sipariş bilgileriniz hizmet süreçlerinin yürütülmesi için işlenebilir.</p>
<h2>Üçüncü Taraflar</h2><p>Bilgileriniz, ödeme altyapısı, kargo ve yasal zorunluluklar dışında üçüncü kişilerle paylaşılmaz.</p>
        </div>
    </div>
</section>
@endsection
