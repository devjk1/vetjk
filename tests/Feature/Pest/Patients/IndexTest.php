<?php

use App\Models\User;
use App\Models\Patient;

test('vet can access patients index page', function () {
    $vet = User::factory(['role' => 'vet'])->create();
    $this->actingAs($vet);

    $this->assertTrue($vet->can('viewAny', Patient::class));

    $response = $this->get(route('patients.index'));
    $response->assertStatus(200);
});

test('owner cannot access patients index page', function () {
    $owner = User::factory(['role' => 'owner'])->create();
    $this->actingAs($owner);

    $this->assertFalse($owner->can('viewAny', Patient::class));

    $response = $this->get(route('patients.index'));
    $response->assertStatus(403);
});
