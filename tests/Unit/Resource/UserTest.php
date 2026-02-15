<?php

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

describe('user resource', function () {
    it('return specified data', function () {
        $user = User::factory()->make(['id' => 1]);
        $request = new Request();

        $response = UserResource::make($user)->toResponse($request);

        expect($response->getData(true))->toHaveKeys(['data' => [
            'id', 'name', 'email', 'created_at', 'updated_at'
        ]]);
    });
});

