<?php

namespace Tests\Feature;

use Tests\TestCase;

class ChatbotTest extends TestCase
{
    public function test_ecobot_responds_in_spanish_by_default(): void
    {
        $response = $this->postJson('/chatbot/respond', ['message' => 'hola']);

        $response->assertStatus(200)
            ->assertJson(['lang' => 'es'])
            ->assertJsonStructure(['text', 'lang']);
    }

    public function test_ecobot_can_switch_to_english(): void
    {
        $response = $this->postJson('/chatbot/respond', ['message' => 'english']);

        $response->assertStatus(200)->assertJson(['lang' => 'en']);
    }

    public function test_ecobot_rejects_messages_over_500_characters(): void
    {
        $response = $this->postJson('/chatbot/respond', ['message' => str_repeat('a', 501)]);

        $response->assertStatus(422);
    }

    public function test_ecobot_falls_back_to_default_response_for_unknown_input(): void
    {
        $response = $this->postJson('/chatbot/respond', ['message' => 'xyzxyz123']);

        $response->assertStatus(200)
            ->assertJsonFragment(['lang' => 'es']);
    }
}
