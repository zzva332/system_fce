<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsuarioControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_users_not_session()
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(302);
    }
    public function test_users_with_session()
    {
        $user = User::all()->first();
        $response = $this->actingAs($user)->get('/users');

        $response->assertStatus(200);
    }
    public function test_users_create_view_success()
    {
        $user = User::all()->first();
        $response = $this->actingAs($user)->get('/users/create');

        $response->assertStatus(200);
    }
}
