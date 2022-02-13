<?php

use App\Models\User;

test('vet can access users create page', function () {
    $user = User::factory(['role' => 'vet'])->create();
    $this->actingAs($user);

    $response = $this->get('/users/create');

    $response->assertStatus(200);
});

test('owner cannot access users create page', function () {
    $user = User::factory(['role' => 'owner'])->create();
    $this->actingAs($user);

    $response = $this->get('/users/create');

    $response->assertStatus(403);
});
