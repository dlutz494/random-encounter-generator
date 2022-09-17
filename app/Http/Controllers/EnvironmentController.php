<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnvironmentResource;
use App\Models\Environment;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnvironmentController extends Controller
{
    public function index() : Collection
    {
        return Environment::all();
    }

    public function store(Request $request) : Response
    {
        try {
            Environment::create($request->all());

            return Response('Environment stored successfully', 200);
        } catch (Exception $e) {
            return Response('An error occurred', 404);
        }
    }

    public function create() : Response
    {
        return Response('Empty Route', 200);
    }

    public function show(Environment $environment) : EnvironmentResource
    {
        return EnvironmentResource::make(Environment::findOrFail($environment->getKey()));
    }

    public function edit(Environment $environment) : Response
    {
        return Response($environment, 200);
    }

    public function update(Request $request, Environment $environment) : Response
    {
        try {
            $environment->update($request->all());

            return Response($environment, 200);
        } catch (Exception $e) {
            return Response('An error occurred', 404);
        }
    }

    public function destroy(Environment $environment) : Response
    {
        try {
            Environment::destroy($environment->getKey());

            return Response('Environment deleted', 200);
        } catch (Exception $e) {
            return Response('An error occurred', 404);
        }
    }
}

