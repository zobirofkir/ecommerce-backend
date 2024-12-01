<?php

namespace App\Services\Services;

use App\Http\Resources\StripePaymentResource;
use App\Models\Order;
use App\Models\Cart;
use App\Services\Constructors\OrderConstructor;
use App\Services\Services\Payments\StripePaymentService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderConstructor
{
    protected $stripePaymentService;

    /**
     * OrderService constructor.
     */
    public function __construct(StripePaymentService $stripePaymentService)
    {
        $this->stripePaymentService = $stripePaymentService;
    }

    /**
     * Get all orders
     *
     * @return AnonymousResourceCollection
     */
    public function allOrders() : AnonymousResourceCollection
    {
        return StripePaymentResource::collection(
            Order::with('products')->where('user_id', Auth::id())->orderBy('id', 'desc')->get()
        );
    }

    /**
     * Undocumented function
     *
     * @return StripePaymentResource
     */
    public function stripeOrder($user) : StripePaymentResource
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
