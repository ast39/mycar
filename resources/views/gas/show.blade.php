@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Заправка')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-primary text-white">

                    <div class="card-header">{{ __('Заправка') }}</div>

                    <div class="card-body bg-light">

                        <table class="table  table-borderless">
                            <tbody>
                                <tr class="border-bottom">
                                    <th class="text-start">{{ __('Дата заправки') }}</th>
                                    <td class="text-end">{{ date('d.m.Y', $gas->created_at) }}</a></td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-start">{{ __('Автомобиль') }}</th>
                                    <td class="text-end"><a class="text-primary" href="{{ route('car.show', $gas->car_id) }}">{{ Helper::carName($gas->car) }}</a></td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-start">{{ __('Название АЗС') }}</th>
                                    <td class="text-end">{{ $gas->gas_station ?? ' - ' }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-start">{{ __('Пробег') }}</th>
                                    <td class="text-end">{{ Helper::mileage($gas->mileage) }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-start">{{ __('Литраж') }}</th>
                                    <td class="text-end">{{ Helper::liters($gas->volume) }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-start">{{ __('Стоимость') }}</th>
                                    <td class="text-end">{{ Helper::price($gas->price) }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-start">{{ __('Описание') }}</th>
                                    <td class="text-end">{{ $gas->additional ?? ' - ' }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <form method="post" action="{{ route('gas.destroy', $gas->record_id) }}">
                            @csrf
                            @method('DELETE')

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="{{ route('gas.index') }}" class="btn btn-secondary me-1 rounded">Назад</a>
                                <a href="{{ route('gas.edit', $gas->record_id) }}" class="btn btn-warning me-1 rounded">Изменить</a>
                                <button type="submit" title="Delete" onclick="return confirm('Вы уверены, что хотите удалить заправку?')" class="btn btn-danger me-1 rounded">Удалить</button>
                                <a href="{{ route('gas.create') }}" class="btn btn-primary rounded">Добавить заправку</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
