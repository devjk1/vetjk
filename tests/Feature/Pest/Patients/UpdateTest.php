<?php

use App\Models\Patient;
use App\Models\User;

test('vet can update his own patients on patients update', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $patient = Patient::factory(['user_id' => $vet->id])->create();

    $this->assertTrue($vet->can('update', $patient));

    $this->assertDatabaseHas('patients', [
        'name' => $patient->name,
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
        'user_id' => $vet->id,
    ]);

    $response = $this->put(route('patients.update', $patient->id), [
        'name' => 'Test Patient Name',
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
    ]);

    $this->assertDatabaseHas('patients', [
        'user_id' => $vet->id,
        'name' => 'Test Patient Name',
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
    ]);

    $response->assertRedirect(route('patients.index'));
    $response->assertStatus(302);
});

test('vet can update other vets patients on patients update', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $otherVet = User::factory(['role' => 'vet'])->create();
    $patient = Patient::factory(['user_id' => $otherVet->id])->create();

    $this->assertTrue($vet->can('update', $patient));

    $this->assertDatabaseHas('patients', [
        'name' => $patient->name,
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
        'user_id' => $otherVet->id,
    ]);

    $response = $this->put(route('patients.update', $patient->id), [
        'name' => 'Test Patient Name',
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
    ]);

    $this->assertDatabaseHas('patients', [
        'user_id' => $otherVet->id,
        'name' => 'Test Patient Name',
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
    ]);

    $response->assertRedirect(route('patients.index'));
    $response->assertStatus(302);
});

test('vet can update owners patients on patients update', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $owner = User::factory(['role' => 'owner'])->create();
    $patient = Patient::factory(['user_id' => $owner->id])->create();

    $this->assertTrue($vet->can('update', $patient));

    $this->assertDatabaseHas('patients', [
        'name' => $patient->name,
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
        'user_id' => $owner->id,
    ]);

    $response = $this->put(route('patients.update', $patient->id), [
        'name' => 'Test Patient Name',
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
    ]);

    $this->assertDatabaseHas('patients', [
        'user_id' => $owner->id,
        'name' => 'Test Patient Name',
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
    ]);

    $response->assertRedirect(route('patients.index'));
    $response->assertStatus(302);
});

test('owner cannot update vets patients on patients update', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $vet = User::factory(['role' => 'vet'])->create();
    $patient = Patient::factory(['user_id' => $vet->id])->create();

    $this->assertFalse($owner->can('update', $patient));

    $this->assertDatabaseHas('patients', [
        'name' => $patient->name,
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
        'user_id' => $vet->id,
    ]);

    $response = $this->put(route('patients.update', $patient->id), [
        'name' => 'Test Patient Name',
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
    ]);

    $this->assertDatabaseMissing('patients', [
        'user_id' => $vet->id,
        'name' => 'Test Patient Name',
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
    ]);

    $response->assertStatus(403);
});

test('owner cannot update other owners patients on patients update', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $otherOwner = User::factory(['role' => 'owner'])->create();
    $patient = Patient::factory(['user_id' => $otherOwner->id])->create();

    $this->assertFalse($owner->can('update', $patient));

    $this->assertDatabaseHas('patients', [
        'name' => $patient->name,
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
        'user_id' => $otherOwner->id,
    ]);

    $response = $this->put(route('patients.update', $patient->id), [
        'name' => 'Test Patient Name',
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
    ]);

    $this->assertDatabaseMissing('patients', [
        'user_id' => $otherOwner->id,
        'name' => 'Test Patient Name',
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
    ]);

    $response->assertStatus(403);
});

test('owner cannot update his own patients on patients update', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $patient = Patient::factory(['user_id' => $owner->id])->create();

    $this->assertFalse($owner->can('update', $patient));

    $this->assertDatabaseHas('patients', [
        'name' => $patient->name,
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
        'user_id' => $owner->id,
    ]);

    $response = $this->put(route('patients.update', $patient->id), [
        'name' => 'Test Patient Name',
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
    ]);

    $this->assertDatabaseMissing('patients', [
        'user_id' => $owner->id,
        'name' => 'Test Patient Name',
        'species' => $patient->species,
        'color' => $patient->color,
        'dob' => $patient->dob,
    ]);

    $response->assertStatus(403);
});
