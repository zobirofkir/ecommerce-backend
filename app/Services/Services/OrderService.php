<?php

namespace App\Services\Services;

use App\Http\Resources\StripePaymentResource;
use App\Models\Order;
use App\Models\Cart;
use App\Services\Constructors\OrderConstructor;
use App\Services\Services\Payments\StripePaymentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderConstructor
{
    protected $stripePaymentService;

    public function __construct(StripePaymentService $stripePaymentService)
    {
        $this->stripePaymentService = $stripePaymentService;
    }

    public function allOrders()
    {
        return StripePaymentResource::collection(
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

    public function stripeOrder($user)
    {
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        DB::beginTransaction();

        $order = Order::create([
            'user_id' => $user->id,
            'total' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity),
            'status' => 'pending',
            'payment_method' => 'stripe',
        ]);

        foreach ($cartItems as $cartItem) {
            $order->products()->attach($cartItem->product_id, ['quantity' => $cartItem->quantity]);
            $cartItem->delete();
        }

        DB::commit();

        return $this->stripePaymentService->processPayment($order);
    }
}
