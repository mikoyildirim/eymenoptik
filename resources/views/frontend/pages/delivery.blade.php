@extends('frontend.layout')

@section('title','Teslimat ve İade Şartları')

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

            <span>TESLİMAT VE İADE</span>

            <h1>Teslimat ve İade Şartları</h1>

            <p>
                Bu Teslimat ve İade Şartları, Eymen Optik web sitesi üzerinden verilen siparişlerin
                hazırlanması, kargoya teslim edilmesi, teslimat süreci, değişim, iade ve cayma hakkı
                işlemlerinin nasıl yürütüldüğünü açıklamak amacıyla hazırlanmıştır.
            </p>

            <p>
                Web sitemiz üzerinden sipariş veren kullanıcılar, sipariş işlemini tamamlamadan önce
                bu şartları okuduğunu ve kabul ettiğini beyan etmiş sayılır.
            </p>

            <div class="legal-info">
                <p>
                    <strong>Satıcı:</strong> Eymen Optik<br>
                    <strong>Web Sitesi:</strong> eymenoptiklens.com<br>
                    <strong>E-posta:</strong> info@eymenoptiklens.com<br>
                    <strong>Adres ve Telefon:</strong> Web sitemizin iletişim sayfasında belirtilen güncel firma bilgileri geçerlidir.
                </p>
            </div>

            <h2>1. Siparişin Alınması</h2>
            <p>
                Web sitemiz üzerinden verilen siparişler, ödeme onayının alınmasının ardından işleme alınır.
                Siparişin doğru şekilde hazırlanabilmesi ve teslim edilebilmesi için müşterinin ad, soyad,
                telefon, e-posta, fatura adresi ve teslimat adresi bilgilerini eksiksiz ve doğru girmesi gerekir.
            </p>

            <p>
                Eksik, hatalı veya ulaşılamayan adres ve iletişim bilgilerinden kaynaklanan teslimat
                gecikmelerinden müşteri sorumludur.
            </p>

            <h2>2. Sipariş Hazırlık Süreci</h2>
            <p>
                Sipariş edilen ürünler, stok durumu ve ürün türüne göre hazırlanır. Stokta bulunan ürünler
                mümkün olan en kısa sürede kargoya teslim edilir.
            </p>

            <p>
                Numaralı gözlük camı, reçeteye göre hazırlanan ürün, kişiye özel ölçülendirilen ürün,
                özel sipariş ürünleri veya müşterinin talebiyle hazırlanan ürünlerde hazırlık süresi
                ürünün niteliğine göre değişiklik gösterebilir.
            </p>

            <h2>3. Teslimat Süresi</h2>
            <p>
                Siparişler, ödeme onayından sonra genellikle 1 ila 5 iş günü içerisinde kargoya teslim edilmeye
                çalışılır. Teslimat süresi; ürün stok durumu, tedarik süreci, teslimat adresi, resmi tatiller,
                kampanya dönemleri, yoğunluk, hava koşulları ve kargo firmasından kaynaklanan durumlara göre
                değişiklik gösterebilir.
            </p>

            <p>
                Kargoya teslim edilen siparişlerin dağıtım süreci, ilgili kargo firmasının operasyon şartlarına
                göre yürütülür. Kargo takip bilgileri mümkün olması halinde müşteri ile paylaşılır.
            </p>

            <h2>4. Teslimat Adresi</h2>
            <p>
                Ürünler, sipariş sırasında müşteri tarafından belirtilen teslimat adresine gönderilir.
                Teslimat adresinin yanlış, eksik veya ulaşılamaz olması halinde sipariş teslim edilemeyebilir.
                Bu durumda oluşabilecek ek kargo süreçleri müşteri ile paylaşılır.
            </p>

            <h2>5. Kargo Ücreti</h2>
            <p>
                Kargo ücreti, sipariş tutarına, kampanya koşullarına veya web sitesinde belirtilen güncel
                kargo politikasına göre değişiklik gösterebilir.
            </p>

            <p>
                Web sitemizde belirtilen ücretsiz kargo kampanyaları, yalnızca kampanya şartlarının sağlanması
                halinde geçerlidir.
            </p>

            <h2>6. Teslimat Sırasında Ürün Kontrolü</h2>
            <p>
                Müşteri, ürünü teslim alırken kargo paketini kontrol etmelidir. Pakette ezilme, yırtılma,
                açılma, ıslanma, kırılma veya hasar bulunması halinde ürün teslim alınmadan kargo görevlisine
                hasar tespit tutanağı düzenletilmelidir.
            </p>

            <p>
                Hasarlı olduğu halde teslim alınan ürünlerde, teslimattan sonra en kısa sürede Eymen Optik ile
                iletişime geçilmelidir. Hasar tespit tutanağı olmayan gönderilerde kargo kaynaklı hasarların
                değerlendirilmesi mümkün olmayabilir.
            </p>

            <h2>7. Cayma Hakkı</h2>
            <p>
                Müşteri, mesafeli satış kapsamında satın aldığı ürünlerde, ilgili mevzuat gereğince ürünü
                teslim aldığı tarihten itibaren 14 gün içerisinde herhangi bir gerekçe göstermeksizin cayma
                hakkını kullanabilir.
            </p>

            <p>
                Cayma hakkının kullanılabilmesi için müşteri, 14 günlük süre içerisinde Eymen Optik ile
                e-posta, telefon veya iletişim sayfasında yer alan kanallar üzerinden iletişime geçmelidir.
            </p>

            <h2>8. İade Şartları</h2>
            <p>
                İade edilecek ürünün kullanılmamış, hasar görmemiş, tekrar satılabilir özelliğini kaybetmemiş,
                orijinal ambalajı, kutusu, etiketi, faturası, aksesuarları ve varsa promosyon ürünleriyle
                birlikte gönderilmesi gerekmektedir.
            </p>

            <ul>
                <li>Ürün kullanılmamış ve zarar görmemiş olmalıdır.</li>
                <li>Ürün tekrar satılabilir durumda olmalıdır.</li>
                <li>Ürünün orijinal ambalajı, kutusu ve etiketi korunmuş olmalıdır.</li>
                <li>Fatura, garanti belgesi, aksesuar ve promosyon ürünleri eksiksiz gönderilmelidir.</li>
                <li>İade talebi yasal süre içerisinde iletilmelidir.</li>
            </ul>

            <h2>9. İade Edilemeyecek Ürünler</h2>
            <p>
                Ürünlerin niteliği gereği bazı ürünlerde iade ve cayma hakkı kullanılamayabilir.
                Aşağıdaki ürünlerde iade süreci ürünün durumuna ve yasal koşullara göre değerlendirilir:
            </p>

            <ul>
                <li>Müşterinin talebi doğrultusunda kişiye özel hazırlanan ürünler,</li>
                <li>Numaralı gözlük camı gibi reçeteye veya kişisel ihtiyaca göre hazırlanan ürünler,</li>
                <li>Özel ölçü, özel renk, özel model veya özel sipariş olarak hazırlanan ürünler,</li>
                <li>Hijyen ve sağlık açısından iadesi uygun olmayan, ambalajı açılmış ürünler,</li>
                <li>Kullanılmış, çizilmiş, kırılmış, zarar görmüş veya deforme olmuş ürünler,</li>
                <li>Orijinal kutusu, faturası, etiketi veya aksesuarları eksik ürünler,</li>
                <li>Tekrar satılabilir özelliğini kaybetmiş ürünler.</li>
            </ul>

            <h2>10. Gözlük, Cam ve Lens Ürünlerinde İade</h2>
            <p>
                Optik ürünlerde iade süreci ürünün niteliğine göre değerlendirilir. Hazır güneş gözlüğü,
                hazır çerçeve veya stok ürünlerde ürün kullanılmamış ve tekrar satılabilir durumda ise
                iade talebi değerlendirilebilir.
            </p>

            <p>
                Müşterinin reçetesine, numarasına, ölçüsüne veya özel talebine göre hazırlanan cam,
                lens, numaralı gözlük veya kişiye özel ürünlerde iade kabul edilmeyebilir.
            </p>

            <h2>11. Değişim Süreci</h2>
            <p>
                Değişim talepleri ürünün stok durumuna ve ürün niteliğine göre değerlendirilir.
                Değişim yapılacak ürünün kullanılmamış, hasarsız, orijinal ambalajında ve faturasıyla
                birlikte gönderilmesi gerekir.
            </p>

            <p>
                Kişiye özel hazırlanan ürünlerde değişim yapılamayabilir. Değişim talebi onaylandıktan sonra
                yeni ürünün gönderim süreci müşteri ile paylaşılır.
            </p>

            <h2>12. İade Talebi Nasıl Oluşturulur?</h2>
            <p>
                İade veya değişim talebi oluşturmak isteyen müşteriler, sipariş numarası ile birlikte Eymen Optik
                iletişim kanalları üzerinden bizimle iletişime geçmelidir.
            </p>

            <p>
                Talep incelendikten sonra ürünün hangi adrese ve hangi yöntemle gönderileceği müşteriye bildirilir.
                Onay alınmadan gönderilen iadelerde ürün kabul edilmeyebilir veya süreç uzayabilir.
            </p>

            <h2>13. İade Kargo Süreci</h2>
            <p>
                İade kargo süreci, ürünün iade nedenine, sipariş koşullarına, kampanya şartlarına ve yürürlükteki
                mevzuata göre değerlendirilir. Güncel iade kargo bilgileri, iade talebi sırasında müşteri ile
                paylaşılır.
            </p>

            <h2>14. İade Ödemesi</h2>
            <p>
                İade şartlarına uygun olarak gönderilen ürün tarafımıza ulaştıktan sonra gerekli kontroller yapılır.
                Ürün iade koşullarına uygunsa ödeme iade süreci başlatılır.
            </p>

            <p>
                İade ödemesi, müşterinin ödeme yaptığı yöntem üzerinden gerçekleştirilir. Banka, kart kuruluşu
                veya ödeme hizmeti sağlayıcısından kaynaklanan işlem süreleri nedeniyle iade tutarının müşterinin
                hesabına yansıması birkaç iş günü sürebilir.
            </p>

            <h2>15. Eksik veya Yanlış Ürün Gönderimi</h2>
            <p>
                Siparişinizde eksik, yanlış veya hatalı ürün gönderildiğini düşünüyorsanız, ürünü kullanmadan
                ve ambalajını bozmadan en kısa sürede bizimle iletişime geçmelisiniz.
            </p>

            <p>
                Gerekli inceleme yapıldıktan sonra değişim, yeniden gönderim veya iade süreci başlatılabilir.
            </p>

            <h2>16. Kargo Kaynaklı Gecikmeler</h2>
            <p>
                Kargo firmasından kaynaklanan teslimat gecikmeleri, adres dağıtım dışı bölge durumu, resmi tatil,
                yoğunluk veya mücbir sebepler nedeniyle teslimat süresi uzayabilir.
            </p>

            <p>
                Bu gibi durumlarda müşteri, Eymen Optik ile iletişime geçerek sipariş durumu hakkında destek
                alabilir.
            </p>

            <h2>17. Mücbir Sebepler</h2>
            <p>
                Doğal afet, yangın, savaş, salgın hastalık, grev, altyapı arızaları, resmi makam kararları,
                kargo hizmetlerinde aksama ve satıcının kontrolü dışında gelişen benzeri durumlar mücbir sebep
                olarak kabul edilir.
            </p>

            <p>
                Mücbir sebepler nedeniyle teslimat veya iade süreçlerinde gecikmeler yaşanabilir.
            </p>

            <h2>18. İletişim</h2>
            <p>
                Teslimat, iade, değişim ve cayma hakkı süreçleriyle ilgili tüm sorularınız için Eymen Optik ile
                iletişime geçebilirsiniz.
            </p>

            <ul>
                <li><strong>E-posta:</strong> info@eymenoptiklens.com</li>
                <li><strong>Web Sitesi:</strong> eymenoptiklens.com</li>
                <li><strong>Adres ve Telefon:</strong> Web sitemizin iletişim sayfasında belirtilen güncel bilgiler geçerlidir.</li>
            </ul>

            <p>
                Eymen Optik, teslimat ve iade şartlarında yasal düzenlemeler, operasyonel süreçler veya hizmet
                koşullarındaki değişikliklere bağlı olarak güncelleme yapma hakkını saklı tutar. Güncel metin
                web sitesinde yayımlandığı tarihten itibaren geçerlidir.
            </p>

        </div>
    </div>
</section>

@endsection