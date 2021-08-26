<?php

namespace App\Foundations;

use App\Contracts\BillerInterface;

class Biller implements BillerInterface
{
    public function bill($accountId, $amount)
    {
        // do something for bill
    }
}
