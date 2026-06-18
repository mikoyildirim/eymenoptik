```blade
@extends('frontend.layout')

@section('title','SSL Sertifikası')

@section('page_css')
<style>
    .legal-page{
        padding:80px 0;
        background:#f7f7f7;
    }

    .legal-card{
        background:#fff;
        border:1px solid #eee;
        padding:45px;
        border-radius:26px;
        box-shadow:0 25px 70px rgba(0,0,0,.06);
    }

    .legal-card span{
        display:inline-block;
        background:#000;
        color:#fff;
        padding:8px 14px;
        font-size:12px;
        font-weight:900;
        margin-bottom:18px;
        letter-spacing:.04em;
    }

    .legal-card h1{
        font-size:44px;
        line-height:1.1;
        margin-bottom:18px;
        color:#111;
    }

    .legal-card h2{
        font-size:22px;
        margin:30px 0 10px;
        color:#111;
    }

    .legal-card p,
    .legal-card li{
        color:#555;
        line-height:1.9;
        font-size:15px;
    }

    .legal-card p{
        margin-bottom:14px;
    }

    .legal-card ul{
        padding-left:20px;
        margin-top:10px;
        margin-bottom:18px;
    }

    .legal-card strong{
        color:#111;
    }

    .legal-info{
        background:#f7f7f7;
        border:1px solid #eee;
        border-radius:18px;
        padding:20px;
        margin:24px 0;
    }

    .legal-info p{
        margin:0;
    }

    @media(max-width:768px){
        .legal-page{
            padding:45px 0;
        }

        .legal-card{
            padding:28px;
            border-radius:20px;
        }

        .legal-card h1{
            font-size:32px;
        }

        .legal-card h2{
            font-size:20px;
        }

        .legal-card p,
        .legal-card li{
            font-size:14px;
        }
    }
</style>
@endsection

@section('content')

<section class="legal-page">
    <div class="container">
        <div class="legal-card">

            <span>SSL SERTİFİKASI</span>

            <h1>SSL Sertifikası ve Güvenli Alışveriş</h1>

            <p>
                Eymen Optik olarak kullanıcılarımızın güvenli, hızlı ve sorunsuz bir alışveriş deneyimi
                yaşamasını önemsiyoruz. Web sitemizde kullanıcı bilgilerinin güvenli şekilde iletilmesine
                yardımcı olmak amacıyla SSL güvenlik altyapısı kullanılmaktadır.
            </p>

            <p>
                SSL sertifikası, kullanıcı ile web sitesi arasında gerçekleşen veri aktarımının şifrelenmesine
                yardımcı olur. Bu sayede üyelik, sipariş, teslimat ve ödeme süreçlerinde paylaşılan bilgilerin
                güvenli bağlantı üzerinden iletilmesi amaçlanır.
            </p>

            <div class="legal-info">
                <p>
                    <strong>Firma:</strong> Eymen Optik<br>
                    <strong>Web Sitesi:</strong> eymenoptiklens.com<br>
                    <strong>E-posta:</strong> info@eymenoptiklens.com<br>
                    <strong>Güvenlik:</strong> SSL sertifikası ile şifreli bağlantı
                </p>
            </div>

            <h2>1. SSL Sertifikası Nedir?</h2>
            <p>
                SSL sertifikası, web sitesi ile kullanıcı tarayıcısı arasında aktarılan bilgilerin şifreli
                şekilde iletilmesini sağlayan güvenlik teknolojisidir. Bu teknoloji, kullanıcıların web sitesi
                üzerinde paylaştığı bilgilerin üçüncü kişiler tarafından izinsiz şekilde görüntülenmesini
                zorlaştırmaya yardımcı olur.
            </p>

            <h2>2. Güvenli Bağlantı Nasıl Anlaşılır?</h2>
            <p>
                Web sitemizi ziyaret ettiğinizde tarayıcınızın adres çubuğunda kilit simgesi görünüyorsa,
                bağlantınız güvenli şekilde sağlanmaktadır. Ayrıca web sitesi adresinin <strong>https://</strong>
                ile başlaması, bağlantının SSL sertifikası üzerinden çalıştığını gösterir.
            </p>

            <p>
                Kullanıcılarımızın alışveriş yapmadan önce adres çubuğundaki kilit simgesini ve web sitesi
                adresini kontrol etmesini öneririz.
            </p>

            <h2>3. Güvenli Alışveriş</h2>
            <p>
                Eymen Optik web sitesinde üyelik, sipariş, teslimat ve iletişim süreçlerinde paylaşılan bilgiler
                güvenli bağlantı üzerinden iletilir. Kullanıcı bilgilerinin korunması için gerekli teknik ve
                idari önlemler alınmaya çalışılır.
            </p>

            <p>
                Web sitemiz üzerinden yapılan işlemlerde kullanıcı deneyiminin güvenli, anlaşılır ve şeffaf
                olması temel önceliklerimiz arasındadır.
            </p>

            <h2>4. Ödeme Güvenliği</h2>
            <p>
                Ödeme işlemleri güvenli ödeme altyapıları üzerinden gerçekleştirilir. Kredi kartı veya banka kartı
                bilgileriniz Eymen Optik tarafından saklanmaz.
            </p>

            <p>
                Kart bilgileriniz, ödeme işlemi sırasında ilgili ödeme hizmeti sağlayıcısının güvenli sistemleri
                üzerinden işlenir. Eymen Optik yalnızca sipariş sürecinin yürütülmesi için gerekli ödeme işlem
                sonucunu görüntüler.
            </p>

            <h2>5. Kişisel Bilgilerin Korunması</h2>
            <p>
                Kullanıcılarımızın ad, soyad, telefon, e-posta, teslimat adresi, fatura bilgileri ve sipariş
                bilgileri yalnızca hizmet süreçlerinin yürütülmesi amacıyla kullanılır.
            </p>

            <ul>
                <li>Siparişlerin hazırlanması,</li>
                <li>Ürünlerin teslim edilmesi,</li>
                <li>Fatura işlemlerinin yapılması,</li>
                <li>Müşteri destek taleplerinin cevaplanması,</li>
                <li>İade ve değişim süreçlerinin yürütülmesi,</li>
                <li>Yasal yükümlülüklerin yerine getirilmesi.</li>
            </ul>

            <h2>6. Kart Bilgileri Saklanmaz</h2>
            <p>
                Eymen Optik, kullanıcıların kredi kartı veya banka kartı bilgilerini kendi sistemlerinde saklamaz.
                Ödeme işlemleri, güvenli ödeme kuruluşlarının altyapıları üzerinden gerçekleştirilir.
            </p>

            <p>
                Bu nedenle ödeme sırasında girilen kart numarası, son kullanma tarihi ve güvenlik kodu gibi
                hassas kart bilgileri Eymen Optik tarafından kayıt altına alınmaz.
            </p>

            <h2>7. Hesap ve Şifre Güvenliği</h2>
            <p>
                Kullanıcı hesabı oluşturan müşteriler, hesap bilgilerinin ve şifrelerinin güvenliğinden
                sorumludur. Şifrenin üçüncü kişilerle paylaşılmaması ve kolay tahmin edilebilir şifreler
                kullanılmaması önerilir.
            </p>

            <p>
                Hesabınızda şüpheli bir işlem fark etmeniz halinde bizimle iletişime geçebilirsiniz.
            </p>

            <h2>8. Güvenli Alışveriş İçin Öneriler</h2>
            <ul>
                <li>Web sitesi adresinin <strong>https://</strong> ile başladığını kontrol ediniz.</li>
                <li>Tarayıcı adres çubuğunda kilit simgesi olduğundan emin olunuz.</li>
                <li>Üyelik şifrenizi üçüncü kişilerle paylaşmayınız.</li>
                <li>Ortak bilgisayar veya halka açık Wi-Fi ağlarında ödeme yaparken dikkatli olunuz.</li>
                <li>Şüpheli e-posta, mesaj veya bağlantılar üzerinden kart bilgilerinizi paylaşmayınız.</li>
                <li>Alışveriş işleminizi tamamladıktan sonra ortak cihazlarda hesabınızdan çıkış yapınız.</li>
            </ul>

            <h2>9. Çerez ve Site Güvenliği</h2>
            <p>
                Web sitemizde kullanıcı deneyimini geliştirmek, sepet işlemlerini yürütmek, site performansını
                ölçmek ve güvenliği sağlamak amacıyla çerezler kullanılabilir. Çerez kullanımı hakkında detaylı
                bilgiye Gizlilik Sözleşmesi sayfamızdan ulaşabilirsiniz.
            </p>

            <h2>10. Üçüncü Taraf Ödeme ve Hizmet Sağlayıcıları</h2>
            <p>
                Ödeme, kargo, fatura ve teknik altyapı süreçlerinde üçüncü taraf hizmet sağlayıcılarla çalışılabilir.
                Bu hizmet sağlayıcılarla yalnızca işlemin yürütülmesi için gerekli olan sınırlı bilgiler paylaşılır.
            </p>

            <p>
                Kişisel bilgileriniz, hizmetin sağlanması ve yasal yükümlülüklerin yerine getirilmesi dışında
                izinsiz olarak üçüncü kişilerle paylaşılmaz.
            </p>

            <h2>11. Güvenlik Güncellemeleri</h2>
            <p>
                Eymen Optik, web sitesi güvenliğini korumak ve kullanıcı deneyimini iyileştirmek amacıyla
                teknik altyapısında dönemsel güncellemeler yapabilir. Güvenlik uygulamaları, ödeme altyapısı
                veya site özelliklerinde değişiklik olması halinde ilgili sayfalarda güncelleme yapılabilir.
            </p>

            <h2>12. İletişim</h2>
            <p>
                SSL sertifikası, güvenli alışveriş, ödeme güvenliği veya kişisel bilgilerinizin korunmasıyla
                ilgili sorularınız için Eymen Optik ile iletişime geçebilirsiniz.
            </p>

            <ul>
                <li><strong>E-posta:</strong> info@eymenoptiklens.com</li>
                <li><strong>Web Sitesi:</strong> eymenoptiklens.com</li>
                <li><strong>Adres ve Telefon:</strong> Web sitemizin iletişim sayfasında belirtilen güncel firma bilgileri geçerlidir.</li>
            </ul>

            <p>
                Eymen Optik, güvenli alışveriş ve SSL sertifikası bilgilendirmesinde teknik altyapı,
                ödeme süreçleri veya yasal gerekliliklere bağlı olarak güncelleme yapma hakkını saklı tutar.
                Güncel metin web sitesinde yayımlandığı tarihten itibaren geçerlidir.
            </p>

        </div>
    </div>
</section>

@endsection
```
