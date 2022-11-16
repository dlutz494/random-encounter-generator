<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnvironmentRequest;
use App\Models\Environment;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
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
            $environment = new Environment($request->all());
            $environment->save();

            return redirect('environment');
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

    public function update(Request $request, Environment $environment) : Redirector|Application|RedirectResponse
    {
        $environment->update($request->all());

        return redirect('environment');
    }

    public function destroy(Environment $environment) : Redirector|Application|RedirectResponse
    {
        Environment::destroy($environment->getKey());

        return redirect('environment');
    }
}
