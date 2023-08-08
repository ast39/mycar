<?php

namespace App\Http\Controllers;

use App\Http\Filters\CarFilter;
use App\Http\Requests\Car\CarFilterRequest;
use App\Http\Requests\Car\CarStoreRequest;
use App\Http\Requests\Car\CarUpdateRequest;
use App\Http\Traits\Dictionarable;
use App\Libs\Helper;
use App\Models\Car;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Cars extends Controller {

    use Dictionarable;


    /**
     * Список авто
     *
     * @param CarFilterRequest $request
     * @return View
     * @throws BindingResolutionException
     */
    public function index(CarFilterRequest $request): View
    {
        $data = $request->validated();

        $filter = app()->make(CarFilter::class, [
            'queryParams' => array_filter($data)
        ]);

        return view('car.index', [
            'cars' => Car::filter($filter)
                ->where('owner_id', Auth::id())
                ->orderByDesc('created_at')
                ->paginate(config('limits.cars')),
            'marks' => $this->marks(),
        ]);
    }

    /**
     * Форма добавления авто
     *
     * @return View
     */
    public function create(): View
    {
        return view('car.create', [
            'marks' => $this->marks(),
        ]);
    }

    /**
     * Сохранение нового авто
     *
     * @param CarStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CarStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['owner_id'] = Auth::id();

        return redirect()->route('car.show', Car::create($data)->car_id);
    }

    /**
     * Страница авто
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $car = Car::with(['owner', 'works', 'catalog', 'gasoline', 'notes'])
            ->where('owner_id', Auth::id())
            ->findOrFail($id);

        return view('car.show', [
            'car' => $car,
        ]);
    }

    /**
     * Страница редактирования авто
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $car = Car::where('owner_id', Auth::id())
            ->where('owner_id', Auth::id())
            ->findOrFail($id);

        return view('car.edit', [
            'car'   => $car,
            'marks' => $this->marks(),
        ]);
    }

    /**
     * Обновление данных об авто
     *
     * @param CarUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CarUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

        $car = Car::find($id);

        if (is_null($car)) {
            return back()->withErrors(['action' => 'Автомобиль не найден']);
        }

        if ($car->owner_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя изменять чужой автомобиль']);
        }

        $car->update($data);

        return redirect()->route('car.show', $id);
    }

    /**
     * Удаление авто
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $car = Car::find($id);

        if (is_null($car)) {
            return back()->withErrors(['action' => 'Автомобиль не найден']);
        }

        if ($car->owner_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя удалять чужой автомобиль']);
        }

        $car->delete();

        return redirect()->route('car.index');
    }
}
