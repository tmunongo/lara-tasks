<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_todos_json_structure(): void
    {
        $response = $this->get('/api/todos');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'description',
                    'status',
                ],
            ],
        ]);
    }

    public function test_todos_pagination(): void
    {
        $response = $this->get('/api/todos');

        $response->assertJsonFragment(['current_page' => 1]);

        $response->assertJsonFragment(['per_page' => 10]);
    }

    public function test_toggle_status_to_pending()
    {
        $todo = Todo::factory()->create(['status' => 'Done']);

        $response = $this->post("/api/update-todo/{$todo->id}");

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'id' => $todo->id,
            'status' => 'Pending',
        ]);

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'status' => 'Pending',
        ]);
    }

    public function test_toggle_status_to_done()
    {
        $todo = Todo::factory()->create(['status' => 'Pending']);

        $response = $this->post("/api/update-todo/{$todo->id}");

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'id' => $todo->id,
            'description' => $todo->description,
            'status' => 'Done',
        ]);

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'description' => $todo->description,
            'status' => 'Done',
        ]);
    }

    public function test_invalid_item_id()
    {
        $response = $this->post("/api/update-todo/foo");

        $response->assertStatus(404);
    }
}
