<?php

use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Validator;

describe('register form', function () {

    it('validate form', function () {
        $rules = Validator::make([], (new RegisterRequest)->rules())->getRules();

        expect($rules)->toHaveKeys(['email', 'password'])
            ->and($rules['name'])->toContain('required', 'string')
            ->and($rules['email'])->toContain('required', 'email')
            ->and($rules['password'])->toContain('required', 'string', 'confirmed');
    });
});
