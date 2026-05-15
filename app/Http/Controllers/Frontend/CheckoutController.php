<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Iyzipay\Model\Address;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\BasketItemType;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\CheckoutForm;
use Iyzipay\Model\CheckoutFormInitialize;
use Iyzipay\Model\Currency;
use Iyzipay\Model\Locale;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Options;
use Iyzipay\Request\CreateCheckoutFormInitializeRequest;
use Iyzipay\Request\RetrieveCheckoutFormRequest;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.checkout.index');
    }

    public function payment(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'address' => 'required|string|max:1000',
            'cart_json' => 'required|string',
            'total_price' => 'required|numeric|min:1',
        ]);

        $cart = json_decode($request->cart_json, true);

        if (!is_array($cart) || count($cart) === 0) {
            return redirect()
                ->route('checkout.index')
                ->withErrors(['cart' => 'Sepetiniz boş.']);
        }

        $subtotal = collect($cart)->sum(function ($item) {
            return (float) $item['price'] * (int) ($item['qty'] ?? 1);
        });

        $shipping = $subtotal >= 1000 ? 0 : 99;
        $grandTotal = $subtotal + $shipping;

        $conversationId = 'EO-' . time() . '-' . Auth::id();

        Session::put('iyzico_order', [
            'conversation_id' => $conversationId,
            'cart' => $cart,
            'customer' => $request->only([
                'full_name',
                'phone',
                'email',
                'city',
                'district',
                'address',
            ]),
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'grand_total' => $grandTotal,
        ]);

        $iyzicoRequest = new CreateCheckoutFormInitializeRequest();
        $iyzicoRequest->setLocale(Locale::TR);
        $iyzicoRequest->setConversationId($conversationId);
        $iyzicoRequest->setPrice($this->priceFormat($subtotal));
        $iyzicoRequest->setPaidPrice($this->priceFormat($grandTotal));
        $iyzicoRequest->setCurrency(Currency::TL);
        $iyzicoRequest->setBasketId($conversationId);
        $iyzicoRequest->setPaymentGroup(PaymentGroup::PRODUCT);
        $iyzicoRequest->setCallbackUrl(route('checkout.callback'));
        $iyzicoRequest->setEnabledInstallments([1, 2, 3, 6, 9]);

        $buyer = new Buyer();
        $buyer->setId((string) Auth::id());
        $buyer->setName($this->firstName($request->full_name));
        $buyer->setSurname($this->lastName($request->full_name));
        $buyer->setGsmNumber($request->phone);
        $buyer->setEmail($request->email);
        $buyer->setIdentityNumber('11111111111');
        $buyer->setLastLoginDate(now()->format('Y-m-d H:i:s'));
        $buyer->setRegistrationDate(Auth::user()->created_at?->format('Y-m-d H:i:s') ?? now()->format('Y-m-d H:i:s'));
        $buyer->setRegistrationAddress($request->address);
        $buyer->setIp($request->ip());
        $buyer->setCity($request->city);
        $buyer->setCountry('Turkey');
        $buyer->setZipCode('58000');

        $iyzicoRequest->setBuyer($buyer);

        $shippingAddress = new Address();
        $shippingAddress->setContactName($request->full_name);
        $shippingAddress->setCity($request->city);
        $shippingAddress->setCountry('Turkey');
        $shippingAddress->setAddress($request->address);
        $shippingAddress->setZipCode('58000');

        $billingAddress = new Address();
        $billingAddress->setContactName($request->full_name);
        $billingAddress->setCity($request->city);
        $billingAddress->setCountry('Turkey');
        $billingAddress->setAddress($request->address);
        $billingAddress->setZipCode('58000');

        $iyzicoRequest->setShippingAddress($shippingAddress);
        $iyzicoRequest->setBillingAddress($billingAddress);

        $basketItems = [];

        foreach ($cart as $index => $item) {
            $basketItem = new BasketItem();
            $basketItem->setId((string) ($item['id'] ?? $index + 1));
            $basketItem->setName($item['name'] ?? 'Eymen Optik Ürün');
            $basketItem->setCategory1('Gözlük');
            $basketItem->setItemType(BasketItemType::PHYSICAL);
            $basketItem->setPrice(
                $this->priceFormat((float) $item['price'] * (int) ($item['qty'] ?? 1))
            );

            $basketItems[] = $basketItem;
        }

        if ($shipping > 0) {
            $shippingItem = new BasketItem();
            $shippingItem->setId('shipping');
            $shippingItem->setName('Kargo Bedeli');
            $shippingItem->setCategory1('Kargo');
            $shippingItem->setItemType(BasketItemType::PHYSICAL);
            $shippingItem->setPrice($this->priceFormat($shipping));

            $basketItems[] = $shippingItem;
        }

        $iyzicoRequest->setBasketItems($basketItems);

        $checkoutFormInitialize = CheckoutFormInitialize::create(
            $iyzicoRequest,
            $this->iyzicoOptions()
        );

        if ($checkoutFormInitialize->getStatus() !== 'success') {
           $errorMessage = $checkoutFormInitialize->getErrorMessage()
    ?: $checkoutFormInitialize->getErrorCode()
    ?: 'İyzico ödeme başlatılırken bilinmeyen bir hata oluştu.';

return redirect()
    ->route('checkout.failed')
    ->with('payment_error', $errorMessage);
        }

        Session::put('iyzico_token', $checkoutFormInitialize->getToken());

        return view('frontend.checkout.payment', [
            'checkoutFormContent' => $checkoutFormInitialize->getCheckoutFormContent(),
        ]);
    }

    public function callback(Request $request)
    {
        $token = $request->input('token');

        if (!$token) {
            return redirect()->route('checkout.failed');
        }

        $retrieveRequest = new RetrieveCheckoutFormRequest();
        $retrieveRequest->setLocale(Locale::TR);
        $retrieveRequest->setConversationId(Session::get('iyzico_order.conversation_id'));
        $retrieveRequest->setToken($token);

        $checkoutForm = CheckoutForm::retrieve(
            $retrieveRequest,
            $this->iyzicoOptions()
        );

        if (
            $checkoutForm->getStatus() === 'success'
            && $checkoutForm->getPaymentStatus() === 'SUCCESS'
        ) {
            Session::forget('iyzico_token');

            return redirect()->route('checkout.success');
        }

        return redirect()
            ->route('checkout.failed')
            ->with('error', $checkoutForm->getErrorMessage());
    }

    public function success()
    {
        return view('frontend.checkout.success');
    }

    public function failed()
    {
        return view('frontend.checkout.failed');
    }

    private function iyzicoOptions(): Options
    {
        $options = new Options();
        $options->setApiKey(config('iyzico.api_key'));
        $options->setSecretKey(config('iyzico.secret_key'));
        $options->setBaseUrl(config('iyzico.base_url'));

        return $options;
    }

    private function priceFormat(float $price): string
    {
        return number_format($price, 2, '.', '');
    }

    private function firstName(string $fullName): string
    {
        $parts = explode(' ', trim($fullName));

        return $parts[0] ?? 'Eymen';
    }

    private function lastName(string $fullName): string
    {
        $parts = explode(' ', trim($fullName));

        if (count($parts) <= 1) {
            return 'Optik';
        }

        array_shift($parts);

        return implode(' ', $parts);
    }
}