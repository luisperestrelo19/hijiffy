<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DialogFlowTest extends TestCase
{
   
    public function test_empty_input(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->get('/api/question');

        $response->assertStatus(400);
    }

    public function test_result(): void
    {
        $user = User::first();
        $query = '?question=weather';
        $response = $this->actingAs($user)->get('/api/question'. $query);
        $response->assertStatus(200);
        $this->assertContains($response->getData()->message,[
            'The weather for today is QWERT.',
            'Today will be ZXCV',
        ]);
    }
}
