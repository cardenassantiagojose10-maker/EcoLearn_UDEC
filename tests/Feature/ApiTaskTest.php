<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTaskTest extends TestCase
{
    use RefreshDatabase;

    private function authenticatedHeaders(User $user): array
    {
        $token = $user->createToken('test')->plainTextToken;

        return ['Authorization' => "Bearer $token"];
    }

    public function test_guest_cannot_access_tasks(): void
    {
        $this->getJson('/api/tasks')->assertStatus(401);
    }

    public function test_a_user_can_create_and_list_only_their_own_tasks(): void
    {
        $owner = User::factory()->create();
        $stranger = User::factory()->create();

        Task::factory()->for($stranger)->create(['title' => 'Tarea ajena']);

        $response = $this->withHeaders($this->authenticatedHeaders($owner))
            ->postJson('/api/tasks', ['title' => 'Mi tarea', 'description' => 'Detalle']);

        $response->assertStatus(201)->assertJsonFragment(['title' => 'Mi tarea']);

        $list = $this->withHeaders($this->authenticatedHeaders($owner))
            ->getJson('/api/tasks');

        $list->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonMissing(['title' => 'Tarea ajena']);
    }

    public function test_a_user_cannot_view_update_or_delete_another_users_task(): void
    {
        $owner = User::factory()->create();
        $intruder = User::factory()->create();
        $task = Task::factory()->for($owner)->create();

        $headers = $this->authenticatedHeaders($intruder);

        $this->getJson("/api/tasks/{$task->id}", $headers)->assertStatus(403);
        $this->putJson("/api/tasks/{$task->id}", ['title' => 'hackeado'], $headers)->assertStatus(403);
        $this->deleteJson("/api/tasks/{$task->id}", [], $headers)->assertStatus(403);

        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'title' => $task->title]);
    }

    public function test_a_user_can_update_and_complete_their_own_task(): void
    {
        $owner = User::factory()->create();
        $task = Task::factory()->for($owner)->create(['is_done' => false]);

        $response = $this->withHeaders($this->authenticatedHeaders($owner))
            ->putJson("/api/tasks/{$task->id}", ['is_done' => true]);

        $response->assertStatus(200)->assertJsonFragment(['is_done' => true]);
    }

    public function test_a_user_can_delete_their_own_task(): void
    {
        $owner = User::factory()->create();
        $task = Task::factory()->for($owner)->create();

        $response = $this->withHeaders($this->authenticatedHeaders($owner))
            ->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
