<?php

namespace App\Http\Controllers\Api\User;

use App\Enums\EmploymentStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Employment\CreateEmploymentRequest;
use App\Http\Requests\User\Employment\QueryEmploymentRequest;
use App\Http\Requests\User\Employment\UpdateEmploymentRequest;
use App\Http\Resources\User\EmploymentListResource;
use App\Http\Resources\User\EmploymentResource;
use App\Models\Employment;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(QueryEmploymentRequest $request): Responsable
    {
        $employments = $request->user()->employments()
            ->forIndex(...$request->validated())
            ->paginate();

        return EmploymentListResource::collection($employments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEmploymentRequest $request): Responsable
    {
        $employment = Employment::create([
            'title' => $request->title,
            'description' => $request->description,
            'created_by_id' => $request->user()->id,
            'status' => EmploymentStatusEnum::DRAFT,
        ]);

        return EmploymentResource::make($employment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Employment $employment): Responsable
    {
        abort_unless(
            $employment->created_by_id === $request->user()->id,
            404,
        );

        return EmploymentResource::make($employment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Employment $employment, UpdateEmploymentRequest $request): Responsable
    {
        abort_unless(
            $employment->created_by_id === $request->user()->id,
            404,
        );

        $employment->update($request->validated());

        return EmploymentResource::make($employment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Employment $employment): Responsable
    {
        abort_unless(
            $employment->created_by_id === $request->user()->id,
            404,
        );

        $employment->delete();

        return EmploymentResource::make($employment);
    }
}
