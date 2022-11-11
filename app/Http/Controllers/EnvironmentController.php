<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnvironmentRequest;
use App\Models\Environment;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Http;
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
        return view('environment.create');
    }

    public function store(StoreEnvironmentRequest $request) : Redirector|Application|RedirectResponse
    {
        try {
            Environment::create($request->all());

            return redirect('environment.index', 200);
        } catch (Exception $e) {
            return redirect('environment.create', 400);
        }

    }

    public function show(Environment $environment) : View
    {
        return view('environment.show', [
            'environment' => $environment,
        ]);
    }

    public function edit(Environment $environment) : View
    {
        return view('environment.edit', [
            'environment' => $environment,
        ]);
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
