@php
    use Illuminate\Support\Str;
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Мой гараж')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-primary text-white">

                    <div class="card-header">{{ __('Мой гараж') }}</div>

                    <div class="card-body bg-light">

                        <!-- Фильтр -->
                        <div class="mmot-margin20">
                            @include('components/filter/cars')
                        </div>

                        @desktop
                            <table class="table table-bordered admin-table__adapt admin-table__instrument">
                                <thead class="table-secondary">
                                    <tr>
                                        <th class="text-start">Автомобиль</th>
                                        <th class="text-center">Год</th>
                                        <th class="text-center">Объем</th>
                                        <th class="text-center">VIN</th>
                                        <th class="text-start">Описание</th>
                                        <th class="text-end">Действия</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($cars as $car)
                                        <tr>
                                            <td data-label="Марка" class="text-start"><a class="text-primary" href="{{ route('car.show', $car->car_id) }}">{{ Helper::carName($car) }}</a></td>
                                            <td data-label="Год" class="text-center">{{ Helper::year($car->year) }}</td>
                                            <td data-label="Объем" class="text-center">{{ Helper::volume($car->volume) }}</td>
                                            <td data-label="VIN" class="text-center">{{ strtoupper($car->vin ?? ' - ') }}</td>
                                            <td data-label="Описание" class="text-start">{{ Str::limit($car->additional, 30) }}</td>
                                            <td data-label="Действия" class="text-end" style="min-width: 160px">
                                                <form method="post" action="{{ route('car.destroy', $car->car_id) }}" class="admin-table__nomargin">
                                                    @csrf
                                                    @method('DELETE')

                                                    <div class="mmot-table__action">
                                                        <a title="Show" href="{{ route('car.show', $car->car_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                                        <a title="Update" href="{{ route('car.edit', $car->car_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                                        <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить автомобиль?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('Автомобили отсутствуют') }}</div>
                                            </td>
                                        </tr>
                                    @endforelse

                                    <div>
                                        {{ $cars->links() }}
                                    </div>
                                </tbody>
                            </table>
                        @elsedesktop
                            <table class="table table-borderless border-top">
                                @forelse($cars as $car)
                                    <tr>
                                        <td class="text-start"><a class="text-primary" href="{{ route('car.show', $car->car_id) }}">{{ Helper::carName($car) }}</a></td>
                                        <td class="text-end">{{ Helper::year($car->year) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Vin: {{ strtoupper($car->vin ?? ' - ') }}</td>
                                        <td class="text-end">{{ Helper::volume($car->volume) }}</td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="text-start">{{ Str::limit($car->additional, 30) }}</td>
                                        <td class="text-end">
                                            <form method="post" action="{{ route('car.destroy', $car->car_id) }}" class="admin-table__nomargin">
                                                @csrf
                                                @method('DELETE')

                                                <div class="mmot-table__action">
                                                    <a title="Show" href="{{ route('car.show', $car->car_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                                    <a title="Update" href="{{ route('car.edit', $car->car_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                                    <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить автомобиль?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">
                                            <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('Автомобили отсутствуют') }}</div>
                                        </td>
                                    </tr>
                                @endforelse

                                <div>
                                    {{ $cars->links() }}
                                </div>
                            </table>
                        @enddesktop

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('car.create') }}" class="btn btn-primary rounded">Добавить автомобиль</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
