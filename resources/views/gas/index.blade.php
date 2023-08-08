@php
    use App\Libs\Helper;
    use App\Libs\GasolineHelper;
@endphp

@extends('layouts.app')

@section('title', 'Мои заправки')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-primary text-white">

                    <div class="card-header">{{ __('Мои заправки') }}</div>

                    <div class="card-body bg-light">

                        <!-- Фильтр -->
                        <div class="mmot-margin20">
                            @include('components/filter/gas')
                        </div>

                        @desktop
                            <table class="table table-bordered admin-table__adapt admin-table__instrument">
                                <thead class="table-secondary">
                                <tr>
                                    <th class="text-start">Дата</th>
                                    <th class="text-center">Автомобиль</th>
                                    <th class="text-center">Станция</th>
                                    <th class="text-center">Пробег</th>
                                    <th class="text-center">Литры</th>
                                    <th class="text-end">Сумма</th>
                                    <th class="text-end">Действия</th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse($gasoline as $gas)
                                    <tr>
                                        <td data-label="Дата" class="text-start"><a class="text-primary" href="{{ route('gas.show', $gas->record_id) }}">{{ date('d.m.Y', $gas->created_at) }}</a></td>
                                        <td data-label="Автомобиль" class="text-center"><a class="text-primary" href="{{ route('car.show', $gas->car->car_id) }}">{{ Helper::carName($gas->car) }}</a></td>
                                        <td data-label="Станция" class="text-center">{{ $gas->gas_station ?? ' - ' }}</td>
                                        <td data-label="Пробег" class="text-center">{{ Helper::mileage($gas->mileage) }}</td>
                                        <td data-label="Литры" class="text-center">{{ Helper::liters($gas->volume) }}</td>
                                        <td data-label="Сумма" class="text-end">{{ Helper::price($gas->price) }}</td>
                                        <td data-label="Действия" class="text-end" style="min-width: 160px">
                                            <form method="post" action="{{ route('gas.destroy', $gas->record_id) }}" class="admin-table__nomargin">
                                                @csrf
                                                @method('DELETE')

                                                <div class="mmot-table__action">
                                                    <a title="Show" href="{{ route('gas.show', $gas->record_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                                    <a title="Update" href="{{ route('gas.edit', $gas->record_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                                    <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить заправку?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('Заправки отсутствуют') }}</div>
                                        </td>
                                    </tr>
                                @endforelse

                                <div>
                                    {{ $gasoline->links() }}
                                </div>

                                </tbody>
                            </table>
                        @elsedesktop
                            <table class="table table-borderless border-top">
                                @forelse($gasoline as $gas)
                                    <tr>
                                        <td class="text-start"><a class="text-primary" href="{{ route('gas.show', $gas->record_id) }}">{{ date('d.m.Y', $gas->created_at) }}</a></td>
                                        <td class="text-end">{{ Helper::mileage($gas->mileage) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start"><a class="text-primary" href="{{ route('car.show', $gas->car->car_id) }}">{{ Helper::carName($gas->car) }}</a></td>
                                        <td class="text-end">{{ Helper::liters($gas->volume) }} на {{ Helper::price($gas->price) }}</td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="text-start">АЗС: {{ $gas->gas_station ?? ' - ' }}</td>
                                        <td class="text-end">
                                            <form method="post" action="{{ route('gas.destroy', $gas->record_id) }}" class="admin-table__nomargin">
                                                @csrf
                                                @method('DELETE')

                                                <div class="mmot-table__action">
                                                    <a title="Show" href="{{ route('gas.show', $gas->record_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                                    <a title="Update" href="{{ route('gas.edit', $gas->record_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                                    <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить заправку?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">
                                            <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('Заправки отсутствуют') }}</div>
                                        </td>
                                    </tr>
                                @endforelse

                                <div>
                                    {{ $gasoline->links() }}
                                </div>

                            </table>
                        @enddesktop

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('gas.create') }}" class="btn btn-primary rounded">Добавить заправку</a>
                        </div>

                        <table class="table table-borderless mt-3">
                            <thead>
                                <tr class="border-bottom">
                                    <th colspan="2" class="bg-primary text-white text-center">Сальдо по заправкам</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom">
                                    <th class="text-start">{{ __('Количество заправок') }}</th>
                                    <td class="text-end">{{ count($gasoline) }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-start">{{ __('Пробег за период') }}</th>
                                    <td class="text-end">{{ Helper::mileage(GasolineHelper::periodMileage($gasoline->toArray()['data'])) }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-start">{{ __('Количество литров') }}</th>
                                    <td class="text-end">{{ Helper::liters(GasolineHelper::periodLiters($gasoline->toArray()['data'])) }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-start">{{ __('Сумма заправок') }}</th>
                                    <td class="text-end">{{ Helper::price(GasolineHelper::periodPrice($gasoline->toArray()['data'])) }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-start">{{ __('Средняя стоимость литра') }}</th>
                                    <td class="text-end">{{ Helper::price(GasolineHelper::avgLiterPrice($gasoline->toArray()['data']), true) }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-start">{{ __('Средняя заправка в л.') }}</th>
                                    <td class="text-end">{{ Helper::liters(GasolineHelper::avgGasLiters($gasoline->toArray()['data'])) }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-start">{{ __('Средняя заправка в р.') }}</th>
                                    <td class="text-end">{{ Helper::price(GasolineHelper::avgGasPrice($gasoline->toArray()['data'])) }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-start">{{ __('Средний расход топлива') }}</th>
                                    <td class="text-end">{{ GasolineHelper::avgLiterToKm($gasoline->toArray()['data']) }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
