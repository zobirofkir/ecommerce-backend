<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Services\Facades\CartFacade;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CartController extends Controller
{
    /**
     * Add to cart
     *
     * @return CartResource
     */
    public function addToCart(Request $request, $cartId) : CartResource
    {
        $quantity = $request->input('quantity', 1);
        $user = $request->user();
        return CartFacade::addToCart($user, $cartId, $quantity);
    }

    /**
     * Get cart items
     *
     * @return AnonymousResourceCollection
     */
    public function getCartItems(Request $request) : AnonymousResourceCollection
    {
        $user = $request->user();
        return CartFacade::getCartItems($user);
    }

    /**
     * Remove from cart
     *
     * @return bool
     */
    public function removeFromCart(Request $request, $cartId) : bool
    {
        $user = $request->user();
        return CartFacade::removeFromCart($user, $cartId);
    }

    /**
     * Update cart quantity
     *
     * @return CartResource
     */
    public function updateCartQuantity(Request $request, $cartId) : CartResource
    {
        $quantity = $request->input('quantity');
        $user = $request->user();
        return CartFacade::updateCartQuantity($user, $cartId, $quantity);
    }
}
