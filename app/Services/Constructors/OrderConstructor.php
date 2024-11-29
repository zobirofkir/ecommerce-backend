<?php
namespace App\Services\Constructors;

use App\Models\Order;
use Illuminate\Http\Request;

interface OrderConstructor
{
    public function allOrders();
    
    public function getOrder($orderId);

    public function createOrder($user);
}
