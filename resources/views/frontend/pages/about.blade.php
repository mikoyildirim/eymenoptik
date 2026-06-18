@extends('frontend.layout')

@section('title','Hakkımızda')

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

    .about-info{
        background:#f7f7f7;
        border:1px solid #eee;
        border-radius:18px;
        padding:20px;
        margin:24px 0;
    }

    .about-info p{
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

            <span>HAKKIMIZDA</span>

            <h1>Hakkımızda</h1>

            <p>
                Eymen Optik, kaliteli, güvenilir ve modern optik alışveriş deneyimini müşterileriyle
                buluşturmak amacıyla hizmet veren bir optik ürün platformudur. Güneş gözlüğü, optik çerçeve,
                dereceli gözlük, lens ve optik aksesuar kategorilerinde kullanıcıların ihtiyaçlarına uygun
                ürünleri kolay ve güvenli bir alışveriş deneyimiyle sunmayı hedefler.
            </p>

            <p>
                Müşteri memnuniyetini ön planda tutan hizmet anlayışımızla, ürün seçiminden sipariş teslimine
                kadar tüm süreçlerde kullanıcılarımıza güvenilir, şeffaf ve destekleyici bir alışveriş
                deneyimi sağlamaya çalışıyoruz.
            </p>

            <div class="about-info">
                <p>
                    <strong>Firma:</strong> Eymen Optik<br>
                    <strong>Web Sitesi:</strong> eymenoptiklens.com<br>
                    <strong>E-posta:</strong> info@eymenoptiklens.com<br>
                    <strong>Hizmet Alanı:</strong> Optik ürünler, güneş gözlüğü, çerçeve, lens ve aksesuar satışı
                </p>
            </div>

            <h2>Kaliteli Ürün Anlayışı</h2>
            <p>
                Eymen Optik olarak ürünlerimizi kalite, kullanım rahatlığı, tasarım, dayanıklılık ve müşteri
                beklentileri doğrultusunda sunuyoruz. Kullanıcılarımızın tarzına, ihtiyacına ve bütçesine uygun
                ürün seçenekleriyle güvenilir bir alışveriş ortamı oluşturmayı amaçlıyoruz.
            </p>

            <p>
                Ürün kategorilerimizde farklı yaş gruplarına, farklı kullanım alışkanlıklarına ve farklı stil
                tercihlerine hitap eden seçenekler yer almaktadır. Güneş gözlüğünden optik çerçeveye, lensten
                aksesuara kadar birçok ürünü kullanıcılarımızla buluşturuyoruz.
            </p>

            <h2>Vizyonumuz</h2>
            <p>
                Vizyonumuz; optik sektöründe güvenilir, ulaşılabilir ve kullanıcı dostu bir alışveriş deneyimi
                sunarak müşteri memnuniyetini sürekli hale getiren güçlü bir marka olmaktır.
            </p>

            <p>
                Modern alışveriş alışkanlıklarına uygun, hızlı, güvenli ve şeffaf bir sistemle kullanıcılarımızın
                optik ürünlere kolayca ulaşmasını sağlamayı hedefliyoruz.
            </p>

            <h2>Misyonumuz</h2>
            <p>
                Misyonumuz; müşterilerimize doğru ürünleri, şeffaf fiyatlandırma, güvenli ödeme altyapısı,
                hızlı sipariş süreci ve destek odaklı hizmet anlayışıyla sunmaktır.
            </p>

            <p>
                Alışveriş sürecinin her aşamasında kullanıcılarımızın güvenini kazanmak, ihtiyaçlarına uygun
                çözümler üretmek ve satış sonrası süreçlerde de destek sağlamak temel önceliklerimiz arasındadır.
            </p>

            <h2>Güvenli Alışveriş</h2>
            <p>
                Web sitemizde kullanıcı bilgilerinin güvenli şekilde iletilmesi için SSL güvenlik altyapısı
                kullanılmaktadır. Ödeme işlemleri güvenli ödeme sistemleri üzerinden gerçekleştirilir.
                Kredi kartı veya banka kartı bilgileriniz Eymen Optik tarafından saklanmaz.
            </p>

            <p>
                Kullanıcılarımızın kişisel verileri, yalnızca sipariş, teslimat, fatura, müşteri hizmetleri
                ve yasal yükümlülüklerin yerine getirilmesi amacıyla işlenir.
            </p>

            <h2>Ürün Kategorilerimiz</h2>
            <p>
                Eymen Optik web sitesinde kullanıcılarımızın farklı ihtiyaçlarına yönelik birçok ürün kategorisi
                bulunmaktadır.
            </p>

            <ul>
                <li>Güneş gözlüğü modelleri,</li>
                <li>Optik çerçeve ürünleri,</li>
                <li>Dereceli gözlük seçenekleri,</li>
                <li>Lens ürünleri,</li>
                <li>Optik aksesuarlar,</li>
                <li>Farklı marka ve model seçenekleri.</li>
            </ul>

            <h2>Müşteri Memnuniyeti</h2>
            <p>
                Eymen Optik olarak müşteri memnuniyetini yalnızca satış anıyla sınırlı görmüyoruz.
                Sipariş öncesi bilgilendirme, sipariş takibi, teslimat, değişim ve iade süreçlerinde de
                kullanıcılarımızın yanında olmayı önemsiyoruz.
            </p>

            <p>
                Müşterilerimizden gelen talep, öneri ve geri bildirimleri dikkate alarak hizmet kalitemizi
                sürekli geliştirmeyi amaçlıyoruz.
            </p>

            <h2>Şeffaf Hizmet Anlayışı</h2>
            <p>
                Ürün açıklamaları, fiyat bilgileri, teslimat süreçleri, iade koşulları ve ödeme seçenekleri
                kullanıcılarımızın kolayca inceleyebileceği şekilde web sitemizde sunulmaktadır.
            </p>

            <p>
                Amacımız, müşterilerimizin sipariş vermeden önce ihtiyaç duyduğu bilgilere açık ve anlaşılır
                şekilde ulaşabilmesini sağlamaktır.
            </p>

            <h2>Teslimat ve Satış Sonrası Destek</h2>
            <p>
                Siparişler ödeme onayının ardından hazırlanarak teslimat sürecine alınır. Ürünlerin teslimat,
                değişim ve iade süreçleri web sitemizde yer alan Teslimat ve İade Şartları kapsamında yürütülür.
            </p>

            <p>
                Siparişiniz, ürünlerimiz veya satış sonrası süreçler hakkında bilgi almak için web sitemizdeki
                iletişim kanalları üzerinden bizimle iletişime geçebilirsiniz.
            </p>

            <h2>Neden Eymen Optik?</h2>
            <ul>
                <li>Geniş ürün kategorisi ve farklı model seçenekleri,</li>
                <li>Güvenli ödeme altyapısı,</li>
                <li>SSL sertifikası ile güvenli bağlantı,</li>
                <li>Şeffaf fiyatlandırma ve kolay alışveriş süreci,</li>
                <li>Müşteri memnuniyetini önemseyen hizmet anlayışı,</li>
                <li>Teslimat, iade ve değişim süreçlerinde destek.</li>
            </ul>

            <h2>İletişim</h2>
            <p>
                Eymen Optik ürünleri, siparişler, teslimat, iade, değişim veya diğer konularla ilgili sorularınız
                için bizimle iletişime geçebilirsiniz.
            </p>

            <ul>
                <li><strong>E-posta:</strong> info@eymenoptiklens.com</li>
                <li><strong>Web Sitesi:</strong> eymenoptiklens.com</li>
                <li><strong>Adres ve Telefon:</strong> Web sitemizin iletişim sayfasında belirtilen güncel firma bilgileri geçerlidir.</li>
            </ul>

        </div>
    </div>
</section>

@endsection