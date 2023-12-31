@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Добавить заметку')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-primary text-white">
                    <div class="card-header">{{ __('Добавить заметку') }}</div>

                    <div class="card-body bg-light">

                        <form method="post" action="{{ route('note.store') }}">
                            @csrf
                            @method('POST')

                            <div class="mb-3">
                                <label for="car_id" class="form-label required">{{ __('Автомобиль') }}</label>
                                <select  class="form-control form-select" id="car_id" name="car_id">
                                    @forelse($cars as $car)
                                        <option title="{{ Helper::carName($car) }}" value="{{ $car['car_id'] }}">{{ Helper::carName($car) }}</option>
                                    @empty
                                        <option title="Нет автомобилей" value="0">Нет автомобилей</option>
                                    @endforelse
                                </select>
                                @error('car_id')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="note_date" class="form-label">{{ __('Дата заметки') }}</label>
                                <input type="date" class="form-control" id="note_date" name="note_date" value="{{ old('note_date') ?? date('Y-m-d', time()) }}" />
                                @error('note_date')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label required">{{ __('Заголовок') }}</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" aria-describedby="titleHelp" />
                                <div id="titleHelp" class="form-text">{{ __('Краткое название') }}</div>
                                @error('title')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="additional" class="form-label required">{{ __('Описание') }}</label>
                                <textarea  cols="10" rows="5" class="form-control" id="additional" name="additional">{{ old('additional') }}</textarea>
                                @error('additional')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="mileage" class="form-label">{{ __('Пробег (км)') }}</label>
                                <input type="text" class="form-control" id="mileage" name="mileage" value="{{ old('mileage') }}" />
                                @error('number')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary me-1 rounded">{{ __('Назад') }}</a>
                                <button type="submit" class="btn btn-primary rounded">{{ __('Добавить') }}</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
