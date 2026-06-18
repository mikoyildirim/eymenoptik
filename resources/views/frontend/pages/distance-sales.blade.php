@extends('frontend.layout')

@section('title','Mesafeli Satış Sözleşmesi')

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

            <span>MESAFELİ SATIŞ</span>

            <h1>Mesafeli Satış Sözleşmesi</h1>

            <p>
                İşbu Mesafeli Satış Sözleşmesi, aşağıda bilgileri yer alan satıcı ile Eymen Optik web sitesi
                üzerinden elektronik ortamda ürün siparişi veren alıcı arasında kurulmuştur. Alıcı, siparişini
                tamamlamadan önce işbu sözleşmeyi, teslimat ve iade şartlarını ve gizlilik politikasını okuyup
                kabul ettiğini beyan eder.
            </p>

            <div class="legal-info">
                <p>
                    <strong>Satıcı:</strong> Eymen Optik<br>
                    <strong>Web Sitesi:</strong> eymenoptiklens.com<br>
                    <strong>E-posta:</strong> info@eymenoptiklens.com<br>
                    <strong>Adres ve Telefon:</strong> Web sitemizin iletişim sayfasında belirtilen güncel firma bilgileri geçerlidir.
                </p>
            </div>

            <h2>1. Taraflar</h2>

            <h3>1.1. Satıcı Bilgileri</h3>
            <ul>
                <li><strong>Satıcı:</strong> Eymen Optik</li>
                <li><strong>Web Sitesi:</strong> eymenoptiklens.com</li>
                <li><strong>E-posta:</strong> info@eymenoptiklens.com</li>
                <li><strong>Adres:</strong> Web sitemizin iletişim sayfasında belirtilen güncel firma adresi geçerlidir.</li>
                <li><strong>Telefon:</strong> Web sitemizin iletişim sayfasında belirtilen güncel telefon numarası geçerlidir.</li>
            </ul>

            <h3>1.2. Alıcı Bilgileri</h3>
            <p>
                Alıcı; Eymen Optik web sitesi üzerinden ürün siparişi veren, sipariş sırasında ad, soyad,
                telefon, e-posta, fatura adresi ve teslimat adresi bilgilerini sisteme giren gerçek veya tüzel
                kişidir. Alıcıya ait bilgiler, sipariş formunda ve sipariş özetinde yer alan bilgilerdir.
            </p>

            <h2>2. Sözleşmenin Konusu</h2>
            <p>
                İşbu sözleşmenin konusu, alıcının Eymen Optik web sitesi üzerinden elektronik ortamda siparişini
                verdiği ürün veya ürünlerin satışı, teslimi, ödeme koşulları, cayma hakkı, iade süreci ve tarafların
                hak ve yükümlülüklerinin belirlenmesidir.
            </p>

            <h2>3. Ürün Bilgileri</h2>
            <p>
                Satın alınan ürünün türü, marka/modeli, adedi, satış fiyatı, ödeme şekli, teslimat adresi,
                fatura bilgileri ve kargo bilgileri sipariş onay ekranında ve sipariş özetinde yer almaktadır.
                Alıcı, siparişini onaylayarak ürün bilgilerini ve toplam bedeli kabul etmiş sayılır.
            </p>

            <h2>4. Ürün Bedeli ve Ödeme</h2>
            <p>
                Ürünlerin satış fiyatı, web sitesinde sipariş anında belirtilen fiyatlardır. Ürün fiyatlarına
                varsa KDV dahil edilir. Kargo ücreti, kampanya şartları, indirimler ve sipariş toplamı sipariş
                ekranında alıcıya gösterilir.
            </p>

            <p>
                Alıcı, siparişi onaylayarak ürün bedelini, varsa kargo bedelini ve sipariş ekranında görünen
                toplam tutarı ödemeyi kabul eder.
            </p>

            <h2>5. Ödeme Güvenliği</h2>
            <p>
                Ödeme işlemleri güvenli ödeme altyapıları üzerinden gerçekleştirilir. Kredi kartı veya banka kartı
                bilgileri Eymen Optik tarafından saklanmaz. Kart bilgileri, ödeme hizmeti sağlayıcısının güvenli
                ödeme sistemleri üzerinden işlenir.
            </p>

            <h2>6. Siparişin Onaylanması</h2>
            <p>
                Alıcı, siparişini tamamlamadan önce ürün bilgilerini, ürün bedelini, teslimat adresini, fatura
                bilgilerini, kargo ücretini ve toplam sipariş tutarını kontrol etmekle yükümlüdür.
            </p>

            <p>
                Siparişin elektronik ortamda onaylanmasıyla birlikte alıcı, işbu Mesafeli Satış Sözleşmesi’ni
                ve web sitesinde yer alan ön bilgilendirme niteliğindeki açıklamaları kabul etmiş sayılır.
            </p>

            <h2>7. Teslimat</h2>
            <p>
                Ürün, alıcının sipariş sırasında belirtmiş olduğu teslimat adresine gönderilir. Teslimat süresi,
                ürünün stok durumu, hazırlanma süreci, tedarik durumu, kargo firmasının operasyon süreci,
                resmi tatiller, kampanya yoğunluğu ve mücbir sebeplere göre değişiklik gösterebilir.
            </p>

            <p>
                Teslimat süreci ve kargo işlemleri, web sitemizde yer alan Teslimat ve İade Şartları sayfası
                kapsamında yürütülür.
            </p>

            <h2>8. Teslimat Sırasında Kontrol</h2>
            <p>
                Alıcı, ürünü teslim alırken kargo paketini kontrol etmelidir. Pakette ezilme, açılma, yırtılma,
                ıslanma, kırılma veya hasar bulunması halinde ürün teslim alınmadan kargo görevlisine hasar
                tespit tutanağı düzenletilmelidir.
            </p>

            <p>
                Hasarlı ürün teslim alınmışsa, alıcı en kısa sürede Eymen Optik ile iletişime geçmelidir.
                Hasar tespit tutanağı bulunmayan gönderilerde kargo kaynaklı hasarların değerlendirilmesi
                mümkün olmayabilir.
            </p>

            <h2>9. Alıcının Yükümlülükleri</h2>
            <p>
                Alıcı, sipariş verirken doğru, güncel ve eksiksiz bilgi vermekle yükümlüdür. Yanlış veya eksik
                bilgiler nedeniyle siparişin teslim edilememesi, gecikmesi veya ek masraf oluşması halinde
                sorumluluk alıcıya aittir.
            </p>

            <p>
                Alıcı, satın aldığı ürünü teslim aldıktan sonra ürünün kullanım talimatlarına, ürün açıklamalarına
                ve garanti koşullarına uygun şekilde kullanmakla yükümlüdür.
            </p>

            <h2>10. Satıcının Yükümlülükleri</h2>
            <p>
                Satıcı, sipariş konusu ürünü sipariş bilgilerine uygun şekilde hazırlamak ve teslimat sürecini
                başlatmakla yükümlüdür. Ürünün stokta bulunmaması, tedarik edilememesi veya siparişin yerine
                getirilememesi halinde alıcıya bilgi verilir.
            </p>

            <p>
                Siparişin herhangi bir nedenle karşılanamaması halinde, alıcıya bilgi verilerek varsa ödeme iade
                süreci başlatılır.
            </p>

            <h2>11. Cayma Hakkı</h2>
            <p>
                Alıcı, mesafeli satış kapsamında satın aldığı ürünlerde, ilgili mevzuat gereğince ürünü teslim
                aldığı tarihten itibaren 14 gün içerisinde herhangi bir gerekçe göstermeksizin ve cezai şart
                ödemeksizin cayma hakkını kullanabilir.
            </p>

            <p>
                Cayma hakkının kullanılabilmesi için alıcı, 14 günlük süre içerisinde Eymen Optik’e yazılı olarak
                veya kalıcı veri saklayıcısı ile bildirimde bulunmalıdır.
            </p>

            <h2>12. Cayma Hakkının Kullanılması</h2>
            <p>
                Cayma hakkını kullanmak isteyen alıcı, sipariş numarası ve iade talebi ile birlikte Eymen Optik
                iletişim kanalları üzerinden satıcıya başvurmalıdır. Satıcı, talebi aldıktan sonra alıcıya ürünün
                hangi adrese ve hangi yöntemle gönderileceği hakkında bilgi verir.
            </p>

            <ul>
                <li><strong>E-posta:</strong> info@eymenoptiklens.com</li>
                <li><strong>Web Sitesi:</strong> eymenoptiklens.com</li>
                <li><strong>Adres ve Telefon:</strong> Web sitemizin iletişim sayfasında belirtilen güncel bilgiler geçerlidir.</li>
            </ul>

            <h2>13. Cayma Hakkının Geçerli Olmadığı Ürünler</h2>
            <p>
                Ürünlerin niteliği gereği bazı ürünlerde cayma hakkı kullanılamayabilir. Aşağıdaki ürünler,
                ürünün durumu ve yasal koşullar çerçevesinde değerlendirilir:
            </p>

            <ul>
                <li>Alıcının istekleri veya kişisel ihtiyaçları doğrultusunda özel olarak hazırlanan ürünler,</li>
                <li>Numaralı gözlük camı gibi reçeteye veya kişisel ihtiyaca göre hazırlanan ürünler,</li>
                <li>Özel ölçü, özel renk, özel model veya özel sipariş olarak hazırlanan ürünler,</li>
                <li>Hijyen ve sağlık açısından iadesi uygun olmayan, ambalajı açılmış ürünler,</li>
                <li>Kullanılmış, çizilmiş, kırılmış, hasar görmüş veya tekrar satılabilir özelliğini kaybetmiş ürünler,</li>
                <li>Orijinal ambalajı, kutusu, etiketi, faturası veya aksesuarları eksik gönderilen ürünler.</li>
            </ul>

            <h2>14. Optik Ürünlerde Özel Durumlar</h2>
            <p>
                Hazır güneş gözlüğü, hazır optik çerçeve veya stok ürünlerde ürün kullanılmamış, hasar görmemiş
                ve tekrar satılabilir durumda ise iade talebi değerlendirilebilir.
            </p>

            <p>
                Alıcının reçetesine, numarasına, ölçüsüne veya özel talebine göre hazırlanan cam, lens,
                numaralı gözlük veya kişiye özel optik ürünlerde iade ve cayma hakkı sınırlı olabilir.
                Bu ürünler kişiye özel hazırlandığı için genel iade koşullarından farklı değerlendirilebilir.
            </p>

            <h2>15. İade Süreci</h2>
            <p>
                İade edilecek ürünün kullanılmamış, hasar görmemiş, tekrar satılabilir özelliğini kaybetmemiş,
                orijinal ambalajı, kutusu, etiketi, faturası, aksesuarları ve varsa promosyon ürünleriyle birlikte
                gönderilmesi gerekir.
            </p>

            <p>
                Ürün satıcıya ulaştıktan sonra gerekli kontroller yapılır. İade şartlarına uygun ürünlerde ödeme
                iade süreci başlatılır.
            </p>

            <h2>16. İade Ödemesi</h2>
            <p>
                İade ödemesi, alıcının ödeme yaptığı yöntem üzerinden gerçekleştirilir. Banka, kart kuruluşu veya
                ödeme hizmeti sağlayıcısından kaynaklanan işlem süreleri nedeniyle iade tutarının alıcının hesabına
                yansıması birkaç iş günü sürebilir.
            </p>

            <h2>17. Değişim İşlemleri</h2>
            <p>
                Değişim talepleri, ürünün stok durumuna ve ürün niteliğine göre değerlendirilir. Değişim yapılacak
                ürünün kullanılmamış, hasarsız, orijinal ambalajında ve faturasıyla birlikte gönderilmesi gerekir.
            </p>

            <p>
                Kişiye özel hazırlanan ürünlerde değişim yapılamayabilir. Değişim talebi onaylandıktan sonra yeni
                ürünün gönderim süreci müşteri ile paylaşılır.
            </p>

            <h2>18. Kargo ve Teslimat Sorumluluğu</h2>
            <p>
                Alıcı, teslimat sırasında kargo paketini kontrol etmekle yükümlüdür. Hasarlı, açılmış, yırtılmış
                veya zarar görmüş paketlerin teslim alınmaması ve kargo görevlisine tutanak düzenletilmesi gerekir.
            </p>

            <p>
                Yanlış veya eksik adres nedeniyle teslim edilemeyen siparişlerde oluşabilecek ek kargo süreçleri
                alıcı ile paylaşılır.
            </p>

            <h2>19. Mücbir Sebepler</h2>
            <p>
                Doğal afet, yangın, savaş, salgın hastalık, grev, altyapı arızaları, resmi makam kararları,
                kargo hizmetlerinde aksama ve satıcının kontrolü dışında gelişen benzeri durumlar mücbir sebep
                olarak kabul edilir.
            </p>

            <p>
                Mücbir sebepler nedeniyle sözleşme konusu ürünün teslim edilememesi veya geç teslim edilmesi
                halinde taraflar bu gecikmeden sorumlu tutulamaz.
            </p>

            <h2>20. Kişisel Verilerin Korunması</h2>
            <p>
                Alıcının sipariş sırasında paylaştığı kişisel veriler; sipariş, ödeme, fatura, teslimat,
                müşteri hizmetleri, iade ve yasal yükümlülüklerin yerine getirilmesi amacıyla işlenir.
            </p>

            <p>
                Kişisel verilerin işlenmesine ilişkin detaylar, web sitemizde yer alan Gizlilik Sözleşmesi
                veya Gizlilik Politikası sayfasında açıklanmıştır.
            </p>

            <h2>21. Uyuşmazlıkların Çözümü</h2>
            <p>
                İşbu sözleşmeden doğabilecek uyuşmazlıklarda, ilgili mevzuat kapsamında alıcının yerleşim yerindeki
                veya işlemin yapıldığı yerdeki Tüketici Hakem Heyetleri ve Tüketici Mahkemeleri yetkilidir.
            </p>

            <h2>22. Yürürlük</h2>
            <p>
                Alıcı, web sitesi üzerinden siparişini tamamlamadan önce işbu Mesafeli Satış Sözleşmesi’ni,
                Teslimat ve İade Şartları’nı ve Gizlilik Sözleşmesi’ni okuyup kabul ettiğini beyan eder.
            </p>

            <p>
                Siparişin tamamlanmasıyla birlikte işbu sözleşme elektronik ortamda yürürlüğe girer.
            </p>

        </div>
    </div>
</section>

@endsection