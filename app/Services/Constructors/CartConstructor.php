<?php

namespace App\Services\Constructors;

interface CartConstructor
{
    public function addToCart($user, $cartId, $quantity = 1);

    public function getCartItems($user);

    public function removeFromCart($user ,$cartId);

    public function updateCartQuantity($user, $cartId);
}
