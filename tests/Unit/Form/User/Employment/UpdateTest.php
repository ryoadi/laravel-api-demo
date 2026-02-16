<?php

use App\Http\Requests\User\Employment\UpdateEmploymentRequest;
use Illuminate\Support\Facades\Validator;

describe('employment update form', function () {
    it('validate the form', function () {
        $rules = Validator::make([], (new UpdateEmploymentRequest)->rules())->getRules();

        expect($rules)->toHaveKeys(['title', 'description'])
            ->and($rules['title'])->toContain('sometimes', 'string')
            ->and($rules['description'])->toContain('sometimes', 'string');
    });
});
