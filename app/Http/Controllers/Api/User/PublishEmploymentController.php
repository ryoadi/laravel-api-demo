<?php

namespace App\Http\Controllers\Api\User;

use App\Enums\EmploymentStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Employment;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PublishEmploymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Employment $employment): Responsable
    {
        // a user may only publish their own employments
        abort_unless(
            $employment->created_by_id === $request->user()->id,
            404,
        );

        // can't republish something already published
        abort_if(
            $employment->status === EmploymentStatusEnum::PUBLISHED,
            422,
        );

        $employment->update([
            'status' => EmploymentStatusEnum::PUBLISHED,
            'published_at' => Carbon::now(),
        ]);

        return \App\Http\Resources\User\EmploymentResource::make($employment);
    }
}
