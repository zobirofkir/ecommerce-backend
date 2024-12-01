<?php

namespace App\Services\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Services\Constructors\CartConstructor;
use App\Http\Resources\CartResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CartService implements CartConstructor
{
    /**
     * Add to cart
     *
     * @return CartResource
     */
    public function addToCart($user, $cartId, $quantity = 1) : CartResource
    {
        if (!$user) {
            abort(401);
        }

        $product = Product::find($cartId);
        if (!$product) {
            abort(404);
        }

        $cartItem = Cart::where('user_id', $user->id)->where('product_id', $cartId)->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $cartItem = Cart::create([
                'user_id' => $user->id,
                'product_id' => $cartId,
                'quantity' => $quantity,
            ]);
        }

        return CartResource::make($cartItem);
    }

    /**
     * Get cart items
     *
     * @return AnonymousResourceCollection
     */
    public function getCartItems($user) : AnonymousResourceCollection
    {
        if (!$user) {
            abort(401);
        }

        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        return CartResource::collection($cartItems);
    }

    /**
     * Remove from cart
     *
     * @return bool
     */
    public function removeFromCart($user, $cartId) : bool
    {
        if (!$user) {
            abort(401);
        }

        $cartItem = Cart::where('user_id', $user->id)->where('id', $cartId)->first();

        if (!$cartItem) {
            abort(404);
        }

        $cartItem->delete();

        return true;
    }

    /**
     * Update cart quantity
     *
     * @return CartResource
     */
    public function updateCartQuantity($user, $cartId) : CartResource
    {
        $quantity = request()->input('quantity');

        if (!$user) {
            abort(401);
        }

        $cartItem = Cart::where('user_id', $user->id)->where('id', $cartId)->first();

        if (!$cartItem) {
            abort(404);
        }

        if ($quantity <= 0) {
            abort(400);
        }

        $cartItem->quantity = $quantity;
        $cartItem->save();

        return CartResource::make($cartItem);
    }
}
