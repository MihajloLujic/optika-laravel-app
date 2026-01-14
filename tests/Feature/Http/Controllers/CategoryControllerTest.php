<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function loginAdmin()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $this->actingAs($admin);
    }

    public function test_index_displays_categories()
    {
        $this->loginAdmin();

        Category::factory()->count(3)->create();

        $response = $this->get('/admin/categories');

        $response->assertStatus(200);
    }

    public function test_create_displays_form()
    {
        $this->loginAdmin();

        $response = $this->get('/admin/categories/create');

        $response->assertStatus(200);
    }

    public function test_store_creates_category()
    {
        $this->loginAdmin();

        $data = [
            'name' => 'Test kategorija',
            'slug' => 'test-kategorija',
        ];

        $response = $this->post('/admin/categories', $data);

        $this->assertDatabaseHas('categories', $data);
        $response->assertRedirect('/admin/categories');
    }

    public function test_edit_displays_form()
    {
        $this->loginAdmin();

        $category = Category::factory()->create();

        $response = $this->get("/admin/categories/{$category->id}/edit");

        $response->assertStatus(200);
    }

    public function test_update_updates_category()
    {
        $this->loginAdmin();

        $category = Category::factory()->create();

        $data = [
            'name' => 'Izmenjena',
            'slug' => 'izmenjena',
        ];

        $response = $this->put("/admin/categories/{$category->id}", $data);

        $this->assertDatabaseHas('categories', $data);
        $response->assertRedirect('/admin/categories');
    }

    public function test_destroy_deletes_category()
    {
        $this->loginAdmin();

        $category = Category::factory()->create();

        $response = $this->delete("/admin/categories/{$category->id}");

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
        $response->assertRedirect('/admin/categories');
    }
}
