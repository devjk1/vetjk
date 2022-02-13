<?php

use App\Models\User;

test('vet can access users create page', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $this->assertTrue($vet->can('create', User::class));

    $response = $this->get(route('users.create'));

    $response->assertStatus(200);
});

test('owner cannot access users create page', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $this->assertFalse($owner->can('create', User::class));

    $response = $this->get(route('users.create'));

    $response->assertStatus(403);
});
