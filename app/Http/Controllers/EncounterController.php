<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEncounterRequest;
use App\Http\Requests\UpdateEncounterRequest;
use App\Models\Encounter;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class EncounterController extends Controller
{
    public function index() : Factory|View|Application
    {
        return view('encounter.index', [
            'enemies' => Encounter::all(),
        ]);
    }

    public function create() : View
    {
        return view('encounter.create', [
            'enemies' => Encounter::all(),
        ]);
    }

    public function store(StoreEncounterRequest $request) : Redirector|Application|RedirectResponse
    {
        try {
            $encounter = new Encounter($request->all());
            $encounter->save();

            return redirect('encounter');
        } catch (Exception $e) {
            return redirect('encounter.create', 400);
        }
    }

    public function show(Encounter $encounter) : Factory|View|Application
    {
        return view('encounter.show', [
            'encounter' => $encounter,
        ]);
    }

    public function edit(Encounter $encounter) : Factory|View|Application
    {
        return view('encounter.edit', [
            'encounter' => $encounter,
        ]);
    }

    public function update(UpdateEncounterRequest $request, Encounter $encounter) : Redirector|Application|RedirectResponse
    {
        $encounter->update($request->all());

        return redirect('encounter');
    }

    public function destroy(Encounter $encounter) : Redirector|Application|RedirectResponse
    {
        Encounter::destroy($encounter->getKey());

        return redirect('encounter');
    }
}
