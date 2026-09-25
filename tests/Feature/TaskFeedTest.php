<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskFeedTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_view_edit_update_status_and_delete_tasks(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Social Feed');
        $response->assertSee('Drop a new task into the feed');

        $this->post('/tasks', [
            'task_name' => 'Morning sprint',
            'description' => 'Ship the retro dashboard.',
            'status' => 'pending',
            'due_date' => '2026-09-30',
        ])->assertRedirect('/');

        $this->assertDatabaseHas('tasks', [
            'task_name' => 'Morning sprint',
            'description' => 'Ship the retro dashboard.',
            'status' => 'pending',
        ]);

        $this->get('/')->assertSee('/css/style.css', false);

        $taskId = Task::first()->id;

        $this->get("/tasks/{$taskId}/edit")
            ->assertOk()
            ->assertSee('value="Morning sprint"', false)
            ->assertSee('name="_method" value="PUT"', false)
            ->assertSee('/css/style.css', false);

        $this->put("/tasks/{$taskId}", [
            'task_name' => 'Updated sprint',
            'description' => 'Ship and review the retro dashboard.',
            'status' => 'completed',
            'due_date' => '2026-10-01',
        ])->assertRedirect('/');

        $this->assertDatabaseHas('tasks', [
            'id' => $taskId,
            'task_name' => 'Updated sprint',
            'description' => 'Ship and review the retro dashboard.',
            'status' => 'completed',
            'due_date' => '2026-10-01',
        ]);

        $this->get('/')->assertSee('Updated sprint')->assertSee('completed');

        $this->delete("/tasks/{$taskId}")->assertRedirect('/');
        $this->assertDatabaseMissing('tasks', ['id' => $taskId]);
    }
}
