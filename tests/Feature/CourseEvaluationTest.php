<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\EvaluationAttempt;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseEvaluationTest extends TestCase
{
    use RefreshDatabase;

    private function courseWithQuiz(): Course
    {
        return Course::create([
            'title' => 'Curso de prueba',
            'description' => 'Descripción de prueba',
            'content' => [
                'modules' => [],
                'evaluation' => [
                    'title' => 'Evaluación final del curso',
                    'questions' => [
                        ['number' => 1, 'question' => '¿1+1?', 'options' => ['A' => '1', 'B' => '2'], 'correct' => 'B'],
                        ['number' => 2, 'question' => '¿Capital de Francia?', 'options' => ['A' => 'Madrid', 'B' => 'París'], 'correct' => 'B'],
                    ],
                ],
            ],
        ]);
    }

    public function test_guest_is_redirected_to_login_when_visiting_the_course_catalog(): void
    {
        $this->get('/courses')->assertRedirect('/login');
    }

    public function test_an_authenticated_user_can_see_the_course_catalog(): void
    {
        $user = User::factory()->create();
        $course = $this->courseWithQuiz();

        $response = $this->actingAs($user)->get('/courses');

        $response->assertStatus(200)->assertSee($course->title);
    }

    public function test_an_authenticated_user_can_view_a_single_course(): void
    {
        $user = User::factory()->create();
        $course = $this->courseWithQuiz();

        $response = $this->actingAs($user)->get("/courses/{$course->id}");

        $response->assertStatus(200)->assertSee($course->title);
    }

    public function test_viewing_a_nonexistent_course_returns_404(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/courses/999')->assertStatus(404);
    }

    public function test_submitting_the_evaluation_scores_correct_and_incorrect_answers(): void
    {
        $user = User::factory()->create();
        $course = $this->courseWithQuiz();

        $response = $this->actingAs($user)->post("/courses/{$course->id}/evaluate", [
            'answers' => ['1' => 'b', '2' => 'a'],
        ]);

        $attempt = EvaluationAttempt::first();
        $response->assertRedirect("/courses/{$course->id}/resultado/{$attempt->id}");

        $this->assertSame(1, $attempt->score);
        $this->assertSame(2, $attempt->total);
        $this->assertSame($user->id, $attempt->user_id);
    }

    public function test_a_user_can_view_their_own_evaluation_result(): void
    {
        $user = User::factory()->create();
        $course = $this->courseWithQuiz();

        $this->actingAs($user)->post("/courses/{$course->id}/evaluate", ['answers' => ['1' => 'B', '2' => 'B']]);
        $attempt = EvaluationAttempt::first();

        $response = $this->actingAs($user)->get("/courses/{$course->id}/resultado/{$attempt->id}");

        $response->assertStatus(200);
    }

    public function test_a_user_cannot_view_another_users_evaluation_result(): void
    {
        $owner = User::factory()->create();
        $intruder = User::factory()->create();
        $course = $this->courseWithQuiz();

        $this->actingAs($owner)->post("/courses/{$course->id}/evaluate", ['answers' => ['1' => 'B', '2' => 'B']]);
        $attempt = EvaluationAttempt::first();

        $this->actingAs($intruder)
            ->get("/courses/{$course->id}/resultado/{$attempt->id}")
            ->assertStatus(404);
    }
}
