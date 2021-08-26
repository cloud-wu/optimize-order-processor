<?php

namespace App\Processors;

use App\Contracts\BillerInterface;
use App\Foundations\Order;
use App\Repositories\OrderRepository;
use Exception;

class OrderProcessor 
{
    private const RECENT_MINUTE = 5;

    private $biller;
    private $orderRepository;
 
    public function __construct(
        BillerInterface $biller, 
        OrderRepository $orderRepository
    ) {
        $this->biller = $biller;
        $this->orderRepository = $orderRepository;
    }

    public function process(Order $order)
    {
        $this->guard($order);

        $accountId = $order->account->id;
        $amount = $order->amount;

        $this->biller->bill($accountId, $amount);
        $this->orderRepository->create([
            'account' => $accountId,
            'amount' => $amount,
        ]);
    }

    private function guard(Order $order)
    {
        $recent = $this->orderRepository->getRecentOrderCount(
            $order->account->id, 
            self::RECENT_MINUTE
        );

        if ($recent > 0) {
            throw new Exception('Duplicate order likely.');
        }
    }
}
