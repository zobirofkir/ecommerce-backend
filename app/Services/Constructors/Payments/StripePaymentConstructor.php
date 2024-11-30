<?php
namespace App\Services\Constructors\Payments;

use App\Models\Order;

interface StripePaymentConstructor{
    public function processPayment(Order $order);
}
