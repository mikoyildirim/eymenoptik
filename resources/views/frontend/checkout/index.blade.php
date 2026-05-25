@extends('frontend.layout')

@section('title', 'Ödeme | Eymen Optik')

@section('content')

<section class="checkout-page">

    <div class="container">

        <div class="checkout-header reveal">
            <span>GÜVENLİ ÖDEME</span>
            <h1>Ödeme ve Teslimat</h1>
            <p>Sepetindeki ürünleri kontrol et, teslimat bilgilerini gir ve siparişini tamamla.</p>
        </div>

        <form method="POST" action="{{ route('checkout.payment') }}" class="checkout-grid" id="checkoutForm">
            @csrf

            <script>
                window.checkoutShippingConfig = {
                    freeShippingThreshold: @json($freeShippingThreshold),
                    shippingCost: @json($shippingCost),
                };
            </script>

            <input type="hidden" name="cart_json" id="cartJson">
            <input type="hidden" name="total_price" id="totalPriceInput">

            <div class="checkout-left reveal">

                <div class="checkout-card">
                    <div class="card-title">
                        <h2>Teslimat Bilgileri</h2>
                        <p>Siparişin bu bilgilere göre oluşturulacak.</p>
                    </div>

                    <div class="form-group full">
    <label>Ad Soyad</label>
    <input 
        type="text"
        name="full_name"
        required
        placeholder="Adınız Soyadınız"
        value="{{ old('full_name', auth()->user()->name ?? '') }}"
    >
</div>

<div class="form-group">
    <label>Telefon</label>
    <input 
        type="text"
        name="phone"
        required
        placeholder="05xx xxx xx xx"
        value="{{ old('phone', auth()->user()->phone ?? '') }}"
    >
</div>

<div class="form-group">
    <label>E-posta</label>
    <input 
        type="email"
        name="email"
        required
        placeholder="ornek@mail.com"
        value="{{ old('email', auth()->user()->email ?? '') }}"
    >
</div>

<div class="form-group">
    <label>İl</label>
    <input 
        type="text"
        name="city"
        required
        placeholder="Sivas"
        value="{{ old('city', auth()->user()->city ?? '') }}"
    >
</div>

<div class="form-group">
    <label>İlçe</label>
    <input 
        type="text"
        name="district"
        required
        placeholder="Merkez"
        value="{{ old('district', auth()->user()->district ?? '') }}"
    >
</div>

<div class="form-group full">
    <label>Açık Adres</label>

    <textarea
        name="address"
        required
        rows="5"
        placeholder="Mahalle, cadde, sokak, bina no, daire no..."
    >{{ old('address', auth()->user()->address ?? '') }}</textarea>
</div>
                </div>

                <div class="checkout-card">
                    <div class="card-title">
                        <h2>Ödeme Yöntemi</h2>
                    </div>

                    <label class="payment-option active">
                        <input type="radio" name="payment_method" value="iyzico" checked>
                        <span>
                            <b>Kredi / Banka Kartı</b>
                            <small>Güvenli ödeme altyapısı ile ödeme yap.</small>
                        </span>
                    </label>

                    <!-- <label class="payment-option">
                        <input type="radio" name="payment_method" value="transfer">
                        <span>
                            <b>Havale / EFT</b>
                            <small>Manuel ödeme bildirimi için kullanılabilir.</small>
                        </span>
                    </label> -->
                </div>

            </div>

            <aside class="checkout-right reveal">

                <div class="summary-card">
                    <h2>Sipariş Özeti</h2>

                    <div id="checkoutItems" class="checkout-items"></div>

                    <div class="summary-lines">
                        <div>
                            <span>Ara Toplam</span>
                            <b id="subTotal">₺0</b>
                        </div>

                        <div>
                            <span>Kargo</span>
                            <b id="shippingPrice">₺0</b>
                        </div>

                        <div class="total">
                            <span>Genel Toplam</span>
                            <b id="grandTotal">₺0</b>
                        </div>
                    </div>

                    <button type="submit" class="pay-btn">
                        Ödemeye Devam Et
                    </button>

                    <a href="{{ route('products.index') }}" class="back-shop">
                        Alışverişe Devam Et
                    </a>
                </div>

            </aside>

        </form>

    </div>

</section>

@endsection

@section('page_css')

