<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        return view('frontend.checkout.index', $this->shippingConfiguration());
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

        $subtotal = round(collect($cart)->sum(function ($item) {
            return (float) $item['price'] * (int) ($item['qty'] ?? 1);
        }), 2);

        $shippingSettings = $this->shippingConfiguration();
        $shipping = round(
            $subtotal >= $shippingSettings['freeShippingThreshold']
                ? 0
                : $shippingSettings['shippingCost'],
            2
        );
        $grandTotal = round($subtotal + $shipping, 2);

        $uid = Auth::id() ? (string) Auth::id() : 'guest-' . substr(md5((string) microtime(true)), 0, 8);
        $conversationId = 'EO-' . time() . '-' . $uid;

        $order = Order::updateOrCreate(
            ['order_number' => $conversationId],
            [
                'user_id' => Auth::id(),
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => trim($request->address . ' / ' . $request->district . ' / ' . $request->city),
                'total_price' => $grandTotal,
                'status' => 'beklemede',
            ]
        );

        $order->items()->delete();

        foreach ($cart as $item) {
            $quantity = (int) ($item['qty'] ?? 1);
            $unitPrice = (float) ($item['price'] ?? 0);
            $itemTotal = $unitPrice * $quantity;

            $order->items()->create([
                'product_id' => isset($item['id']) && is_numeric($item['id']) ? (int) $item['id'] : null,
                'product_name' => $item['name'] ?? 'Eymen Optik Ürün',
                'price' => $unitPrice,
                'quantity' => $quantity,
                'total' => $itemTotal,
            ]);
        }

        if ($shipping > 0) {
            $order->items()->create([
                'product_id' => null,
                'product_name' => 'Kargo Bedeli',
                'price' => $shipping,
                'quantity' => 1,
                'total' => $shipping,
            ]);
        }

        Session::put('iyzico_order', [
            'conversation_id' => $conversationId,
            'order_id' => $order->id,
            'user_id' => Auth::id(),
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
        $iyzicoRequest->setPrice($this->priceFormat($grandTotal));
        $iyzicoRequest->setPaidPrice($this->priceFormat($grandTotal));
        $iyzicoRequest->setCurrency(Currency::TL);
        $iyzicoRequest->setBasketId($conversationId);
        $iyzicoRequest->setPaymentGroup(PaymentGroup::PRODUCT);
        $iyzicoRequest->setPaymentSource(config('app.name', 'Eymen Optik'));
        $iyzicoRequest->setForceThreeDS(1);
        $iyzicoRequest->setPosOrderId($conversationId);
        $iyzicoRequest->setDebitCardAllowed('true');
        $iyzicoRequest->setCallbackUrl(route('checkout.callback', ['cid' => $conversationId]));
        $iyzicoRequest->setEnabledInstallments([1, 2, 3, 6, 9]);

        $buyer = new Buyer();
        $buyer->setId($uid);
        $buyer->setName($this->firstName($request->full_name));
        $buyer->setSurname($this->lastName($request->full_name));
        $buyer->setGsmNumber($this->normalizePhoneForIyzico($request->phone));
        $buyer->setEmail($request->email);
        $buyer->setIdentityNumber('10000000146');
        $buyer->setLastLoginDate(now()->format('Y-m-d H:i:s'));
        $buyer->setRegistrationDate(Auth::user()?->created_at?->format('Y-m-d H:i:s') ?? now()->format('Y-m-d H:i:s'));
        $buyer->setRegistrationAddress($request->address);
        $buyer->setIp($this->normalizeIpForIyzico($request->ip()));
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

            Log::warning('Iyzico checkout initialize failed', [
                'status' => $checkoutFormInitialize->getStatus(),
                'error_code' => $checkoutFormInitialize->getErrorCode(),
                'error_message' => $checkoutFormInitialize->getErrorMessage(),
                'error_group' => $checkoutFormInitialize->getErrorGroup(),
                'conversation_id' => $conversationId,
            ]);

            // Remove the order and its items if payment initialization failed
            if (isset($order) && $order instanceof Order) {
                $this->deleteOrder($order);
            }
            return redirect()
                ->route('checkout.failed')
                ->with('error', $errorMessage);
        }

        Session::put('iyzico_token', $checkoutFormInitialize->getToken());

        return view('frontend.checkout.payment', [
            'checkoutFormContent' => $checkoutFormInitialize->getCheckoutFormContent(),
            'conversationId' => $conversationId,
        ]);
    }

    public function callback(Request $request)
    {
        $token = $request->input('token');
        $conversationId = $request->query('cid') ?: Session::get('iyzico_order.conversation_id');

        if (!$token || !$conversationId) {
            if ($conversationId) {
                $order = Order::where('order_number', $conversationId)->first();
                if ($order && !Auth::check() && $order->user_id) {
                    Auth::loginUsingId($order->user_id);
                    $request->session()->regenerate();
                }
                // If there's no token but an order exists, delete unpaid order to free space
                if (isset($order) && $order && !$order->iyzico_paid) {
                    $this->deleteOrder($order);
                }
            }

            return redirect()->route('checkout.failed');
        }

        $order = Order::where('order_number', $conversationId)->first();

        if (!$order) {
            return redirect()->route('checkout.failed');
        }

        $retrieveRequest = new RetrieveCheckoutFormRequest();
        $retrieveRequest->setLocale(Locale::TR);
        $retrieveRequest->setConversationId($conversationId);
        $retrieveRequest->setToken($token);

        $checkoutForm = CheckoutForm::retrieve(
            $retrieveRequest,
            $this->iyzicoOptions()
        );

        if (
            $checkoutForm->getStatus() === 'success'
            && $checkoutForm->getPaymentStatus() === 'SUCCESS'
        ) {
            $order->update([
                'iyzico_paid' => true,
                'iyzico_payment_id' => $checkoutForm->getPaymentId() ?: null,
            ]);

            if (!Auth::check() && $order->user_id) {
                Auth::loginUsingId($order->user_id);
                $request->session()->regenerate();
            }

            Session::forget('iyzico_token');

            return redirect()->route('checkout.success');
        }

        // Payment was not successful. Ensure the user is still logged in if
        // the order belongs to a user (session may have been lost during
        // the external redirect/post from the payment provider).
        if (!Auth::check() && $order->user_id) {
            Auth::loginUsingId($order->user_id);
            $request->session()->regenerate();
        }

        // Delete unpaid order and its items to avoid leftover records
        if (!$order->iyzico_paid) {
            $this->deleteOrder($order);
        }

        Session::forget('iyzico_token');

        return redirect()
            ->route('checkout.failed')
            ->with('error', $checkoutForm->getErrorMessage());
    }

    public function cancel(Request $request)
    {
        $conversationId = $request->input('cid') ?: Session::get('iyzico_order.conversation_id');

        if (! $conversationId) {
            return response()->json(['ok' => false], 400);
        }

        $order = Order::where('order_number', $conversationId)->first();

        if ($order && ! $order->iyzico_paid) {
            $this->deleteOrder($order);
        }

        Session::forget('iyzico_order');
        Session::forget('iyzico_token');

        return response()->json(['ok' => true]);
    }

    public function success()
    {
        return view('frontend.checkout.success');
    }

    public function failed()
    {
        return view('frontend.checkout.failed');
    }

    private function shippingConfiguration(): array
    {
        $settings = SiteSetting::query()->first();

        return [
            'freeShippingThreshold' => (float) ($settings?->shipping_free_threshold ?? 3000),
            'shippingCost' => (float) ($settings?->shipping_cost ?? 59.99),
        ];
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

    private function normalizePhoneForIyzico(?string $phone): string
    {
        $digits = preg_replace('/\D+/', '', (string) $phone);

        if ($digits === '') {
            return '+905550000000';
        }

        if (str_starts_with($digits, '0')) {
            $digits = substr($digits, 1);
        }

        if (str_starts_with($digits, '90')) {
            return '+' . $digits;
        }

        return '+90' . substr($digits, -10);
    }

    private function normalizeIpForIyzico(?string $ip): string
    {
        if (!is_string($ip) || $ip === '') {
            return '85.34.78.112';
        }

        $flags = FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE;

        if (filter_var($ip, FILTER_VALIDATE_IP, $flags)) {
            return $ip;
        }

        return '85.34.78.112';
    }

    /**
     * Safely delete an order and its related items if it's not paid.
     */
    private function deleteOrder(Order $order): void
    {
        try {
            if (! $order) {
                return;
            }

            if ($order->iyzico_paid) {
                Log::info('Attempted to delete paid order; skipping', ['order_id' => $order->id]);
                return;
            }

            $order->items()->delete();
            $order->delete();

            Log::info('Deleted unpaid order and its items', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
            ]);
        } catch (\Throwable $e) {
            Log::error('Failed to delete unpaid order', [
                'order_id' => $order->id ?? null,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
