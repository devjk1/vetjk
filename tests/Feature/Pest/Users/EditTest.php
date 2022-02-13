<?php

use App\Models\User;

test('vet can access his own users edit page', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $this->assertTrue($vet->can('update', $vet));

    $response = $this->get(route('users.edit', $vet->id));

    $response->assertStatus(200);
});

test('vet can access owners users edit page', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $owner = User::factory(['role' => 'owner'])->create();

    $this->assertTrue($vet->can('update', $owner));

    $response = $this->get(route('users.edit', $owner->id));

    $response->assertStatus(200);
});

test('vet cannot access other vets users edit page', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $otherVet = User::factory(['role' => 'vet'])->create();

    $this->assertFalse($vet->can('update', $otherVet));

    $response = $this->get(route('users.edit', $otherVet->id));

    $response->assertStatus(403);
});
