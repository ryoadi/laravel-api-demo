<?php

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;

it('validate form', function () {
    $rules = Validator::make([], (new LoginRequest())->rules())->getRules();

    expect($rules)->toHaveKeys(['email', 'password'])
        ->and($rules['email'])->toContain('required', 'email')
        ->and($rules['password'])->toContain('required', 'string');
});