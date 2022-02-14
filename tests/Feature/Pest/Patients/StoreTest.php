<?php

use App\Models\Patient;
use App\Models\User;

test('vet can store his own patients on patients store', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $patientMake = Patient::factory()->make();

    $this->assertTrue($vet->can('create', [Patient::class, $vet]));

    $response = $this->post(route('users.patients.store', $vet), $patientMake->toArray());

    $this->assertDatabaseHas('patients', [
        'name' => $patientMake->name,
        'species' => $patientMake->species,
        'color' => $patientMake->color,
        'dob' => $patientMake->dob,
        'user_id' => $vet->id,
    ]);

    $response->assertRedirect(route('users.show', $vet->id));
    $response->assertStatus(302);
});

test('vet can store other vets patients on patients store', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $otherVet = User::factory(['role' => 'vet'])->create();
    $patientMake = Patient::factory()->make();

    $this->assertTrue($vet->can('create', [Patient::class, $otherVet]));

    $response = $this->post(route('users.patients.store', $otherVet), $patientMake->toArray());

    $this->assertDatabaseHas('patients', [
        'name' => $patientMake->name,
        'species' => $patientMake->species,
        'color' => $patientMake->color,
        'dob' => $patientMake->dob,
        'user_id' => $otherVet->id,
    ]);

    $response->assertRedirect(route('users.show', $otherVet->id));
    $response->assertStatus(302);
});

test('vet can store owners patients on patients store', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $owner = User::factory(['role' => 'owner'])->create();
    $patientMake = Patient::factory()->make();

    $this->assertTrue($vet->can('create', [Patient::class, $owner]));

    $response = $this->post(route('users.patients.store', $owner), $patientMake->toArray());

    $this->assertDatabaseHas('patients', [
        'name' => $patientMake->name,
        'species' => $patientMake->species,
        'color' => $patientMake->color,
        'dob' => $patientMake->dob,
        'user_id' => $owner->id,
    ]);

    $response->assertRedirect(route('users.show', $owner->id));
    $response->assertStatus(302);
});

test('owner cannot store vets patients on patients store', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $vet = User::factory(['role' => 'vet'])->create();
    $patientMake = Patient::factory()->make();

    $this->assertFalse($owner->can('create', [Patient::class, $vet]));

    $response = $this->post(route('users.patients.store', $vet), $patientMake->toArray());

    $this->assertDatabaseMissing('patients', [
        'name' => $patientMake->name,
        'species' => $patientMake->species,
        'color' => $patientMake->color,
        'dob' => $patientMake->dob,
        'user_id' => $vet->id,
    ]);

    $response->assertStatus(403);
});

test('owner cannot store other owners patients on patients store', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $otherOwner = User::factory(['role' => 'owner'])->create();
    $patientMake = Patient::factory()->make();

    $this->assertFalse($owner->can('create', [Patient::class, $otherOwner]));

    $response = $this->post(route('users.patients.store', $otherOwner), $patientMake->toArray());

    $this->assertDatabaseMissing('patients', [
        'name' => $patientMake->name,
        'species' => $patientMake->species,
        'color' => $patientMake->color,
        'dob' => $patientMake->dob,
        'user_id' => $otherOwner->id,
    ]);

    $response->assertStatus(403);
});

test('owner cannot access his own patients patients store', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $patientMake = Patient::factory()->make();

    $this->assertFalse($owner->can('create', [Patient::class, $owner]));

    $response = $this->post(route('users.patients.store', $owner), $patientMake->toArray());

    $this->assertDatabaseMissing('patients', [
        'name' => $patientMake->name,
        'species' => $patientMake->species,
        'color' => $patientMake->color,
        'dob' => $patientMake->dob,
        'user_id' => $owner->id,
    ]);

    $response->assertStatus(403);
});
