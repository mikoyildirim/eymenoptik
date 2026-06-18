```blade
@extends('frontend.layout')

@section('title','Gizlilik Sözleşmesi')

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

    .legal-card h3{
        font-size:18px;
        margin:22px 0 8px;
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

            <span>GİZLİLİK</span>

            <h1>Gizlilik Sözleşmesi</h1>

            <p>
                Eymen Optik olarak, kullanıcılarımızın ve müşterilerimizin kişisel verilerinin gizliliğine
                ve güvenliğine önem veriyoruz. Bu Gizlilik Sözleşmesi, Eymen Optik web sitesi üzerinden
                toplanan kişisel verilerin hangi amaçlarla işlendiğini, nasıl korunduğunu, kimlerle
                paylaşılabileceğini ve kullanıcıların haklarını açıklamak amacıyla hazırlanmıştır.
            </p>

            <p>
                Web sitemizi ziyaret eden, üyelik oluşturan, sipariş veren veya iletişim kanallarımız üzerinden
                bizimle paylaşımda bulunan kullanıcılar, bu Gizlilik Sözleşmesi kapsamında belirtilen
                bilgilendirmeleri okumuş kabul edilir.
            </p>

            <div class="legal-info">
                <p>
                    <strong>Firma:</strong> Eymen Optik<br>
                    <strong>Web Sitesi:</strong> eymenoptiklens.com<br>
                    <strong>E-posta:</strong> info@eymenoptiklens.com<br>
                    <strong>Adres ve Telefon:</strong> Web sitemizin iletişim sayfasında belirtilen güncel firma bilgileri geçerlidir.
                </p>
            </div>

            <h2>1. Gizlilik ve Veri Güvenliği Anlayışımız</h2>
            <p>
                Eymen Optik, müşterilerine güvenli ve şeffaf bir alışveriş deneyimi sunmayı hedefler.
                Bu kapsamda kullanıcıların kişisel bilgileri yalnızca gerekli hizmet süreçlerinin yürütülmesi,
                siparişlerin hazırlanması, teslimatın yapılması, ödeme işlemlerinin tamamlanması, müşteri
                destek taleplerinin cevaplanması ve yasal yükümlülüklerin yerine getirilmesi amacıyla kullanılır.
            </p>

            <p>
                Kişisel veriler, yetkisiz erişim, kayıp, kötüye kullanım veya izinsiz paylaşım risklerine karşı
                uygun teknik ve idari tedbirler alınarak korunmaya çalışılır.
            </p>

            <h2>2. Toplanan Kişisel Veriler</h2>
            <p>
                Web sitemiz üzerinden üyelik oluşturma, sipariş verme, ödeme işlemi gerçekleştirme, iletişim formu
                doldurma veya müşteri hizmetleriyle iletişime geçme süreçlerinde aşağıdaki bilgiler işlenebilir:
            </p>

            <ul>
                <li>Ad ve soyad bilgisi,</li>
                <li>Telefon numarası,</li>
                <li>E-posta adresi,</li>
                <li>Teslimat adresi,</li>
                <li>Fatura adresi,</li>
                <li>Sipariş ve alışveriş bilgileri,</li>
                <li>Ürün tercihleri ve sepet bilgileri,</li>
                <li>Fatura ve ödeme işlem sonuç bilgileri,</li>
                <li>IP adresi, cihaz bilgileri ve işlem kayıtları,</li>
                <li>Müşteri destek talepleri ve iletişim kayıtları.</li>
            </ul>

            <h2>3. Kişisel Verilerin İşlenme Amaçları</h2>
            <p>
                Toplanan kişisel veriler aşağıdaki amaçlarla işlenebilir:
            </p>

            <ul>
                <li>Siparişlerin alınması, hazırlanması ve teslim edilmesi,</li>
                <li>Üyelik ve kullanıcı hesabı işlemlerinin yürütülmesi,</li>
                <li>Fatura ve muhasebe işlemlerinin yapılması,</li>
                <li>Ödeme ve tahsilat süreçlerinin yürütülmesi,</li>
                <li>Kargo ve teslimat süreçlerinin yönetilmesi,</li>
                <li>İade, değişim ve cayma hakkı işlemlerinin yürütülmesi,</li>
                <li>Müşteri destek taleplerinin cevaplanması,</li>
                <li>Ürün ve hizmet kalitesinin geliştirilmesi,</li>
                <li>Web sitesi deneyiminin iyileştirilmesi,</li>
                <li>Güvenlik, dolandırıcılık ve kötüye kullanımın önlenmesi,</li>
                <li>Yasal yükümlülüklerin yerine getirilmesi.</li>
            </ul>

            <h2>4. Ödeme Bilgileri ve Güvenli Ödeme</h2>
            <p>
                Web sitemiz üzerinden yapılan ödeme işlemleri güvenli ödeme altyapıları aracılığıyla
                gerçekleştirilir. Kredi kartı veya banka kartı bilgileriniz Eymen Optik tarafından saklanmaz.
            </p>

            <p>
                Kart bilgileriniz, ödeme işlemi sırasında ilgili ödeme hizmeti sağlayıcısının güvenli ödeme
                sistemleri üzerinden işlenir. Eymen Optik yalnızca ödeme işleminin başarılı olup olmadığına
                ilişkin işlem sonucunu ve sipariş sürecinin yürütülmesi için gerekli sınırlı bilgileri kullanır.
            </p>

            <h2>5. Kişisel Verilerin Aktarılması</h2>
            <p>
                Kişisel verileriniz, hizmet süreçlerinin yürütülebilmesi için gerekli olduğu ölçüde aşağıdaki
                kişi, kurum ve hizmet sağlayıcılarla paylaşılabilir:
            </p>

            <ul>
                <li>Kargo ve lojistik firmaları,</li>
                <li>Ödeme hizmeti sağlayıcıları,</li>
                <li>Bankalar ve finans kuruluşları,</li>
                <li>Fatura ve muhasebe hizmet sağlayıcıları,</li>
                <li>Teknik altyapı, yazılım ve hosting hizmet sağlayıcıları,</li>
                <li>Müşteri destek ve iletişim hizmet sağlayıcıları,</li>
                <li>Yetkili kamu kurum ve kuruluşları,</li>
                <li>Yasal zorunluluk halinde adli ve idari merciler.</li>
            </ul>

            <p>
                Kişisel verileriniz, yukarıda belirtilen amaçlar dışında üçüncü kişilerle izinsiz olarak
                paylaşılmaz, satılmaz veya ticari amaçla devredilmez.
            </p>

            <h2>6. Kargo ve Teslimat Süreçlerinde Veri Kullanımı</h2>
            <p>
                Siparişinizin teslim edilebilmesi için ad, soyad, telefon numarası ve teslimat adresi gibi
                bilgileriniz anlaşmalı kargo veya lojistik firmalarıyla paylaşılabilir.
            </p>

            <p>
                Bu paylaşım yalnızca ürünün doğru kişiye ve doğru adrese teslim edilebilmesi amacıyla yapılır.
            </p>

            <h2>7. Fatura ve Yasal Kayıtlar</h2>
            <p>
                Siparişlere ilişkin fatura, ödeme, teslimat ve işlem kayıtları ilgili mevzuat kapsamında
                saklanabilir. Bu bilgiler, muhasebe kayıtlarının oluşturulması, yasal yükümlülüklerin yerine
                getirilmesi ve olası uyuşmazlıkların çözümlenmesi amacıyla kullanılabilir.
            </p>

            <h2>8. Çerez Kullanımı</h2>
            <p>
                Web sitemizde kullanıcı deneyimini geliştirmek, site performansını ölçmek, güvenliği sağlamak,
                alışveriş sepeti işlemlerini yürütmek ve web sitesinin daha verimli çalışmasını sağlamak amacıyla
                çerezler kullanılabilir.
            </p>

            <p>
                Çerezler; tarayıcınız aracılığıyla cihazınıza kaydedilen küçük veri dosyalarıdır. Tarayıcı
                ayarlarınız üzerinden çerezleri silebilir, engelleyebilir veya çerez kullanımını sınırlandırabilirsiniz.
                Ancak çerezlerin tamamen kapatılması halinde web sitemizin bazı özellikleri doğru çalışmayabilir.
            </p>

            <h2>9. Kullanıcı Hesabı ve Şifre Güvenliği</h2>
            <p>
                Üyelik hesabı oluşturan kullanıcılar, hesap bilgilerinin ve şifrelerinin güvenliğinden sorumludur.
                Şifrenin üçüncü kişilerle paylaşılmaması, kolay tahmin edilebilir şifreler kullanılmaması ve
                hesapta şüpheli bir işlem fark edilmesi halinde Eymen Optik ile iletişime geçilmesi önerilir.
            </p>

            <h2>10. Kişisel Verilerin Saklanma Süresi</h2>
            <p>
                Kişisel verileriniz, işleme amacının gerektirdiği süre boyunca ve ilgili mevzuatta öngörülen
                saklama süreleri kapsamında muhafaza edilir. Saklama süresinin sona ermesi veya işleme amacının
                ortadan kalkması halinde kişisel veriler silinir, yok edilir veya anonim hale getirilebilir.
            </p>

            <h2>11. Veri Güvenliği İçin Alınan Önlemler</h2>
            <p>
                Eymen Optik, kişisel verilerin güvenliğini sağlamak için gerekli teknik ve idari önlemleri almaya
                özen gösterir. Web sitemizde güvenli bağlantı altyapısı kullanılmakta olup kullanıcı bilgilerinin
                güvenli şekilde iletilmesi amaçlanmaktadır.
            </p>

            <ul>
                <li>SSL güvenlik altyapısı kullanılır.</li>
                <li>Ödeme bilgileri doğrudan Eymen Optik tarafından saklanmaz.</li>
                <li>Kişisel verilere erişim yetkili kişilerle sınırlandırılır.</li>
                <li>Gerekli durumlarda sistem güvenliği ve işlem kayıtları kontrol edilir.</li>
                <li>Yetkisiz erişim ve kötüye kullanım risklerine karşı önlem alınır.</li>
            </ul>

            <h2>12. Üçüncü Taraf Bağlantılar</h2>
            <p>
                Web sitemizde üçüncü taraf web sitelerine veya hizmet sağlayıcılarına yönlendiren bağlantılar
                bulunabilir. Bu bağlantılar üzerinden erişilen üçüncü taraf sitelerin gizlilik uygulamalarından
                Eymen Optik sorumlu değildir. Kullanıcıların, ziyaret ettikleri üçüncü taraf sitelerin gizlilik
                politikalarını ayrıca incelemesi önerilir.
            </p>

            <h2>13. Kullanıcı Hakları</h2>
            <p>
                Kullanıcılar, kişisel verileriyle ilgili olarak yürürlükteki mevzuat kapsamında aşağıdaki haklara
                sahip olabilir:
            </p>

            <ul>
                <li>Kişisel verilerinin işlenip işlenmediğini öğrenme,</li>
                <li>Kişisel verileri işlenmişse buna ilişkin bilgi talep etme,</li>
                <li>İşleme amacını ve verilerin amacına uygun kullanılıp kullanılmadığını öğrenme,</li>
                <li>Eksik veya yanlış işlenen verilerin düzeltilmesini isteme,</li>
                <li>Mevzuata uygun şartlarda kişisel verilerin silinmesini veya yok edilmesini isteme,</li>
                <li>Kişisel verilerin aktarıldığı üçüncü kişileri öğrenme,</li>
                <li>İşlenen verilerin yalnızca otomatik sistemlerle analiz edilmesi sonucu kişinin aleyhine bir sonucun ortaya çıkmasına itiraz etme,</li>
                <li>Kanuna aykırı işleme nedeniyle zarara uğranması halinde zararın giderilmesini talep etme.</li>
            </ul>

            <h2>14. Başvuru ve İletişim</h2>
            <p>
                Kişisel verileriniz, gizlilik süreçleri, üyelik hesabınız, sipariş bilgileriniz veya veri işleme
                faaliyetleriyle ilgili talepleriniz için Eymen Optik ile iletişime geçebilirsiniz.
            </p>

            <ul>
                <li><strong>E-posta:</strong> info@eymenoptiklens.com</li>
                <li><strong>Web Sitesi:</strong> eymenoptiklens.com</li>
                <li><strong>Adres ve Telefon:</strong> Web sitemizin iletişim sayfasında belirtilen güncel firma bilgileri geçerlidir.</li>
            </ul>

            <p>
                Başvurularınız, talebin niteliğine göre mümkün olan en kısa sürede değerlendirilir.
            </p>

            <h2>15. Gizlilik Sözleşmesinde Değişiklik</h2>
            <p>
                Eymen Optik, bu Gizlilik Sözleşmesi’ni yasal düzenlemeler, hizmet süreçleri, ödeme altyapısı,
                güvenlik uygulamaları veya web sitesi özelliklerinde meydana gelebilecek değişiklikler doğrultusunda
                güncelleme hakkını saklı tutar.
            </p>

            <p>
                Güncel Gizlilik Sözleşmesi web sitemizde yayımlandığı tarihten itibaren geçerli olur.
                Kullanıcıların bu sayfayı düzenli olarak kontrol etmesi önerilir.
            </p>

        </div>
    </div>
</section>

@endsection
```
