@php
    use Illuminate\Support\Str;
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Моя история обслуживания')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-primary text-white">

                    <div class="card-header">{{ __('Моя история обслуживания') }}</div>

                    <div class="card-body bg-light">

                        <!-- Фильтр -->
                        <div class="mmot-margin20">
                            @include('components/filter/service')
                        </div>

                        @desktop
                            <table class="table table-bordered admin-table__adapt admin-table__instrument">
                                <thead class="table-secondary">
                                    <tr>
                                        <th class="text-start">Дата</th>
                                        <th class="text-start">Название</th>
                                        <th class="text-center">Автомобиль</th>
                                        <th class="text-center">Пробег</th>
                                        <th class="text-center">Статус</th>
                                        <th class="text-end">Действия</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($works as $work)
                                        <tr>
                                            <td data-label="Дата" class="text-start">{{ date('d.m.Y', $work->created_at) }}</td>
                                            <td data-label="Название" class="text-start"><a class="text-primary" href="{{ route('service.show', $work->record_id) }}">{{ Str::limit($work->title, 30) }}</a></td>
                                            <td data-label="Автомобиль" class="text-center"><a class="text-primary" href="{{ route('car.show', $work->car->car_id) }}">{{ Helper::carName($work->car) }}</a></td>
                                            <td data-label="Пробег" class="text-center">{{ Helper::mileage($work->mileage) }}</td>
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
                                                <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('История обслуживания отсутствует') }}</div>
                                            </td>
                                        </tr>
                                    @endforelse

                                    <div>
                                        {{ $works->links() }}
                                    </div>
                                </tbody>
                            </table>
                        @elsedesktop
                            <table class="table table-borderless border-top">
                                @forelse($works as $work)
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

                                <div>
                                    {{ $works->links() }}
                                </div>

                            </table>
                        @enddesktop

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('service.create') }}" class="btn btn-primary rounded">Добавить запись обслуживания</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
