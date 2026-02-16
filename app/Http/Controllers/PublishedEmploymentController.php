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
        $query = Employment::where('status', 1); // 1 = PUBLISHED

        if ($request->has('keyword')) {
            $query->where('title', 'like', '%'.$request->keyword.'%')
                ->orWhere('description', 'like', '%'.$request->keyword.'%');
        }

        $employments = $query->get();

        return PublishedEmploymentListResource::collection($employments);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employment $employment): Responsable
    {
        throw_unless(
            $employment->status === EmploymentStatusEnum::PUBLISHED,
            NotFoundHttpException::class,
        );

        return PublishedEmploymentResource::make($employment);
    }
}
