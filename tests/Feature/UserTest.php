<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_on_failure()
    {
        $this->postJson(route('users.register'))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'password', 'email']);
    }

    public function test_regitser_on_success()
    {
        $user = User::factory()->make();
        $this->postJson(route('users.register'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password
        ])
            ->assertCreated();

        $this->assertDatabaseHas('users', ['name' => $user->name]);
    }


}