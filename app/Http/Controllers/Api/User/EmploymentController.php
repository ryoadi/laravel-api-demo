<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateEmploymentRequest;
use App\Http\Requests\User\Employment\QueryEmploymentRequest;
use App\Http\Requests\User\UpdateEmploymentRequest;
use App\Models\Employment;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(QueryEmploymentRequest $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEmploymentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Employment $employment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmploymentRequest $request, Employment $employment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employment $employment)
    {
        //
    }
}
