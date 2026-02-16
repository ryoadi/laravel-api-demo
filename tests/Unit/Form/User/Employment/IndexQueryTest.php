<?php

use App\Http\Requests\User\Employment\QueryEmploymentRequest;
use Illuminate\Support\Facades\Validator;

describe('search employment form', function () {
    it('validate form rules', function () {
        $rules = Validator::make([], (new QueryEmploymentRequest)->rules())->getRules();

        expect($rules)->toHaveKeys(['keyword', 'status'])
            ->and($rules['keyword'])->toContain('filled', 'string')
            ->and($rules['status'])->toContain('filled');
    });

    it('passes validation with valid status draft', function () {
        $validator = Validator::make(
            ['status' => 0],
            (new QueryEmploymentRequest)->rules()
        );

        expect($validator->passes())->toBeTrue();
    });

    it('passes validation with valid status published', function () {
        $validator = Validator::make(
            ['status' => 1],
            (new QueryEmploymentRequest)->rules()
        );

        expect($validator->passes())->toBeTrue();
    });

    it('passes validation with valid status archived', function () {
        $validator = Validator::make(
            ['status' => 2],
            (new QueryEmploymentRequest)->rules()
        );

        expect($validator->passes())->toBeTrue();
    });

    it('passes validation with valid keyword and status', function () {
        $validator = Validator::make(
            [
                'keyword' => 'Senior Developer',
                'status' => 1,
            ],
            (new QueryEmploymentRequest)->rules()
        );

        expect($validator->passes())->toBeTrue();
    });

    it('fails validation with empty status', function () {
        $validator = Validator::make(
            ['status' => ''],
            (new QueryEmploymentRequest)->rules()
        );

        expect($validator->fails())->toBeTrue();
        expect($validator->errors()->has('status'))->toBeTrue();
    });

    it('fails validation with invalid status value', function () {
        $validator = Validator::make(
            ['status' => 'INVALID'],
            (new QueryEmploymentRequest)->rules()
        );

        expect($validator->fails())->toBeTrue();
        expect($validator->errors()->has('status'))->toBeTrue();
    });
});
