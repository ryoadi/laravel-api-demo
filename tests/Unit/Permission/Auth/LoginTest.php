<?php

use App\Models\User;
use Illuminate\Support\Facades\Gate;

it('allow anonymous', function () {
    $result = Gate::allows('login', User::class);

    expect($result)->toBeTrue();
});

it('deny logged in user', function () {
    $user = User::factory()->make();

    $result = Gate::forUser($user)->denies('login', User::class);

    expect($result)->toBeTrue();
});