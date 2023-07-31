@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Карточка автомобиля')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">{{ __('Карточка автомобиля') }}</div>

                    <div class="card-body">

                        <table class="table table-striped table-borderless">
                            <tbody>
                            <tr>
                                <th scope="row">{{ __('Производитель') }}</th>
                                <td>{{ $car->mark->title }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Модель') }}</th>
                                <td>{{ $car->model }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Год выпуска') }}</th>
                                <td>{{ $car->year }} г.</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Объем') }}</th>
                                <td>{{ Helper::volume($car->volume) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Гос номер') }}</th>
                                <td>{{ strtolower($car->number ?: ' - ') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Vin номер') }}</th>
                                <td>{{ $car->vin ?: ' - ' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Описание автомобиля') }}</th>
                                <td>{{ $car->additional ?: ' - ' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Дата регистрации') }}</th>
                                <td>{{ date('d.m.Y', $car->created_at) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Последний зафиксированный пробег') }}</th>
                                <td>{{ Helper::mileage($car->max_mileage) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Пробег во владении') }}</th>
                                <td>{{ Helper::mileage($car->car_mileage) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Визитов на сервис') }}</th>
                                <td>{{ $car->visits }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Оставлено в кассе') }}</th>
                                <td>{{ Helper::price($car->cashed) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Стоимость обслуживания за 1км') }}</th>
                                <td>{{ Helper::price($car->km_price, true) }}</td>
                            </tr>
                            </tbody>
                        </table>

                        <form method="post" action="{{ route('car.destroy', $car->car_id) }}">
                            @csrf
                            @method('DELETE')

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="{{ route('car.index') }}" class="btn btn-secondary me-1 rounded">Назад</a>
                                <a href="{{ route('car.edit', $car->car_id) }}" class="btn btn-warning me-1 rounded">Изменить</a>
                                <button type="submit" title="Delete" onclick="return confirm('Вы уверены, что хотите удалить автомобиль?')" class="btn btn-danger rounded">Удалить</button>
                                <a href="{{ route('service.create', ['car' => $car->car_id]) }}" class="btn btn-primary">{{ __('Добавить ТО') }}</a>
                            </div>

                        </form>

                        {{-- История обслуживания автомобиля --}}
                        <div class="accordion">
                            <div class="accordion-item mt-3 border-0">
                                <h2 class="accordion-header shadow-sm" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                        {{ __('История обслуживания') }}
                                    </button>
                                </h2>

                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body p-0">
                                        <table class="table table-bordered admin-table__adapt admin-table__instrument">
                                            <thead class="table-secondary">
                                            <tr>
                                                <th class="text-start">Дата</th>
                                                <th class="text-start">Название</th>
                                                <th class="text-start">Сервис</th>
                                                <th class="text-end">Пробег</th>
                                                <th class="text-center">Статус</th>
                                                <th class="text-end">Действия</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @forelse($car->works as $work)
                                                <tr>
                                                    <td data-label="Дата" class="text-start">{{ date('d.m.Y', $work->created_at) }}</td>
                                                    <td data-label="Название" class="text-start"><a class="text-primary" href="{{ route('service.show', $work->record_id) }}">{{ Str::limit($work->title, 30) }}</a></td>
                                                    <td data-label="Сервис" class="text-left">{{ $work->service_title ?: ' - ' }}</td>
                                                    <td data-label="Пробег" class="text-end">{{ Helper::mileage($work->mileage) }}</td>
                                                    <td data-label="Статус" class="text-center">{{ Helper::statusText($work->status) }}</td>
                                                    <td data-label="Действия" class="text-end" style="min-width: 160px">
                                                        <form method="post" action="{{ route('service.destroy', $work->record_id) }}" class="admin-table__nomargin">
                                                            @csrf
                                                            @method('DELETE')

                                                            <div class="mmot-table__action">
                                                                <a title="Show" href="{{ route('service.show', $work->record_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                                                <a title="Update" href="{{ route('service.edit', $work->record_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                                                <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить запись?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('Список работ пуст') }}</div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Запчасти на автомобиль --}}
                        <div class="accordion">
                            <div class="accordion-item mt-3 border-0">
                                <h2 class="accordion-header shadow-sm" id="panelsStayOpen-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                        {{ __('Запчасти') }}
                                    </button>
                                </h2>

                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                    <div class="accordion-body p-0">
                                        <table class="table table-bordered admin-table__adapt admin-table__instrument">
                                            <thead class="table-secondary">
                                            <tr>
                                                <th class="text-start">Заголовок</th>
                                                <th class="text-center">Артикул</th>
                                                <th class="text-end">Цена</th>
                                                <th class="text-end">Действия</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @forelse($car->catalog as $article)
                                                <tr>
                                                    <td data-label="Заголовок" class="text-start"><a class="text-primary" href="{{ route('article.show', $article->article_id) }}">{{ Str::limit($article->title, 30) }}</a></td>
                                                    <td data-label="Артикул" class="text-center"><a class="text-primary" target="_blank" href="https://zap39.ru/price_items/search?oem={{ $article->article }}">{{ $article->article ?: ' - ' }}</a></td>
                                                    <td data-label="Цена" class="text-end">{{ Helper::price($article->price) }}</td>
                                                    <td data-label="Действия" class="text-end" style="min-width: 160px">
                                                        <form method="post" action="{{ route('article.destroy', $work->record_id) }}" class="admin-table__nomargin">
                                                            @csrf
                                                            @method('DELETE')

                                                            <div class="mmot-table__action">
                                                                <a title="Show" href="{{ route('service.show', $work->record_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                                                <a title="Update" href="{{ route('service.edit', $work->record_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                                                <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить запчасть?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('Запчасти отсутствуют') }}</div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Заметки об автомобиле --}}
                        <div class="accordion">
                            <div class="accordion-item mt-3 border-0">
                                <h2 class="accordion-header shadow-sm" id="panelsStayOpen-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                        {{ __('Заметки') }}
                                    </button>
                                </h2>

                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                    <div class="accordion-body p-0">
                                        <table class="table table-bordered admin-table__adapt admin-table__instrument">
                                            <thead class="table-secondary">
                                            <tr>
                                                <th class="text-start">Дата</th>
                                                <th class="text-start">Заголовок</th>
                                                <th class="text-start">Описание</th>
                                                <th class="text-center">Пробег</th>
                                                <th class="text-end">Действия</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @forelse($car->notes as $note)
                                                <tr>
                                                    <td data-label="Дата" class="text-start">{{ date('d.m.Y', $note->created_at) }}</td>
                                                    <td data-label="Заголовок" class="text-start"><a class="text-primary" href="{{ route('article.show', $note->note_id) }}">{{ Str::limit($note->title, 30) }}</a></td>
                                                    <td data-label="Описание" class="text-start">{{ Str::limit($note->additional, 50) }}</td>
                                                    <td data-label="Пробег" class="text-center">{{ Helper::mileage($note->mileage) }}</td>
                                                    <td data-label="Действия" class="text-end" style="min-width: 160px">
                                                        <form method="post" action="{{ route('note.destroy', $note->note_id) }}" class="admin-table__nomargin">
                                                            @csrf
                                                            @method('DELETE')

                                                            <div class="mmot-table__action">
                                                                <a title="Show" href="{{ route('note.show', $note->note_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                                                <a title="Update" href="{{ route('note.edit', $note->note_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                                                <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить заметку?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">
                                                        <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('Заметки отсутствуют') }}</div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    {{-- Ошибки если есть --}}
                    @if(count($errors) > 0)
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
