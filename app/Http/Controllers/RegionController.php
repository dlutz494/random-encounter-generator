<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegionResource;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegionController extends Controller
{
    public function index() : void
    {
        //
    }

    public function create() : void
    {
        //
    }

    public function store(Request $request) : Response
    {
        return new Response();
    }

    public function show(Region $region) : Response
    {
        return new Response();
    }

    public function edit(Region $region) : Response
    {
        return new Response();
    }

    public function update(Request $request, Region $region) : Response
    {
        return new Response();
    }

    public function destroy(Region $region) : Response
    {
        return new Response();
    }
}
