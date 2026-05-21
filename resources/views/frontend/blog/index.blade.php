@extends('frontend.layout')

@section('title','Sıkça Sorulan Sorular')

@section('content')

<section class="faq-page">
    <div class="container">

        <div class="faq-header">
            <span>YARDIM MERKEZİ</span>
            <h1>Sıkça Sorulan Sorular</h1>
            <p>
                Sipariş, garanti, iade, kargo ve teslimat süreçleri hakkında
                en çok merak edilen soruların cevaplarını burada bulabilirsiniz.
            </p>
        </div>

        <div class="faq-wrapper">

            {{-- GARANTİ VE İADE --}}
            <div class="faq-category">

                <div class="faq-category-title">
                    <h2>Garanti ve İade</h2>
                </div>

                <div class="faq-list">

                    <div class="faq-item active">
                        <button class="faq-question">
                            Ürünleriniz garantili mi?
                            <span>+</span>
                        </button>

                        <div class="faq-answer">
                            <p>
                                Satışa sunduğumuz tüm gözlük ve optik ürünler
                                üretici veya distribütör garantisi altındadır.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            İade süresi kaç gündür?
                            <span>+</span>
                        </button>

                        <div class="faq-answer">
                            <p>
                                Kullanılmamış ürünlerinizi teslim tarihinden
                                itibaren 14 gün içerisinde iade edebilirsiniz.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            İade işlemi nasıl yapılır?
                            <span>+</span>
                        </button>

                        <div class="faq-answer">
                            <p>
                                Hesabım bölümündeki siparişler alanından iade
                                talebi oluşturabilir veya bizimle iletişime
                                geçebilirsiniz.
                            </p>
                        </div>
                    </div>

                </div>

            </div>

            {{-- KARGO VE TESLİMAT --}}
            <div class="faq-category">

                <div class="faq-category-title">
                    <h2>Kargo ve Teslimat</h2>
                </div>

                <div class="faq-list">

                    <div class="faq-item">
                        <button class="faq-question">
                            Kargo süresi ne kadar?
                            <span>+</span>
                        </button>

                        <div class="faq-answer">
                            <p>
                                Siparişleriniz genellikle 1-3 iş günü içerisinde
                                kargoya verilmektedir.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            Kargo ücretsiz mi?
                            <span>+</span>
                        </button>

                        <div class="faq-answer">
                            <p>
                                3000 TL ve üzeri alışverişlerde ücretsiz kargo
                                avantajı sunulmaktadır.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            Siparişimi nasıl takip edebilirim?
                            <span>+</span>
                        </button>

                        <div class="faq-answer">
                            <p>
                                Siparişiniz kargoya verildiğinde tarafınıza
                                takip numarası SMS ve e-posta ile iletilir.
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

<style>

.faq-page{
    padding:70px 0;
    background:#f7f7f7;
}

.faq-header{
    margin-bottom:50px;
}

.faq-header span{
    display:inline-block;
    background:#000;
    color:#fff;
    padding:8px 14px;
    font-size:12px;
    font-weight:900;
    margin-bottom:20px;
    letter-spacing:1px;
}

.faq-header h1{
    font-size:62px;
    line-height:1;
    letter-spacing:-3px;
    margin-bottom:18px;
}

.faq-header p{
    max-width:700px;
    color:#666;
    line-height:1.8;
    font-size:16px;
}

.faq-wrapper{
    display:flex;
    flex-direction:column;
    gap:40px;
}

.faq-category{
    background:#fff;
    padding:35px;
    box-shadow:0 20px 60px rgba(0,0,0,.05);
}

.faq-category-title{
    margin-bottom:25px;
}

.faq-category-title h2{
    font-size:34px;
    letter-spacing:-1px;
}

.faq-list{
    display:flex;
    flex-direction:column;
    gap:16px;
}

.faq-item{
    border:1px solid #ececec;
    overflow:hidden;
    background:#fff;
    transition:.3s ease;
}

.faq-item.active{
    border-color:#000;
}

.faq-question{
    width:100%;
    border:none;
    background:#fff;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:22px 24px;
    cursor:pointer;
    font-size:18px;
    font-weight:700;
    text-align:left;
}

.faq-question span{
    font-size:24px;
    font-weight:300;
}

.faq-answer{
    display:none;
    padding:0 24px 24px;
}

.faq-item.active .faq-answer{
    display:block;
}

.faq-answer p{
    color:#666;
    line-height:1.8;
    font-size:15px;
}

@media(max-width:768px){

    .faq-page{
        padding:50px 0;
    }

    .faq-header h1{
        font-size:42px;
        letter-spacing:-2px;
    }

    .faq-category{
        padding:22px;
    }

    .faq-category-title h2{
        font-size:26px;
    }

    .faq-question{
        font-size:16px;
        padding:18px;
    }

    .faq-answer{
        padding:0 18px 18px;
    }

}

</style>

<script>

document.querySelectorAll('.faq-question').forEach(button => {

    button.addEventListener('click', () => {

        const item = button.parentElement;

        document.querySelectorAll('.faq-item').forEach(faq => {

            if(faq !== item){
                faq.classList.remove('active');
            }

        });

        item.classList.toggle('active');

    });

});

</script>

@endsection