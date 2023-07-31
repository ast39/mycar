<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\ClientUpdateRequest;
use App\Http\Traits\Dictionarable;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class Clients extends Controller {

    use Dictionarable;


    /**
     * Мой профиль
     *
     * @return View
     */
    public function index(): View
    {
        $client = User::with(['cars'])
            ->findOrFail(Auth::id());

        return view('client.show', [
            'client' => $client,
        ]);
    }

    /**
     * Страница редактирования клиента
     *
     * @return View
     */
    public function edit(): View
    {
        $client = User::findOrFail(Auth::id());

        return view('client.edit', [
            'client' => $client,
        ]);
    }

    /**
     * Обновление данных о клиенте
     *
     * @param ClientUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(ClientUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $client = User::find(Auth::id());

        if (is_null($client)) {
            return back()->withErrors(['action' => 'Клиент не найден']);
        }

        if ($client->id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя изменять чужой профиль']);
        }

        $client->update($data);

        return redirect()->route('client.index');
    }
}
