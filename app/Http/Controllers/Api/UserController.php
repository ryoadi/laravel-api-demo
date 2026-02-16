<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the authenticated user's profile.
     */
    public function show(Request $request): Responsable
    {
        return $request->user()->toResource();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request): Responsable
    {
        $request->user()->update($request->validated());

        return UserResource::make($request->user());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->user()->delete();

        return response()->json([
            'message' => 'User deleted successfully.',
        ]);
    }
}
