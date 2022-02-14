<?php

use App\Models\User;

test('vet can update his own user on users update', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $this->assertTrue($vet->can('update', $vet));

    $this->assertModelExists($vet);

    $response = $this->put(route('users.update', $vet), [
        'email' => 'newEmail@example.com',
        'first_name' => $vet->first_name,
        'last_name' => $vet->last_name,
        'phone' => $vet->phone,
    ]);

    $this->assertDatabaseHas('users', [
        'id' => $vet->id,
        'email' => 'newEmail@example.com',
        'first_name' => $vet->first_name,
        'last_name' => $vet->last_name,
        'phone' => $vet->phone,
    ]);

    $response->assertRedirect(route('users.index'));
    $response->assertStatus(302);
});

test('vet can update owners on users update', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $owner = User::factory(['role' => 'owner'])->create();

    $this->assertTrue($vet->can('update', $owner));

    $this->assertModelExists($owner);

    $response = $this->put(route('users.update', $owner), [
        'email' => 'newEmailForOwner@example.com',
        'first_name' => $owner->first_name,
        'last_name' => $owner->last_name,
        'phone' => $owner->phone,
    ]);

    $this->assertDatabaseHas('users', [
        'id' => $owner->id,
        'email' => 'newEmailForOwner@example.com',
        'first_name' => $owner->first_name,
        'last_name' => $owner->last_name,
        'phone' => $owner->phone,
    ]);

    $response->assertRedirect(route('users.index'));
    $response->assertStatus(302);
});

test('vet cannot update other vets on users update', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $otherVet = User::factory(['role' => 'vet'])->create();

    $this->assertFalse($vet->can('update', $otherVet));

    $this->assertModelExists($otherVet);

    $response = $this->put(route('users.update', $otherVet), [
        'email' => 'newEmailForOtherVet@example.com',
        'first_name' => $otherVet->first_name,
        'last_name' => $otherVet->last_name,
        'phone' => $otherVet->phone,
    ]);

    $this->assertDatabaseMissing('users', [
        'id' => $otherVet->id,
        'email' => 'newEmailForOtherVet@example.com',
        'first_name' => $otherVet->first_name,
        'last_name' => $otherVet->last_name,
        'phone' => $otherVet->phone,
    ]);

    $response->assertStatus(403);
});

test('owner cannot update his own user on users update', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $this->assertFalse($owner->can('update', $owner));

    $this->assertDatabaseHas('users', [
        'email' => $owner->email,
    ]);

    $response = $this->put(route('users.update', $owner), [
        'email' => 'newEmailForOwner2@example.com',
        'first_name' => $owner->first_name,
        'last_name' => $owner->last_name,
        'phone' => $owner->phone,
    ]);

    $this->assertDatabaseMissing('users', [
        'id' => $owner->id,
        'email' => 'newEmailForOwner2@example.com',
        'first_name' => $owner->first_name,
        'last_name' => $owner->last_name,
        'phone' => $owner->phone,
    ]);

    $response->assertStatus(403);
});

test('owner cannot update vets on users update', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $vet = User::factory(['role' => 'vet'])->create();

    $this->assertFalse($owner->can('update', $vet));

    $this->assertDatabaseHas('users', [
        'email' => $vet->email,
    ]);

    $response = $this->put(route('users.update', $vet), [
        'email' => 'newEmailForVet@example.com',
        'first_name' => $vet->first_name,
        'last_name' => $vet->last_name,
        'phone' => $vet->phone,
    ]);

    $this->assertDatabaseMissing('users', [
        'id' => $vet->id,
        'email' => 'newEmailForVet@example.com',
        'first_name' => $vet->first_name,
        'last_name' => $vet->last_name,
        'phone' => $vet->phone,
    ]);

    $response->assertStatus(403);
});

test('owner cannot update owners on users update', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $otherOwner = User::factory(['role' => 'owner'])->create();

    $this->assertFalse($owner->can('update', $otherOwner));

    $this->assertDatabaseHas('users', [
        'email' => $otherOwner->email,
    ]);

    $response = $this->put(route('users.update', $otherOwner), [
        'email' => 'newEmailForOtherOwner@example.com',
        'first_name' => $otherOwner->first_name,
        'last_name' => $otherOwner->last_name,
        'phone' => $otherOwner->phone,
    ]);

    $this->assertDatabaseMissing('users', [
        'id' => $otherOwner->id,
        'email' => 'newEmailForOtherOwner@example.com',
        'first_name' => $otherOwner->first_name,
        'last_name' => $otherOwner->last_name,
        'phone' => $otherOwner->phone,
    ]);

    $response->assertStatus(403);
});
