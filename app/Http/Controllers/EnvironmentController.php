<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnvironmentResource;
use App\Models\Environment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class EnvironmentController extends Controller
{
    public function index() : View
    {
        return view('environment.index', [
            'environments' => Environment::all(),
        ]);
    }

    public function create() : View
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show(Environment $environment) : View
    {
        return view('environment.show', [
            'environment' => $environment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Environment $environment
     * @return Response
     */
    public function edit(Environment $environment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Environment $environment
     * @return Response
     */
    public function update(Request $request, Environment $environment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Environment $environment
     * @return Response
     */
    public function destroy(Environment $environment)
    {
        //
    }
}