<style>
    .checkout-page {
        background:#f6f6f6;
        padding:60px 0 80px;
    }

    .checkout-header {
        margin-bottom:34px;
    }

    .checkout-header span {
        display:inline-flex;
        background:#000;
        color:#fff;
        padding:9px 15px;
        font-size:12px;
        font-weight:900;
        margin-bottom:18px;
    }

    .checkout-header h1 {
        font-size:58px;
        line-height:1;
        letter-spacing:-3px;
        margin-bottom:12px;
    }

    .checkout-header p {
        color:#666;
        max-width:650px;
        line-height:1.8;
    }

    .checkout-grid {
        display:grid;
        grid-template-columns:1fr 420px;
        gap:28px;
        align-items:start;
    }

    .checkout-card,
    .summary-card {
        background:#fff;
        border:1px solid #eee;
        padding:30px;
        box-shadow:0 18px 50px rgba(0,0,0,.04);
        margin-bottom:22px;
    }

    .card-title {
        margin-bottom:24px;
    }

    .card-title h2,
    .summary-card h2 {
        font-size:26px;
        margin-bottom:7px;
    }

    .card-title p {
        color:#777;
        font-size:14px;
    }

    .form-grid {
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:18px;
    }

    .form-group.full {
        grid-column:1 / -1;
    }

    .form-group label {
        display:block;
        font-size:13px;
        font-weight:900;
        margin-bottom:8px;
    }

    .form-group input,
    .form-group textarea {
        width:100%;
        border:1px solid #e5e5e5;
        background:#fafafa;
        padding:15px;
        outline:none;
        font-size:14px;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color:#000;
        background:#fff;
    }

    .payment-option {
        display:flex;
        gap:12px;
        align-items:flex-start;
        border:1px solid #eee;
        padding:18px;
        cursor:pointer;
        margin-bottom:12px;
        transition:.25s ease;
    }

    .payment-option.active,
    .payment-option:hover {
        border-color:#000;
        background:#fafafa;
    }

    .payment-option b {
        display:block;
        margin-bottom:5px;
    }

    .payment-option small {
        color:#777;
    }

    .summary-card {
        position:sticky;
        top:120px;
    }

    .checkout-items {
        display:grid;
        gap:14px;
        margin:24px 0;
        max-height:360px;
        overflow:auto;
    }

    .checkout-item {
        display:grid;
        grid-template-columns:70px 1fr auto;
        gap:12px;
        align-items:center;
        padding-bottom:14px;
        border-bottom:1px solid #eee;
    }

    .checkout-item img {
        height:70px;
        object-fit:contain;
        background:#f6f6f6;
    }

    .checkout-item h4 {
        font-size:14px;
        margin-bottom:4px;
    }

    .checkout-item span {
        color:#777;
        font-size:13px;
        font-weight:700;
    }

    .checkout-item b {
        font-size:14px;
    }

    .summary-lines {
        display:grid;
        gap:14px;
        padding-top:20px;
        border-top:1px solid #eee;
    }

    .summary-lines div {
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .summary-lines span {
        color:#777;
        font-weight:700;
    }

    .summary-lines b {
        color:#000;
        font-size:18px;
    }

    .summary-lines .total {
        padding-top:16px;
        border-top:1px solid #eee;
    }

    .summary-lines .total b {
        font-size:26px;
    }

    .pay-btn {
        width:100%;
        height:56px;
        border:0;
        background:#000;
        color:#fff;
        font-weight:900;
        margin-top:24px;
        cursor:pointer;
        transition:.25s ease;
    }

    .pay-btn:hover {
        background:#c79a3a;
    }

    .back-shop {
        display:flex;
        justify-content:center;
        margin-top:16px;
        font-weight:800;
        color:#000;
    }

    .empty-checkout {
        background:#fff;
        padding:30px;
        text-align:center;
        color:#777;
        border:1px dashed #ddd;
    }

    @media(max-width:992px) {
        .checkout-grid {
            grid-template-columns:1fr;
        }

        .summary-card {
            position:relative;
            top:0;
        }
    }

    @media(max-width:680px) {
        .checkout-header h1 {
            font-size:40px;
        }

        .form-grid {
            grid-template-columns:1fr;
        }

        .checkout-card,
        .summary-card {
            padding:22px;
        }
    }
</style>

@endsection

@section('page_js')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cart = JSON.parse(localStorage.getItem('eymen_cart')) || [];

        const checkoutItems = document.getElementById('checkoutItems');
        const subTotal = document.getElementById('subTotal');
        const shippingPrice = document.getElementById('shippingPrice');
        const grandTotal = document.getElementById('grandTotal');
        const cartJson = document.getElementById('cartJson');
        const totalPriceInput = document.getElementById('totalPriceInput');
        const checkoutForm = document.getElementById('checkoutForm');

        function formatPrice(price) {
            return '₺' + Number(price).toLocaleString('tr-TR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
        }

        function renderCheckout() {
            if (!checkoutItems) return;

            if (cart.length === 0) {
                checkoutItems.innerHTML = `
                    <div class="empty-checkout">
                        Sepetiniz boş. Önce ürün eklemelisiniz.
                    </div>
                `;

                subTotal.textContent = '₺0';
                shippingPrice.textContent = '₺0';
                grandTotal.textContent = '₺0';

                return;
            }

            checkoutItems.innerHTML = cart.map(item => `
                <div class="checkout-item">
                    <img src="${item.img}" alt="${item.name}">

                    <div>
                        <h4>${item.name}</h4>
                        <span>${item.qty || 1} adet</span>
                    </div>

                    <b>${formatPrice(Number(item.price) * Number(item.qty || 1))}</b>
                </div>
            `).join('');

            const subtotalValue = cart.reduce((sum, item) => {
                return sum + Number(item.price) * Number(item.qty || 1);
            }, 0);

            const shippingValue = subtotalValue >= window.checkoutShippingConfig.freeShippingThreshold
                ? 0
                : window.checkoutShippingConfig.shippingCost;
            const grandTotalValue = subtotalValue + shippingValue;

            subTotal.textContent = formatPrice(subtotalValue);
            shippingPrice.textContent = shippingValue === 0 ? 'Ücretsiz' : formatPrice(shippingValue);
            grandTotal.textContent = formatPrice(grandTotalValue);

            cartJson.value = JSON.stringify(cart);
            totalPriceInput.value = grandTotalValue;
        }

        checkoutForm?.addEventListener('submit', function (e) {
            if (cart.length === 0) {
                e.preventDefault();
                alert('Sepetiniz boş. Sipariş oluşturmak için önce ürün ekleyin.');
                return;
            }

            cartJson.value = JSON.stringify(cart);
        });

        renderCheckout();
    });
</script>

@endsection