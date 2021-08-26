<?php

namespace App\Foundations;

class Order
{
    public $account;
    public $amount;

    public function __construct($account, $amount) {
        $this->account = $account;
        $this->amount = $amount;
    }
}
