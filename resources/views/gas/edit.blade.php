@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Редактирование заправки')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-primary text-white">
                    <div class="card-header">{{ __('Редактирование заправки') }}</div>

                    <div class="card-body bg-light">

                        <form method="post" action="{{ route('gas.update', $gas->record_id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="car_id" class="form-label required">{{ __('Автомобиль') }}</label>
                                <select  class="form-control form-select" id="car_id" name="car_id">
                                    @forelse($cars as $car)
                                        <option {{ $car['car_id'] == $gas->car_id ? 'selected' : '' }} title="{{ Helper::carName($car) }}" value="{{ $car['car_id'] }}">{{ Helper::carName($car) }}</option>
                                    @empty
                                        <option title="Нет автомобилей" value="0">Нет автомобилей</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="gas_date" class="form-label">{{ __('Дата заправки') }}</label>
                                <input type="date" class="form-control" id="gas_date" name="gas_date" value="{{ date('Y-m-d', $gas->created_at ?? time()) }}" />
                            </div>

                            <div class="mb-3">
                                <label for="mileage" class="form-label required">{{ __('Пробег (км)') }}</label>
                                <input type="text" class="form-control" id="mileage" name="mileage" value="{{ $gas->mileage ?? '' }}" />
                            </div>

                            <div class="mb-3">
                                <label for="volume" class="form-label required">{{ __('Литры') }}</label>
                                <input type="text" class="form-control" id="volume" name="volume" value="{{ $gas->volume ?? '' }}" />
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label required">{{ __('Стоимость') }}</label>
                                <input type="text" class="form-control" id="price" name="price" value="{{ $gas->price ?? '' }}" />
                            </div>

                            <div class="mb-3">
                                <label for="gas_station" class="form-label">{{ __('Станция') }}</label>
                                <input type="text" class="form-control" id="gas_station" name="gas_station" value="{{ $gas->gas_station ?? ''  }}" />
                            </div>

                            <div class="mb-3">
                                <label for="additional" class="form-label">{{ __('Примечание') }}</label>
                                <textarea  cols="10" rows="5" class="form-control" id="additional" name="additional">{{ old('additional') }}</textarea>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary me-1 rounded">{{ __('Назад') }}</a>
                                <button type="submit" class="btn btn-primary rounded">{{ __('Сохранить') }}</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
