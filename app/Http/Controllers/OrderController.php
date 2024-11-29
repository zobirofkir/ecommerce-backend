<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Facades\OrderFacade;
use App\Enums\PaymentMethodEnum;
use App\Http\Requests\CashOnDeliveryRequest;
use App\Http\Requests\PaymentMethodRequest;

class OrderController extends Controller
{
    public function allOrders()
    {
        return OrderFacade::allOrders();
    }

    public function getOrder($orderId)
    {
        return OrderFacade::getOrder($orderId);
    }


    public function createOrder(PaymentMethodRequest $request, CashOnDeliveryRequest $cashOnDeliveryRequest)
    {
        $validated = $request->validated();
        $cashOnDeliveryValidated = $cashOnDeliveryRequest->validated();

        $user = $request->user();
        $paymentMethod = PaymentMethodEnum::from($validated['payment_method']);

        return OrderFacade::createOrder($user, $paymentMethod, $cashOnDeliveryValidated);
    }

}
