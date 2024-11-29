<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Facades\OrderFacade;
use Illuminate\Http\Request;

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

    public function createOrder(Request $request)
    {
        $user = $request->user();
        return OrderFacade::createOrder($user);
    }
}
