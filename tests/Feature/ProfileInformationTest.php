<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_information_can_be_updated()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->put('/user/profile-information', [
            'first_name' => 'Test First Name',
            'last_name' => 'Test Last Name',
            'email' => 'test@example.com',
            'phone' => '1231231235'
        ]);

        $this->assertEquals('Test First Name', $user->fresh()->first_name);
        $this->assertEquals('Test Last Name', $user->fresh()->last_name);
        $this->assertEquals('test@example.com', $user->fresh()->email);
        $this->assertEquals('1231231235', $user->fresh()->phone);
    }
}
