<?php

use App\Http\Resources\PublishedEmploymentListResource;
use App\Http\Resources\PublishedEmploymentResource;
use App\Models\Employment;
use App\Models\User;
use Illuminate\Http\Request;

describe('published employment resource', function () {
    it('give specified data', function () {
        $user = User::factory()->make(['id' => 1]);
        $employment = Employment::factory()->make(['created_by_id' => $user->id]);
        $employment->setRelation('created_by', $user);
        $request = new Request;

        $result = PublishedEmploymentResource::make($employment)->toResponse($request);

        expect($result->getData(true))->toHaveKeys(['data' => [
            'title',
            'description',
            'created_by',
            'created_at',
            'updated_at',
        ]]);
    });
});

describe('published employment list resource', function () {
    it('give specified data', function () {
        $user = User::factory()->make(['id' => 1]);
        $employment = Employment::factory()->make(['created_by_id' => $user->id]);
        $employment->setRelation('created_by', $user);
        $request = new Request;

        $result = PublishedEmploymentListResource::make($employment)->toResponse($request);

        expect($result->getData(true))->toHaveKeys(['data' => [
            'title',
            'created_by',
            'created_at',
            'updated_at',
            'link',
        ]]);
    });
});
