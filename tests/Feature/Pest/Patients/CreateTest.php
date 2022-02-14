<?php

use App\Models\User;
use App\Models\Patient;

test('vet can access his own patients create page', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $this->assertTrue($vet->can('create', [Patient::class, $vet]));

    $response = $this->get(route('users.patients.create', $vet));
    $response->assertStatus(200);
});

test('vet can access other vets patients create page', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $otherVet = User::factory(['role' => 'vet'])->create();

    $this->assertTrue($vet->can('create', [Patient::class, $otherVet]));

    $response = $this->get(route('users.patients.create', $otherVet));
    $response->assertStatus(200);
});

test('vet can access owners patients create page', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $owner = User::factory(['role' => 'owner'])->create();

    $this->assertTrue($vet->can('create', [Patient::class, $owner]));

    $response = $this->get(route('users.patients.create', $owner));
    $response->assertStatus(200);
});

test('owner cannot access vets patients create page', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $vet = User::factory(['role' => 'vet'])->create();

    $this->assertFalse($owner->can('create', [Patient::class, $vet]));

    $response = $this->get(route('users.patients.create', $vet));
    $response->assertStatus(403);
});

test('owner cannot access other owners patients create page', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $otherOwner = User::factory(['role' => 'owner'])->create();

    $this->assertFalse($owner->can('create', [Patient::class, $otherOwner]));

    $response = $this->get(route('users.patients.create', $otherOwner));
    $response->assertStatus(403);
});

test('owner cannot access his own patients create page', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $this->assertFalse($owner->can('create', [Patient::class, $owner]));

    $response = $this->get(route('users.patients.create', $owner));
    $response->assertStatus(403);
});
