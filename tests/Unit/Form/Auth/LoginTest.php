<?php

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;

describe('login form', function () {

    it('validate form', function () {
        $rules = Validator::make([], (new LoginRequest)->rules())->getRules();

        expect($rules)->toHaveKeys(['email', 'password'])
            ->and($rules['email'])->toContain('required', 'email')
            ->and($rules['password'])->toContain('required', 'string');
    });
});
