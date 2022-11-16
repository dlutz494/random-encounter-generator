<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegionRequest;
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
            'regions' => Region::all(),
        ]);
    }

    public function create() : View
    {
        return view('region.create');
    }

    public function store(StoreRegionRequest $request) : Redirector|Application|RedirectResponse
    {
        try {
            $environment = new Region($request->all());
            $environment->save();

            return redirect('region');
        } catch (Exception $e) {
            return redirect('region.create', 400);
        }
    }

    public function show(Region $environment) : View
    {
        return view('region.show', [
            'region' => $environment,
        ]);
    }

    public function edit(Region $environment) : View
    {
        return view('region.edit', [
            'region' => $environment,
        ]);
    }

    public function update(Request $request, Region $environment) : Redirector|Application|RedirectResponse
    {
        $environment->update($request->all());

        return redirect('region');
    }

    public function destroy(Region $environment) : Redirector|Application|RedirectResponse
    {
        Region::destroy($environment->getKey());

        return redirect('region');
    }
}
