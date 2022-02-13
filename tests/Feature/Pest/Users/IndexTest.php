<?php

use App\Models\User;

test('vet can access users index page', function () {
    $user = User::factory(['role' => 'vet'])->create();
    $this->actingAs($user);

    $response = $this->get('/users');

    $response->assertStatus(200);
});

test('owner cannot access users index page', function () {
    $user = User::factory(['role' => 'owner'])->create();
    $this->actingAs($user);

    $response = $this->get('/users');

    $response->assertStatus(403);
});
