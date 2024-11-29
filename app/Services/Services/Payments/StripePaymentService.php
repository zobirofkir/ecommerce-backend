<?php

namespace App\Services\Services\Payments;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripePaymentService
{
    /**
     * Process payment for an order.
     */
    public function processPayment(Order $order)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Order #' . $order->id,
                        ],
                        'unit_amount' => $order->total * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
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
