<?php

namespace App\Http\Controllers;

use App\Http\Requests\QueryPublishedEmploymentRequest;
use App\Models\Employment;
use Illuminate\Http\Request;

class PublishedEmploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(QueryPublishedEmploymentRequest $request)
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
}
