<?php

namespace App\enums;

enum PaymentMethodEnum : string
{
    case STRIPE = 'stripe';
    case CASH_ON_DELIVERY = 'cash_on_delivery';
}
