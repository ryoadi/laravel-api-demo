<?php

use App\Http\Resources\EmploymentResource;
use Illuminate\Http\Request;
use App\Models\Employment;

it('return specified data', function () {
    $job = Employment::factory()->make(['id' => 1]);
    $request = new Request();

    $result = EmploymentResource::make($job)->toResponse($request);

    expect($result->getData(true))->toHaveKeys(['data' => [
        'id', 
        'title', 
        'description', 
        'status', 
        'created_by', 
        'created_at', 
        'updated_at',
    ]]);
});
