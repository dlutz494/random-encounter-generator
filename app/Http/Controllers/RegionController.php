<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegionRequest;
use App\Models\Environment;
use App\Models\Region;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class RegionController extends Controller
{
    public function index() : View
    {
        return view('region.index', [
            'regions'      => Region::all(),
            'environments' => Environment::all(),
        ]);
    }

    public function create() : View
    {
        return view('region.create', [
            'environments' => Environment::all(),
        ]);
    }

    public function store(StoreRegionRequest $request) : Redirector|Application|RedirectResponse
    {
        try {
            $region = new Region($request->all());
            $region->save();

            return redirect('region');
        } catch (Exception $e) {
            return redirect('region.create', 400);
        }
    }

    public function show(Region $region) : View
    {
        $environment = Environment::find($region->environment);

        return view('region.show', [
            'region'      => $region,
            'environment' => $environment,
        ]);
    }

    public function edit(Region $region) : View
    {
        return view('region.edit', [
            'region'       => $region,
            'environments' => Environment::all(),
        ]);
    }

    public function update(Request $request, Region $region) : Redirector|Application|RedirectResponse
    {
        $region->update($request->all());

        return redirect('region');
    }

    public function destroy(Region $region) : Redirector|Application|RedirectResponse
    {
        Region::destroy($region->getKey());

        return redirect('region');
    }
}
