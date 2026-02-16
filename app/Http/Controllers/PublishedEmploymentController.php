<?php

namespace App\Http\Controllers;

use App\Enums\EmploymentStatusEnum;
use App\Http\Requests\QueryPublishedEmploymentRequest;
use App\Http\Resources\PublishedEmploymentListResource;
use App\Http\Resources\PublishedEmploymentResource;
use App\Models\Employment;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PublishedEmploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(QueryPublishedEmploymentRequest $request): Responsable
    {
        $employments = Employment::published()
            ->forIndex(...$request->validated())
            ->paginate();

        return PublishedEmploymentListResource::collection($employments);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employment $employment): Responsable
    {
        abort_unless(
            $employment->status === EmploymentStatusEnum::PUBLISHED,
            404,
        );

        return PublishedEmploymentResource::make($employment);
    }
}
