<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function loginAdmin()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $this->actingAs($admin);
    }

    public function test_index_displays_products()
    {
        $this->loginAdmin();

        Product::factory()->count(3)->create();

        $response = $this->get('/admin/products');

        $response->assertStatus(200);
    }

    public function test_create_displays_form()
    {
        $this->loginAdmin();

        $response = $this->get('/admin/products/create');

        $response->assertStatus(200);
    }

    public function test_store_creates_product()
    {
        $this->loginAdmin();

        $category = Category::factory()->create();

        $data = [
            'category_id' => $category->id,
            'name' => 'Test proizvod',
            'slug' => 'test-proizvod',
            'price' => 1234,
            'stock' => 5,
        ];

        $response = $this->post('/admin/products', $data);

        $this->assertDatabaseHas('products', ['name' => 'Test proizvod']);
        $response->assertRedirect('/admin/products');
    }

    public function test_edit_displays_form()
    {
        $this->loginAdmin();

        $product = Product::factory()->create();

        $response = $this->get("/admin/products/{$product->id}/edit");

        $response->assertStatus(200);
    }

    public function test_update_updates_product()
    {
        $this->loginAdmin();

        $product = Product::factory()->create();

        $data = [
            'name' => 'Izmenjen proizvod',
            'slug' => 'izmenjen-proizvod',
            'price' => 2000,
            'stock' => 10,
            'category_id' => $product->category_id,
        ];

        $response = $this->put("/admin/products/{$product->id}", $data);

        $this->assertDatabaseHas('products', ['name' => 'Izmenjen proizvod']);
        $response->assertRedirect('/admin/products');
    }

    public function test_destroy_deletes_product()
    {
        $this->loginAdmin();

        $product = Product::factory()->create();

        $response = $this->delete("/admin/products/{$product->id}");

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $response->assertRedirect('/admin/products');
    }
}
