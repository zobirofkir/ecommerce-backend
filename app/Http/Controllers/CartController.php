<?php

namespace App\Http\Controllers;

use App\Services\Facades\CartFacade;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $cartId)
    {
        $quantity = $request->input('quantity', 1);
        $user = $request->user();
        return CartFacade::addToCart($user, $cartId, $quantity);
    }

    public function getCartItems(Request $request)
    {
        $user = $request->user();
        return CartFacade::getCartItems($user);
    }

    public function removeFromCart(Request $request, $cartId)
    {
        $user = $request->user();
        return CartFacade::removeFromCart($user, $cartId);
    }

    public function updateCartQuantity(Request $request, $cartId)
    {
        $quantity = $request->input('quantity');
        $user = $request->user();
        return CartFacade::updateCartQuantity($user, $cartId, $quantity);
    }
}
