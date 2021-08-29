<?php

namespace Tests\Unit\Repositories;

use App\Entities\Order;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// use PHPUnit\Framework\TestCase;

class OrderRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function it_should_get_recent_order_count()
    {
        Carbon::setTestNow('2021-08-29 12:00:00');
        $accountId = 1;
        $assertCount = 2;

        Order::factory()->count($assertCount)->create([
            'account' => $accountId,
            'created_at' => '2021-08-29 11:55:00'
        ]);
        Order::factory()->create([
            'account' => $accountId,
            'created_at' => '2021-08-29 11:54:59'
        ]);

        $count = $this->app->make(OrderRepository::class)
            ->getRecentOrderCount($accountId, 5);

        $this->assertEquals($assertCount, $count);
    }
}
