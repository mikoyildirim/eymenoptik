@extends('frontend.layout')

@section('title', 'Güvenli Ödeme | Eymen Optik')

@section('content')

<section class="payment-page">
    <div class="container">

        <div class="payment-card">
            <span>İYZİCO GÜVENLİ ÖDEME</span>

            <h1>Ödeme Bilgileri</h1>

            <p>
                Kart bilgilerinizi güvenli ödeme formu üzerinden girerek siparişinizi tamamlayabilirsiniz.
            </p>

            <div class="iyzico-box">
                {!! $checkoutFormContent !!}
            </div>

            <!-- User will close the Iyzico iframe using its own X; we listen for postMessage events -->
        </div>

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const resizeIframe = () => {
            const iframe = document.querySelector('.iyzico-box iframe');
            const iyzico_box = document.querySelector('.iyzico-box');

            if (iframe && iyzico_box) {
                // Konteyner genişliğini al
                const containerWidth = iyzico_box.offsetWidth;

                // iframe'ın width'ini ve diğer özelliklerini konteyner genişliğine ayarla
                // setAttribute ile inline style'ı tamamen override ederiz
                iframe.setAttribute('style',
                    `width: ${containerWidth}px !important; max-width: 100% !important; min-height: 600px !important; display: block !important;`
                );
            }
        };

        // Başlangıçta - çeşitli zamanlarda boyutlandır (Iyzico'nun rendering'ine kadar bekle)
        setTimeout(resizeIframe, 50);
        setTimeout(resizeIframe, 200);
        setTimeout(resizeIframe, 500);
        setTimeout(resizeIframe, 1000);

        // Window resize olayında yeniden boyutlandır
        window.addEventListener('resize', resizeIframe);

        // Iyzico iframe load olduğunda boyutlandır
        window.addEventListener('load', resizeIframe);

        // Mutation Observer kullanarak iframe dinamik olarak eklendikten sonra da boyutlandır
        const observer = new MutationObserver(resizeIframe);
        observer.observe(document.querySelector('.iyzico-box') || document.body, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['style', 'width', 'height']
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const iyzicoBox = document.querySelector('.iyzico-box');
        if (!iyzicoBox) return;

        const cancelUrl = "{{ route('checkout.cancel') }}";
        const failedUrl = "{{ route('checkout.failed') }}";
        const csrf = (document.querySelector('meta[name="csrf-token"]') || {}).content || '{{ csrf_token() }}';
        const conversationId = '{{ $conversationId ?? Session::get("iyzico_order.conversation_id") }}';

        window.addEventListener('message', async function(event) {
            try {
                console.log('Iyzico postMessage received:', event.origin, event.data);

                let data = event.data;
                if (typeof data === 'string') {
                    try {
                        data = JSON.parse(data);
                    } catch (e) {
                        /* keep as string */
                    }
                }

                // Heuristics for detecting iframe close / cancel / failure
                let shouldCancel = false;
                if (data && typeof data === 'object') {
                    const evt = (data.event || data.action || '').toString().toLowerCase();
                    const status = (data.status || (data.payload && data.payload.status) || '')
                        .toString().toLowerCase();

                    if (evt.includes('close') || evt.includes('closed')) shouldCancel = true;
                    if (status && (status.includes('fail') || status.includes('cancel') || status
                            .includes('closed'))) shouldCancel = true;
                }

                if (!shouldCancel && typeof event.data === 'string') {
                    const s = event.data.toLowerCase();
                    if (s.includes('close') || s.includes('cancel') || s.includes('failed') || s
                        .includes('failure')) {
                        shouldCancel = true;
                    }
                }

                if (shouldCancel) {
                    try {
                        await fetch(cancelUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrf,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                cid: conversationId
                            })
                        });
                    } catch (e) {
                        console.log('Failed to call cancel endpoint', e);
                    }

                    window.location.href = failedUrl;
                }
            } catch (err) {
                console.log('Error processing Iyzico message', err);
            }
        }, false);
    });
</script>

<style>
    .payment-page {
        padding: 70px 0;
        background: #f6f6f6;
        min-height: 70vh;
    }

    .payment-card {
        background: #fff;
        border: 1px solid #eee;
        padding: 40px;
        max-width: 900px;
        margin: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .06);
    }

    .payment-card>span {
        display: inline-flex;
        background: #000;
        color: #fff;
        padding: 9px 14px;
        font-size: 12px;
        font-weight: 900;
        margin-bottom: 20px;
    }

    .payment-card h1 {
        font-size: 48px;
        margin-bottom: 12px;
        letter-spacing: -2px;
    }

    .payment-card p {
        color: #666;
        line-height: 1.8;
        margin-bottom: 30px;
    }

    .iyzico-box {
        min-height: 400px;
        width: 100%;
        overflow: visible !important;
    }

    /* Iyzico iframe responsive ayarlaması */
    .iyzico-box iframe {
        width: 100% !important;
        max-width: 100% !important;
        min-height: 600px !important;
        display: block !important;
    }

    .payment-actions .btn-cancel {
        background: #e74c3c;
        color: #fff;
        border: none;
        padding: 10px 16px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
    }

    .payment-actions .btn-cancel:hover {
        opacity: .95;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
        .payment-card {
            padding: 20px;
        }

        .payment-card h1 {
            font-size: 28px;
        }

        .iyzico-box iframe {
            min-height: 700px !important;
        }
    }
</style>

@endsection