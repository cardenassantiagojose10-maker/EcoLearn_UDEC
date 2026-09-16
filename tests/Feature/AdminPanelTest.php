<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    private function validCoursePayload(array $overrides = []): array
    {
        return array_merge([
            'title' => 'Curso administrado de prueba',
            'description' => 'Descripción de prueba',
            'expected_result' => 'El estudiante aprenderá algo.',
            'modules' => [
                ['title' => 'Módulo 1', 'content' => 'Contenido del módulo 1'],
            ],
            'questions' => [
                [
                    'question' => '¿Pregunta de prueba?',
                    'option_a' => 'Opción A',
                    'option_b' => 'Opción B',
                    'correct' => 'A',
                ],
            ],
        ], $overrides);
    }

    public function test_a_student_cannot_access_the_admin_panel(): void
    {
        $student = User::factory()->create(['role' => 'student']);

        $this->actingAs($student)->get('/admin')->assertStatus(403);
    }

    public function test_a_guest_cannot_access_the_admin_panel(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_an_admin_can_view_the_dashboard_with_stats(): void
    {
        $admin = $this->admin();
        User::factory()->create(['role' => 'student']);
        Course::create(['title' => 'X', 'description' => 'Y', 'content' => []]);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
    }

    public function test_an_admin_can_view_the_course_list(): void
    {
        $admin = $this->admin();
        Course::create(['title' => 'Curso admin', 'description' => 'D', 'content' => []]);

        $response = $this->actingAs($admin)->get('/admin/courses');

        $response->assertStatus(200)->assertSee('Curso admin');
    }

    public function test_an_admin_can_create_a_course_with_modules_and_questions(): void
    {
        $admin = $this->admin();

        $response = $this->actingAs($admin)->post('/admin/courses', $this->validCoursePayload());

        $response->assertRedirect(route('admin.courses.index'));
        $this->assertDatabaseHas('courses', ['title' => 'Curso administrado de prueba']);

        $course = Course::first();
        $this->assertSame('Módulo 1', $course->content['modules'][0]['title']);
        $this->assertSame('A', $course->content['evaluation']['questions'][0]['correct']);
    }

    public function test_creating_a_course_fails_without_required_fields(): void
    {
        $admin = $this->admin();

        $response = $this->actingAs($admin)->post('/admin/courses', []);

        $response->assertSessionHasErrors(['title', 'description', 'modules', 'questions']);
        $this->assertDatabaseCount('courses', 0);
    }

    public function test_an_admin_can_update_a_course(): void
    {
        $admin = $this->admin();
        $course = Course::create(['title' => 'Original', 'description' => 'D', 'content' => []]);

        $response = $this->actingAs($admin)->put(
            "/admin/courses/{$course->id}",
            $this->validCoursePayload(['title' => 'Actualizado'])
        );

        $response->assertRedirect(route('admin.courses.index'));
        $this->assertSame('Actualizado', $course->fresh()->title);
    }

    public function test_an_admin_can_delete_a_course(): void
    {
        $admin = $this->admin();
        $course = Course::create(['title' => 'Borrable', 'description' => 'D', 'content' => []]);

        $this->actingAs($admin)->delete("/admin/courses/{$course->id}")
            ->assertRedirect(route('admin.courses.index'));

        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }

    public function test_an_admin_can_view_the_student_list(): void
    {
        $admin = $this->admin();
        $student = User::factory()->create(['role' => 'student', 'name' => 'Estudiante Visible']);

        $response = $this->actingAs($admin)->get('/admin/users');

        $response->assertStatus(200)->assertSee('Estudiante Visible');
    }

    public function test_an_admin_can_delete_a_different_student(): void
    {
        $admin = $this->admin();
        $student = User::factory()->create(['role' => 'student']);

        $this->actingAs($admin)->delete("/admin/users/{$student->id}")
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseMissing('users', ['id' => $student->id]);
    }

    public function test_an_admin_cannot_delete_their_own_account(): void
    {
        $admin = $this->admin();

        $response = $this->actingAs($admin)->delete("/admin/users/{$admin->id}");

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }
}
