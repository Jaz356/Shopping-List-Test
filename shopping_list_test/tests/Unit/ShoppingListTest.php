<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\ShoppingList;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShoppingListTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_shopping_list()
    {
        ShoppingList::factory()->create();

        $response = $this->get('/api/shopping-lists');

        $response->assertStatus(200);
    }

    public function test_can_create_shopping_list_item()
    {
        $data = [
            'item' => 'Apples',
            'quantity' => 5,
        ];

        $response = $this->post('/api/shopping-lists', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('shopping_lists', $data);
    }

    public function test_cannot_create_duplicate_shopping_list_item()
    {
        ShoppingList::factory()->create(['item' => 'Apples']);

        $data = [
            'item' => 'Apples',
            'quantity' => 5,
        ];

        $response = $this->post('/api/shopping-lists', $data);

        $response->assertStatus(400);
        $response->assertJson(['message' => 'producto existente']);
    }

    public function test_can_view_single_shopping_list_item()
    {
        $item = ShoppingList::factory()->create();

        $response = $this->get('/api/shopping-lists/' . $item->id);

        $response->assertStatus(200);
    }

    public function test_can_update_shopping_list_item()
    {
        $item = ShoppingList::factory()->create();

        $data = [
            'item' => 'Bananas',
            'quantity' => 10,
        ];

        $response = $this->put('/api/shopping-lists/' . $item->id, $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('shopping_lists', $data);
    }

    public function test_can_delete_shopping_list_item()
    {
        $item = ShoppingList::factory()->create();

        $response = $this->delete('/api/shopping-lists/' . $item->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('shopping_lists', ['id' => $item->id]);
    }

    public function test_can_delete_all_shopping_list_items()
    {
        ShoppingList::factory()->count(3)->create();

        $response = $this->delete('/api/shopping-lists');

        $response->assertStatus(204);
        $this->assertDatabaseCount('shopping_lists', 0);
    }
}