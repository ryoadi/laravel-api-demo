<?php

use App\Models\Employment;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

describe('update employment', function () {
    it('allows the creator', function () {
        $user = User::factory()->make(['id' => 1]);
        $employment = Employment::factory()->make(['created_by_id' => $user->id]);
        $employment->setRelation('created_by', $user);

        $result = Gate::forUser($user)->allows('update', $employment);

        expect($result)->toBeTrue();
    });

    it('denies other users', function () {
        $user = User::factory()->make(['id' => 1]);
        $otherUser = User::factory()->make(['id' => 2]);
        $employment = Employment::factory()->make(['created_by_id' => $user->id]);
        $employment->setRelation('created_by', $user);

        $result = Gate::forUser($otherUser)->denies('update', $employment);

        expect($result)->toBeTrue();
    });
});
