<?php

use App\Http\Resources\User\EmploymentListResource;
use App\Http\Resources\User\EmploymentResource;
use App\Models\Employment;
use App\Models\User;
use Illuminate\Http\Request;

describe('employment resource', function () {
    it('give specified data', function () {
        $user = User::factory()->make(['id' => 1]);
        $employment = Employment::factory()->make(['created_by_id' => $user->id, 'id' => 1]);
        $employment->setRelation('created_by', $user);
        $request = new Request;

        $result = EmploymentResource::make($employment)->toResponse($request);

        expect($result->getData(true))->toHaveKeys([
            'data' => [
                'title',
                'description',
                'status',
                'created_at',
                'updated_at',
            ],
            'link' => [
                'create',
                'update',
                'delete',
            ],
        ]);
    });
});

describe('employment list resource', function () {
    it('give specified data', function () {
        $user = User::factory()->make(['id' => 1]);
        $employment = Employment::factory()->make(['created_by_id' => $user->id, 'id' => 1]);
        $employment->setRelation('created_by', $user);
        $request = new Request;

        $result = EmploymentListResource::make($employment)->toResponse($request);

        expect($result->getData(true))->toHaveKeys(['data' => [
            'title',
            'status',
            'created_at',
            'updated_at',
            'link',
        ]]);
    });
});
