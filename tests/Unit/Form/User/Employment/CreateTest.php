<?php

use App\Http\Requests\User\Employment\CreateEmploymentRequest;
use Illuminate\Support\Facades\Validator;

it('validate form', function () {
    $rules = Validator::make([], (new CreateEmploymentRequest())->rules())->getRules();

    expect($rules)->toHaveKeys(['title', 'description'])
        ->and($rules['title'])->toContain('required', 'string')
        ->and($rules['description'])->toContain('required', 'string');
});
