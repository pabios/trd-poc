<?php

namespace App\Domain\Enum;

enum TransactionType :string
{
    case DEPOT = 'depot';
    case PARI = 'pari';
    case RETRAIT = 'retrait';
}
