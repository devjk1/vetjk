<?php

use App\Models\Patient;
use App\Models\User;

test('vet can delete his own patients on patients destroy', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $patient = Patient::factory(['user_id' => $vet->id])->create();

    $this->assertModelExists($patient);

    $this->assertTrue($vet->can('delete', $patient));

    $response = $this->delete(route('patients.destroy', $patient->id));

    $this->assertModelMissing($patient);

    $response->assertRedirect(route('patients.index'));
    $response->assertStatus(302);
});

test('vet can delete other vets patients on patients destroy', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $otherVet = User::factory(['role' => 'vet'])->create();
    $patient = Patient::factory(['user_id' => $otherVet->id])->create();

    $this->assertModelExists($patient);

    $this->assertTrue($vet->can('delete', $patient));

    $response = $this->delete(route('patients.destroy', $patient->id));

    $this->assertModelMissing($patient);

    $response->assertRedirect(route('patients.index'));
    $response->assertStatus(302);
});

test('vet can delete owners patients on patients destroy', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $owner = User::factory(['role' => 'owner'])->create();
    $patient = Patient::factory(['user_id' => $owner->id])->create();

    $this->assertModelExists($patient);

    $this->assertTrue($vet->can('delete', $patient));

    $response = $this->delete(route('patients.destroy', $patient->id));

    $this->assertModelMissing($patient);

    $response->assertRedirect(route('patients.index'));
    $response->assertStatus(302);
});

test('owner cannot delete vets patients on patients destroy', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $vet = User::factory(['role' => 'vet'])->create();
    $patient = Patient::factory(['user_id' => $vet->id])->create();

    $this->assertModelExists($patient);

    $this->assertFalse($owner->can('delete', $patient));

    $response = $this->delete(route('patients.destroy', $patient->id));

    $this->assertModelExists($patient);

    $response->assertStatus(403);
});

test('owner cannot delete other owners patients on patients destroy', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $otherOwner = User::factory(['role' => 'owner'])->create();
    $patient = Patient::factory(['user_id' => $otherOwner->id])->create();

    $this->assertModelExists($patient);

    $this->assertFalse($owner->can('delete', $patient));

    $response = $this->delete(route('patients.destroy', $patient->id));

    $this->assertModelExists($patient);

    $response->assertStatus(403);
});

test('owner cannot delete his own patients on patients destroy', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $patient = Patient::factory(['user_id' => $owner->id])->create();

    $this->assertModelExists($patient);

    $this->assertFalse($owner->can('delete', $patient));

    $response = $this->delete(route('patients.destroy', $patient->id));

    $this->assertModelExists($patient);

    $response->assertStatus(403);
});
