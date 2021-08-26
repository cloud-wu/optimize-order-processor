<?php

namespace App\Contracts;

interface BillerInterface
{
    public function bill($account, $amount);
}