<?php

use App\Models\User;

test('vet cannot delete his own vet user on users destroy', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $this->assertFalse($vet->can('delete', $vet));

    $this->assertModelExists($vet);

    $response = $this->delete(route('users.destroy', $vet->id));

    $this->assertModelExists($vet);

    $response->assertStatus(403);
});

test('vet cannot delete other vets on users destroy', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $otherVet = User::factory(['role' => 'vet'])->create();

    $this->assertFalse($vet->can('delete', $otherVet));

    $this->assertModelExists($otherVet);

    $response = $this->delete(route('users.destroy', $otherVet->id));

    $this->assertModelExists($otherVet);

    $response->assertStatus(403);
});

test('vet can delete owners on users destroy', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $owner = User::factory(['role' => 'owner'])->create();

    $this->assertTrue($vet->can('delete', $owner));

    $this->assertModelExists($owner);

    $response = $this->delete(route('users.destroy', $owner->id));

    $this->assertModelMissing($owner);

    $response->assertRedirect(route('users.index'));
    $response->assertStatus(302);
});

test('owner cannot delete vets user on users destroy', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $vet = User::factory(['role' => 'vet'])->create();

    $this->assertFalse($owner->can('delete', $vet));

    $this->assertModelExists($vet);

    $response = $this->delete(route('users.destroy', $vet->id));

    $this->assertModelExists($vet);

    $response->assertStatus(403);
});

test('owner cannot delete other owners on users destroy', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $otherOwner = User::factory(['role' => 'owner'])->create();

    $this->assertFalse($owner->can('delete', $otherOwner));

    $this->assertModelExists($otherOwner);

    $response = $this->delete(route('users.destroy', $otherOwner->id));

    $this->assertModelExists($otherOwner);

    $response->assertStatus(403);
});

test('owner cannot delete his own user on users destroy', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $this->assertFalse($owner->can('delete', $owner));

    $this->assertModelExists($owner);

    $response = $this->delete(route('users.destroy', $owner->id));

    $this->assertModelExists($owner);

    $response->assertStatus(403);
});
