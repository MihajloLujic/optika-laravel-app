<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function loginAdmin()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $this->actingAs($admin);
    }

    public function test_index_displays_orders()
    {
        $this->loginAdmin();

        Order::factory()->count(3)->create();

        $response = $this->get('/admin/orders');

        $response->assertStatus(200);
    }

    public function test_can_mark_order_as_paid()
    {
        $this->loginAdmin();

        $order = Order::factory()->create(['status' => 'pending']);

        $response = $this->patch("/admin/orders/{$order->id}/paid");

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'paid',
        ]);

        $response->assertRedirect();
    }

    public function test_can_mark_order_as_cancelled()
    {
        $this->loginAdmin();

        $order = Order::factory()->create(['status' => 'pending']);

        $response = $this->patch("/admin/orders/{$order->id}/cancel");

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'cancelled',
        ]);

        $response->assertRedirect();
    }

    public function test_can_mark_order_as_pending()
    {
        $this->loginAdmin();

        $order = Order::factory()->create(['status' => 'paid']);

        $response = $this->patch("/admin/orders/{$order->id}/pending");

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'pending',
        ]);

        $response->assertRedirect();
    }
}
