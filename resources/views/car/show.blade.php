@php
    use App\Libs\Helper;
    use App\Libs\GasolineHelper;
@endphp

@extends('layouts.app')

@section('title', 'Карточка автомобиля')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-primary text-white">

                    <div class="card-header">{{ __('Карточка автомобиля') }}</div>

                    <div class="card-body bg-light">

                        <table class="table table-borderless">
                            <tbody>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Модель') }}</th>
                                <td class="text-end">{{ Helper::carName($car) }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Год выпуска') }}</th>
                                <td class="text-end">{{ $car->year }} г.</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Объем') }}</th>
                                <td class="text-end">{{ Helper::volume($car->volume) }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Гос номер') }}</th>
                                <td class="text-end">{{ strtolower($car->number ?: ' - ') }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Vin номер') }}</th>
                                <td class="text-end">{{ $car->vin ?: ' - ' }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Описание автомобиля') }}</th>
                                <td class="text-end">{{ $car->additional ?: ' - ' }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Последний зафиксированный пробег') }}</th>
                                <td class="text-end">{{ Helper::mileage($car->max_mileage) }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Пробег во владении') }}</th>
                                <td class="text-end">{{ Helper::mileage($car->car_mileage) }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Потрачено на ремонт') }}</th>
                                <td class="text-end">{{ Helper::price($car->service_expensed) }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Потрачено на топливо') }}</th>
                                <td class="text-end">{{ Helper::price($car->fuel_expensed) }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Стоимость 1км') }}</th>
                                <td class="text-end">{{ Helper::price($car->km_price, true) }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Расход топлива') }}</th>
                                <td class="text-end">{{ GasolineHelper::avgLiterToKm($car->fuel_expenses) }}</td>
                            </tr>
                            </tbody>
                        </table>

                        <form method="post" action="{{ route('car.destroy', $car->car_id) }}">
                            @csrf
                            @method('DELETE')

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="{{ route('car.index') }}" class="btn btn-secondary me-1 rounded">Назад</a>
                                <a href="{{ route('car.edit', $car->car_id) }}" class="btn btn-warning me-1 rounded">Изменить</a>
                                <button type="submit" title="Delete" onclick="return confirm('Вы уверены, что хотите удалить автомобиль?')" class="btn btn-danger me-1 rounded">Удалить</button>
                                <a href="{{ route('car.create') }}" class="btn btn-primary rounded">Добавить автомобиль</a>
                            </div>
                        </form>

                        <ul class="nav nav-tabs nav-fill mt-3" id="myTab" role="tablist">

                            <li class="nav-item text-primary role="presentation">
                                <button class="nav-link active" id="service-tab" data-bs-toggle="tab" data-bs-target="#service" type="button" role="tab" aria-controls="service" aria-selected="true"><i class="bi bi-tools"></i></button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="articles-tab" data-bs-toggle="tab" data-bs-target="#articles" type="button" role="tab" aria-controls="articles" aria-selected="false"><i class="bi bi-cart2"></i></button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="fuels-tab" data-bs-toggle="tab" data-bs-target="#fuels" type="button" role="tab" aria-controls="fuels" aria-selected="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fuel-pump" viewBox="0 0 16 16">
                                        <path d="M3 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-5Z"/>
                                        <path d="M1 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v8a2 2 0 0 1 2 2v.5a.5.5 0 0 0 1 0V8h-.5a.5.5 0 0 1-.5-.5V4.375a.5.5 0 0 1 .5-.5h1.495c-.011-.476-.053-.894-.201-1.222a.97.97 0 0 0-.394-.458c-.184-.11-.464-.195-.9-.195a.5.5 0 0 1 0-1c.564 0 1.034.11 1.412.336.383.228.634.551.794.907.295.655.294 1.465.294 2.081v3.175a.5.5 0 0 1-.5.501H15v4.5a1.5 1.5 0 0 1-3 0V12a1 1 0 0 0-1-1v4h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V2Zm9 0a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v13h8V2Z"/>
                                    </svg>
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notes" type="button" role="tab" aria-controls="notes" aria-selected="false"><i class="bi bi-journal-bookmark-fill"></i></button>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="service" role="tabpanel" aria-labelledby="service-tab">
                                @desktop
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
                                @elsedesktop
                                    <table class="table table-borderless border-top">
                                        @forelse($car->works as $work)
                                            <tr>
                                                <td colspan="2" class="text-start"><a class="text-primary" href="{{ route('service.show', $work->record_id) }}">{{ Str::limit($work->title, 30) }}</a></td>
                                            </tr>
                                            <tr>
                                                <td class="text-start">{{ date('d.m.Y', $work->created_at) }}</td>
                                                <td class="text-end">{{ Helper::mileage($work->mileage) }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="text-start"><a class="text-primary" href="{{ route('car.show', $work->car->car_id) }}">{{ Helper::carName($work->car) }}</a></td>
                                                <td class="text-end">
                                                    <form method="post" action="{{ route('gas.destroy', $work->record_id) }}" class="admin-table__nomargin">
                                                        @csrf
                                                        @method('DELETE')

                                                        <div class="mmot-table__action">
                                                            <a title="Show" href="{{ route('gas.show', $work->record_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                                            <a title="Update" href="{{ route('gas.edit', $work->record_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                                            <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить запись?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">
                                                    <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('История обслуживания отсутствуют') }}</div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </table>
                                @enddesktop

                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <a href="{{ route('service.create', ['car' => $car->car_id]) }}" class="btn btn-primary btn-sm">{{ __('Добавить ТО') }}</a>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="articles" role="tabpanel" aria-labelledby="articles-tab">
                                @desktop
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
                                @elsedesktop
                                    <table class="table table-borderless border-top">
                                        @forelse($car->catalog as $article)
                                            <tr>
                                                <td colspan="2" class="text-start"><a class="text-primary" href="{{ route('article.show', $article->article_id) }}">{{ $article->title }}</a></td>
                                            </tr>
                                            <tr>
                                                <td class="text-start"><a class="text-primary" target="_blank" href="https://zap39.ru/price_items/search?oem={{ $article->article }}">{{ $article->article }}</a></td>
                                                <td class="text-end">{{ Helper::price($article->price) }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="text-start"><a class="text-primary" href="{{ route('car.show', $article->car_id) }}">{{ Helper::carName($article->car) }}</a></td>
                                                <td class="text-end">
                                                    <form method="post" action="{{ route('gas.destroy', $article->article_id) }}" class="admin-table__nomargin">
                                                        @csrf
                                                        @method('DELETE')

                                                        <div class="mmot-table__action">
                                                            <a title="Show" href="{{ route('article.show', $article->article_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                                            <a title="Update" href="{{ route('article.edit', $article->article_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                                            <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить запчасть?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">
                                                    <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('Запчасти отсутствуют') }}</div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </table>
                                @enddesktop

                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <a href="{{ route('article.create', ['car' => $car->car_id]) }}" class="btn btn-primary btn-sm">{{ __('Добавить запчасть') }}</a>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="fuels" role="tabpanel" aria-labelledby="fuels-tab">
                                @desktop
                                    <table class="table table-bordered admin-table__adapt admin-table__instrument">
                                        <thead class="table-secondary">
                                        <tr>
                                            <th class="text-start">Дата</th>
                                            <th class="text-center">Станция</th>
                                            <th class="text-center">Пробег</th>
                                            <th class="text-center">Литры</th>
                                            <th class="text-end">Сумма</th>
                                            <th class="text-end">Действия</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @forelse($car->gasoline as $gas)
                                            <tr>
                                                <td data-label="Дата" class="text-start"><a class="text-primary" href="{{ route('gas.show', $gas->record_id) }}">{{ date('d.m.Y', $gas->created_at) }}</a></td>
                                                <td data-label="Станция" class="text-center">{{ $gas->gas_station ?? ' - ' }}</a></td>
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
                                                <td colspan="6">
                                                    <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('Заправки отсутствуют') }}</div>
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                @elsedesktop
                                    <table class="table table-borderless border-top">
                                        @forelse($car->gasoline as $gas)
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
                                    </table>
                                @enddesktop

                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <a href="{{ route('gas.create', ['car' => $car->car_id]) }}" class="btn btn-primary btn-sm">{{ __('Добавить заправку') }}</a>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                                @desktop
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
                                @elsedesktop
                                    <table class="table table-borderless border-top">
                                        @forelse($car->notes as $note)
                                            <tr>
                                                <td colspan="2" class="text-start"><a class="text-primary" href="{{ route('note.show', $note->note_id) }}">{{ Str::limit($note->title, 30) }}</a></td>
                                            </tr>
                                            <tr>
                                                <td class="text-start">{{ date('d.m.Y', $note->created_at) }}</td>
                                                <td class="text-end"><a class="text-primary" href="{{ route('car.show', $note->car->car_id) }}">{{ Helper::carName($note->car) }}</a></td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="text-start">{{ Helper::mileage($note->mileage) }}</td>
                                                <td class="text-end">
                                                    <form method="post" action="{{ route('gas.destroy', $note->note_id) }}" class="admin-table__nomargin">
                                                        @csrf
                                                        @method('DELETE')

                                                        <div class="mmot-table__action">
                                                            <a title="Show" href="{{ route('gas.show', $note->note_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                                            <a title="Update" href="{{ route('gas.edit', $note->note_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                                            <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить заметку?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">
                                                    <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('Заметки отсутствуют') }}</div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </table>
                                @enddesktop

                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <a href="{{ route('note.create', ['car' => $car->car_id]) }}" class="btn btn-primary btn-sm">{{ __('Добавить заметку') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
