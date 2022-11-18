<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnemyRequest;
use App\Http\Requests\UpdateEnemyRequest;
use App\Models\Enemy;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class EnemyController extends Controller
{
    public function index() : Factory|View|Application
    {
        return view('enemy.index', [
            'enemies' => Enemy::all(),
        ]);
    }

    public function create() : View
    {
        return view('enemy.create', [
            'enemies' => Enemy::all(),
        ]);
    }

    public function store(StoreEnemyRequest $request) : Redirector|Application|RedirectResponse
    {
        try {
            $enemy = new Enemy($request->all());
            $enemy->save();

            return redirect('enemy');
        } catch (Exception $e) {
            return redirect('enemy.create', 400);
        }
    }

    public function show(Enemy $enemy) : Factory|View|Application
    {
        return view('enemy.show', [
            'enemy' => $enemy,
        ]);
    }

    public function edit(Enemy $enemy) : Factory|View|Application
    {
        return view('enemy.edit', [
            'enemy' => $enemy,
        ]);
    }

    public function update(UpdateEnemyRequest $request, Enemy $enemy) : Redirector|Application|RedirectResponse
    {
        $enemy->update($request->all());

        return redirect('enemy');
    }

    public function destroy(Enemy $enemy) : Redirector|Application|RedirectResponse
    {
        Enemy::destroy($enemy->getKey());

        return redirect('enemy');
    }
}
