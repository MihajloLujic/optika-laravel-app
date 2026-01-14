<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_example(): void
    {
        Product::factory()->create();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
