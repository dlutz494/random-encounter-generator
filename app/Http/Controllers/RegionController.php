<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Http\Resources\RegionResource;
use App\Models\Region;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class RegionController extends Controller
{
    public function index() : Collection
    {
        return Region::all();
    }

    public function store(StoreRegionRequest $request) : Response
    {
        try {
            Region::create($request->all());

            return Response('Region stored successfully', 200);
        } catch (ValidationException $e) {
            return Response($e->getMessage());
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
        return RegionResource::make($region);
    }

    public function edit(Region $region) : Response
    {
        return Response($region, 200);
    }

    public function update(UpdateRegionRequest $request, Region $region) : Response
    {
        try {
            $region->update($request->all());

            return Response($region, 200);
        } catch (ValidationException $e) {
            return Response($e->getMessage());
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
