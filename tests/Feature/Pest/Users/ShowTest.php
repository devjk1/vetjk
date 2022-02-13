<?php

use App\Models\User;

test('vet can access any owner users show page', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $owner = User::factory(['role' => 'owner'])->create();

    $this->assertTrue($vet->can('view', $owner));

    $response = $this->get(route('users.show', $owner->id));

    $response->assertStatus(200);
});

test('vet can access his own users show page', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $this->assertTrue($vet->can('view', $vet));

    $response = $this->get(route('users.show', $vet->id));

    $response->assertStatus(200);
});

test('vet cannot access other vets users show page', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $otherVet = User::factory(['role' => 'vet'])->create();

    $this->assertFalse($vet->can('view', $otherVet));

    $response = $this->get(route('users.show', $otherVet->id));

    $response->assertStatus(403);
});

test('owner cannot access a vets users show page', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $vet = User::factory(['role' => 'vet'])->create();

    $this->assertFalse($owner->can('view', $vet));

    $response = $this->get(route('users.show', $vet->id));

    $response->assertStatus(403);
});

test('owner cannot access his own users show page', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $this->assertFalse($owner->can('view', $owner));

    $response = $this->get(route('users.show', $owner->id));

    $response->assertStatus(403);
});

test('owner cannot access other owners users show page', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $otherOwner = User::factory(['role' => 'owner'])->create();

    $this->assertFalse($owner->can('view', $otherOwner));

    $response = $this->get(route('users.show', $otherOwner->id));

    $response->assertStatus(403);
});
