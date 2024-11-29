<?php

namespace App\Services\Services;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Cart;
use App\Services\Constructors\OrderConstructor;
use App\Enums\PaymentMethodEnum;
use App\Http\Requests\CashOnDeliveryRequest;
use App\Services\Services\Payments\StripePaymentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class OrderService implements OrderConstructor
{
    protected $stripePaymentService;

    public function __construct( StripePaymentService $stripePaymentService )
    {
        $this->stripePaymentService = $stripePaymentService;
    }

    public function allOrders()

    {
        return OrderResource::collection(
            Order::with('products')->where('user_id', Auth::id())->get()
        );
    }

    public function getOrder($orderId)
    {
        $order = Order::with('products')
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return $order;
    }

    public function createOrder($user, PaymentMethodEnum $paymentMethod = PaymentMethodEnum::CASH_ON_DELIVERY, array $validatedData)
    {
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        DB::beginTransaction();

        $order = Order::create([
            'user_id' => $user->id,
            'total' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity),
            'status' => 'pending',
            'payment_method' => $paymentMethod->value,
            ...$validatedData  // تمرير البيانات التي تم التحقق منها هنا
        ]);

        foreach ($cartItems as $cartItem) {
            $order->products()->attach($cartItem->product_id, ['quantity' => $cartItem->quantity]);
            $cartItem->delete();
        }

        DB::commit();

        if ($paymentMethod === PaymentMethodEnum::CASH_ON_DELIVERY) {
            return OrderResource::make($order);
        }

        return $this->stripePaymentService->processPayment($order);
    }
}
