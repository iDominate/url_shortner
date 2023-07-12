<?php

namespace Tests\Feature;

use App\Models\UrlEntry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class URLShortnerTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_assert_url_is_shortened()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $url = 'https://www.google.com';
        $response = $this->postJson(route('shorten'), ['url' => $url])->assertOk()->json();
        $this->assertArrayHasKey(UrlEntry::ORIGINAL_URL, $response['data']);
        $this->assertDatabaseHas('url_entries', [UrlEntry::ORIGINAL_URL => $url]);

    }

    public function test_assert_redirected_to_url()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $url = 'https://www.google.com';
        $response = $this->postJson(route('shorten'), ['url' => $url])->assertOk()->json();
        $id = $response['data'][UrlEntry::UNIQUE_ID];
        $this->getJson(route('visit', ['id' => $id]))->assertRedirect($url);
    }
}