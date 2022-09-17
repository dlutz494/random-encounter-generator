<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegionResource;
use App\Models\Region;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegionController extends Controller
{
    public function index() : Collection
    {
        return Region::all();
    }

    public function store(Request $request) : Response
    {
        try {
            Region::create($request->all());

            return Response('Region stored successfully', 200);
        } catch (Exception $e) {
            return Response('An error occurred', 404);
        }
    }

    public function create() : Response
    {
        return Response('Empty Route', 200);
    }

    public function show(Region $region) : RegionResource
    {
        return RegionResource::make(Region::findOrFail($region->getKey()));
    }

    public function edit(Region $region) : Response
    {
        return Response($region, 200);
    }

    public function update(Request $request, Region $region) : Response
    {
        try {
            $region->update($request->all());

            return Response($region, 200);
        } catch (Exception $e) {
            return Response('An error occurred', 404);
        }
    }

    public function destroy(Region $region) : Response
    {
        try {
            Region::destroy($region->getKey());

            return Response('Region deleted', 200);
        } catch (Exception $e) {
            return Response('An error occurred', 404);
        }
    }
}
