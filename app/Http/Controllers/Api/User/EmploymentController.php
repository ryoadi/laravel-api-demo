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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EmploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, QueryEmploymentRequest $queryRequest): Responsable
    {
        $userId = $request->user()->id;

        $query = Employment::where('created_by_id', $userId);

        if ($queryRequest->has('keyword')) {
            $query->where('title', 'like', '%'.$queryRequest->keyword.'%')
                ->orWhere('description', 'like', '%'.$queryRequest->keyword.'%');
        }

        if ($queryRequest->has('status')) {
            $query->where('status', $queryRequest->status->value);
        }

        $employments = $query->get();

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
        throw_unless(
            $employment->created_by_id === $request->user()->id,
            NotFoundHttpException::class,
        );

        return EmploymentResource::make($employment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Employment $employment, UpdateEmploymentRequest $request): Responsable
    {
        throw_unless(
            $employment->created_by_id === $request->user()->id,
            NotFoundHttpException::class,
        );

        $employment->update($request->validated());

        return EmploymentResource::make($employment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Employment $employment): Responsable
    {
        throw_unless(
            $employment->created_by_id === $request->user()->id,
            NotFoundHttpException::class,
        );

        $employment->delete();

        return EmploymentResource::make($employment);
    }
}
