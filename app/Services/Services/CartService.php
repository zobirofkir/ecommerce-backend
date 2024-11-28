<?php

namespace App\Services\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Services\Constructors\CartConstructor;
use App\Http\Resources\CartResource;

class CartService implements CartConstructor
{
    public function addToCart($user, $productId, $quantity = 1)
    {
        if (!$user) {
            abort(401);
        }

        $product = Product::find($productId);
        if (!$product) {
            abort(404);
        }

        $cartItem = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $cartItem = Cart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return CartResource::make($cartItem);
    }

    public function getCartItems($user)
    {
        if (!$user) {
            abort(401);
        }

        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        return CartResource::collection($cartItems);
    }

    public function removeFromCart($user, $cartId)
    {
        if (!$user) {
            abort(401);
        }

        // Fetch the specific cart item by user ID and cart ID
        $cartItem = Cart::where('user_id', $user->id)->where('id', $cartId)->first();

        if (!$cartItem) {
            abort(404);
        }

        // Delete the cart item
        $cartItem->delete();

        return true;
    }


    public function updateCartQuantity($user, $productId)
    {
        $quantity = request()->input('quantity'); // Get the quantity from the input JSON body

        if (!$user) {
            abort(401);
        }

        $cartItem = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();

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
