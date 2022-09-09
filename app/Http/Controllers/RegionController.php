<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegionResource;
use App\Models\Region;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegionController extends Controller
{
    public function index() : Collection
    {
        return Region::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request) : Response
    {
        return Region::create($request->all());
    }

    public function show(Region $region) : RegionResource
    {
        return Region::findOrFail($region->getKey());
    }

    public function edit(Region $region) : Response
    {
        return new Response();
    }

    public function update(Request $request, Region $region) : Response
    {
        $region = Region::findOrFail($region->getKey());
        $region->update($request->all());

        return $region;
    }

    public function destroy(Region $region) : Response
    {
        return new Response();
    }
}
