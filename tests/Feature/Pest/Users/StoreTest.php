<?php

use App\Models\User;

test('vet can store a user to users store', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $this->assertTrue($vet->can('create', User::class));

    $userMake = User::factory()->make();
    $response = $this->post(route('users.store'), $userMake->toArray());;

    $user = User::where('phone', $userMake->phone)->first();
    $this->assertModelExists($user);

    $response->assertRedirect(route('users.show', $user->id));
    $response->assertStatus(302);
});

test('owner cannot store a user on users store', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $this->assertFalse($owner->can('create', User::class));

    $userMake = User::factory()->make();
    $response = $this->post(route('users.store'), $userMake->toArray());;

    $user = User::where('phone', $userMake->phone)->first();

    $this->assertDatabaseMissing('users', [
        'email' => $userMake->email,
    ]);

    $response->assertStatus(403);
});
