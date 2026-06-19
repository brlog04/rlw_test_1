<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthAndProductsFlowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Guests should be redirected to login.
     */
    public function test_guest_is_redirected_to_login_when_opening_home(): void
    {
        $response = $this->get('/');

        $response->assertRedirectToRoute('login');
    }

    public function test_user_can_register_and_is_redirected_to_products_index(): void
    {
        $response = $this->post('/register', [
            'name' => 'Marko',
            'email' => 'marko@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirectToRoute('products.index');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'marko@example.com']);
    }

    public function test_user_can_login_and_see_products_page(): void
    {
        $user = User::factory()->create([
            'password' => 'password123',
        ]);

        Product::factory()->create([
            'name' => 'Test Product',
            'price' => 199.99,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirectToRoute('products.index');

        $page = $this->get('/products');
        $page->assertOk();
        $page->assertSee('Products');
        $page->assertSee('Test Product');
    }
}
