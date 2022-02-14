<?php

use App\Models\Patient;
use App\Models\User;

test('vet can access his own patients edit page on patients edit', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $patient = Patient::factory(['user_id' => $vet->id])->create();

    $this->assertTrue($vet->can('update', $patient));

    $response = $this->get(route('patients.edit', $patient->id));

    $response->assertStatus(200);
});

test('vet can access other vets patients edit page on patients edit', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $otherVet = User::factory(['role' => 'vet'])->create();
    $patient = Patient::factory(['user_id' => $otherVet->id])->create();

    $this->assertTrue($vet->can('update', $patient));

    $response = $this->get(route('patients.edit', $patient->id));

    $response->assertStatus(200);
});

test('vet can access owners patients edit page on patients edit', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $owner = User::factory(['role' => 'owner'])->create();
    $patient = Patient::factory(['user_id' => $owner->id])->create();

    $this->assertTrue($vet->can('update', $patient));

    $response = $this->get(route('patients.edit', $patient->id));

    $response->assertStatus(200);
});

test('owner cannot access vets patients edit page on patients edit', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $vet = User::factory(['role' => 'vet'])->create();
    $patient = Patient::factory(['user_id' => $vet->id])->create();

    $this->assertFalse($owner->can('update', $patient));

    $response = $this->get(route('patients.edit', $patient->id));

    $response->assertStatus(403);
});

test('owner cannot access other owners patients edit page on patients edit', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $otherOwner = User::factory(['role' => 'owner'])->create();
    $patient = Patient::factory(['user_id' => $otherOwner->id])->create();

    $this->assertFalse($owner->can('update', $patient));

    $response = $this->get(route('patients.edit', $patient->id));

    $response->assertStatus(403);
});

test('owner cannot access his own patients edit page on patients edit', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $patient = Patient::factory(['user_id' => $owner->id])->create();

    $this->assertFalse($owner->can('update', $patient));

    $response = $this->get(route('patients.edit', $patient->id));

    $response->assertStatus(403);
});
