<?php

namespace App\Enums;

enum PaymentGatewayEnum: string
{
    case PAYPAL = 'paypal';
    case STRIPE = 'stripe';
    case COD = 'cod';

}
