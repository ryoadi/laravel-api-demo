<?php

use App\Models\User;
use Illuminate\Support\Facades\Gate;

describe('view account', function () {

    it('allow logged in', function () {
        $user = User::factory()->make();

        $result = Gate::forUser($user)->allows('view-account', User::class);

        expect($result)->toBeTrue();
    });

    it('deny anonymous', function () {
        $result = Gate::denies('view-account', User::class);

        expect($result)->toBeTrue();
    });

});
