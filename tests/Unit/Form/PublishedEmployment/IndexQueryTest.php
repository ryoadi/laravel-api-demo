<?php

use App\Http\Requests\QueryPublishedEmploymentRequest;
use Illuminate\Support\Facades\Validator;

describe('search employment form', function () {

    it('validate form', function (): void {
        $rules = Validator::make([], (new QueryPublishedEmploymentRequest)->rules())->getRules();

        expect($rules)->toHaveKeys(['keyword'])
            ->and($rules['keyword'])->toContain('filled', 'string');
    });
});
