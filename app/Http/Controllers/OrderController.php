<?php

namespace App\Http\Controllers;

use App\Http\Resources\StripePaymentResource;
use App\Services\Facades\OrderFacade;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function allOrders() : AnonymousResourceCollection
    {
        return OrderFacade::allOrders();
    }

    /**
     * Undocumented function
     *
     * @return StripePaymentResource
     */
    public function stripeOrder(Request $request) : StripePaymentResource
    {
        $user = $request->user();

        return OrderFacade::stripeOrder($user);
    }
}
