@php
    use App\Libs\Helper;
    use App\Enums\WorkStatusEnum;
@endphp

@extends('layouts.app')

@section('title', 'Редактирование записи о работах')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-primary text-white">
                    <div class="card-header">{{ __('Редактирование записи о работах') }}</div>

                    <div class="card-body bg-light">

                        <form method="post" action="{{ route('service.update', $work->record_id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="car_id" class="form-label required">{{ __('Автомобиль') }}</label>
                                <select  class="form-control form-select" id="car_id" name="car_id">
                                    @forelse($cars as $car)
                                        <option title="{{ Helper::carName($car) }}" {{ $work->car_id == $car['car_id'] ? 'selected' : '' }} value="{{ $car['car_id'] }}">{{ Helper::carName($car) }}</option>
                                    @empty
                                        <option title="Нет автомобилей" value="0">Нет автомобилей</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label required">{{ __('Статус') }}</label>
                                <select  class="form-control form-select" id="status" name="status">
                                    <option title="{{ Helper::statusText(WorkStatusEnum::Planned->value) }}" {{ $work->status == WorkStatusEnum::Planned->value ? 'selected' : '' }} value="{{ WorkStatusEnum::Planned->value }}">{{ Helper::statusText(WorkStatusEnum::Planned->value) }}</option>
                                    <option title="{{ Helper::statusText(WorkStatusEnum::InWork->value) }}" {{ $work->status == WorkStatusEnum::InWork->value ? 'selected' : '' }} value="{{ WorkStatusEnum::InWork->value }}">{{ Helper::statusText(WorkStatusEnum::InWork->value) }}</option>
                                    <option title="{{ Helper::statusText(WorkStatusEnum::Completed->value) }}" {{ $work->status == WorkStatusEnum::Completed->value ? 'selected' : '' }} value="{{ WorkStatusEnum::Completed->value }}">{{ Helper::statusText(WorkStatusEnum::Completed->value) }}</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label required">{{ __('Заголовок') }}</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $work->title ?? '' }}" />
                            </div>

                            <div class="mb-3">
                                <label for="work_list" class="form-label">{{ __('Описание работ') }}</label>
                                <textarea  cols="10" rows="5" class="form-control" id="work_list" name="work_list">{{ $work->work_list ?? '' }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="service_title" class="form-label">{{ __('Название сервиса') }}</label>
                                <input type="text" class="form-control" id="service_title" name="service_title" value="{{ $work->service_title ?? '' }}" />
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">{{ __('Цена') }}</label>
                                <input type="text" class="form-control" id="price" name="price" value="{{ $work->price ?? '' }}" />
                            </div>

                            <div class="mb-3">
                                <label for="mileage" class="form-label">{{ __('Пробег') }}</label>
                                <input type="text" class="form-control" id="mileage" name="mileage" value="{{ $work->mileage ?? '' }}" />
                            </div>

                            <div class="mb-3">
                                <label for="service_date" class="form-label">{{ __('Дата ремонта') }}</label>
                                <input type="date" class="form-control" id="service_date" name="service_date" value="{{ date('Y-m-d', $work->created_at) }}" />
                            </div>

                            <div class="mb-3">
                                <label for="additional" class="form-label">{{ __('Комментарии') }}</label>
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
