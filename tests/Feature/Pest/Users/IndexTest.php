<?php

use App\Models\User;

test('vet can access users index page', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $this->assertTrue($vet->can('viewAny', User::class));

    $response = $this->get(route('users.index'));

    $response->assertStatus(200);
});

test('owner cannot access users index page', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $this->assertFalse($owner->can('viewAny', User::class));

    $response = $this->get(route('users.index'));

    $response->assertStatus(403);
});
