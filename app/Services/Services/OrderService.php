<?php

namespace App\Services\Services;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Cart;
use App\Services\Constructors\OrderConstructor;
use App\Enums\PaymentMethodEnum;
use App\Http\Requests\CashOnDeliveryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class OrderService implements OrderConstructor
{
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

        return $this->processPayment($order);
    }

    private function processPayment(Order $order)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Order #' . $order->id,
                    ],
                    'unit_amount' => $order->total * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => env('SUCCESS_URL') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => env('CANCEL_URL'),
            'metadata' => [
                'order_id' => $order->id,
            ],
        ]);

        return OrderResource::make($session);
    }
}
