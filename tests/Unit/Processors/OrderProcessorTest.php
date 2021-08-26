<?php

namespace Tests\Unit\Processors;

use App\Contracts\BillerInterface;
use App\Foundations\Order;
use App\Processors\OrderProcessor;
use App\Repositories\OrderRepository;
use Exception;
use Mockery\MockInterface;
use Tests\TestCase;

class OrderProcessorTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_should_create_order()
    {
        $order = new Order((object) ['id' => 1], 100);

        $this->mock(BillerInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('bill')->once();
        });
        $this->mock(OrderRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('getRecentOrderCount')->once();
            $mock->shouldReceive('create')->once();
        });

        $this->app->make(OrderProcessor::class)
            ->process($order);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_should_throw_exception()
    {
        $order = new Order((object) ['id' => 1], 100);

        $this->expectException(Exception::class);
        $this->mock(OrderRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('getRecentOrderCount')->once()
                ->andReturn(1);
            $mock->shouldNotReceive('create');
        });

        $this->app->make(OrderProcessor::class)
            ->process($order);
    }
}
