<?php

use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Support\Facades\Validator;

describe('user update form', function () {
    it('validate the form', function () {
        $rules = Validator::make([], (new UpdateUserRequest)->rules())->getRules();

        expect($rules)->toHaveKeys(['name', 'email'])
            ->and($rules['name'])->toContain('sometimes', 'string')
            ->and($rules['email'])->toContain('sometimes', 'email');
    });
});
