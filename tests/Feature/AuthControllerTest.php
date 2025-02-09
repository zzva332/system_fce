<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_redirect()
    {
        $response = $this->get('/login');

        $response->assertStatus(302);
    }
    public function test_login_with_view()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs("login");
    }
    public function test_login_auth(){
        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'admin123'
        ]);
        $response->assertRedirect('/dashboard');
    }
    public function test_login_error(){
        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'error'
        ]);
        $response->assertRedirect('/');
    }
}
