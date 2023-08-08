@php
    use App\Libs\Helper;
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('title', 'Мой блокнот')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-primary text-white">

                    <div class="card-header">{{ __('Мой блокнот') }}</div>

                    <div class="card-body bg-light">
                        <!-- Фильтр -->
                        <div class="mmot-margin20">
                            @include('components/filter/notes')
                        </div>

                        @desktop
                            <table class="table table-bordered admin-table__adapt admin-table__instrument">
                                <thead class="table-secondary">
                                <tr>
                                    <th class="text-start">Дата</th>
                                    <th class="text-center">Автомобиль</th>
                                    <th class="text-start">Заголовок</th>
                                    <th class="text-start">Описание</th>
                                    <th class="text-center">Пробег</th>
                                    <th class="text-end">Действия</th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse($notes as $note)
                                    <tr>
                                        <td data-label="Дата" class="text-start">{{ date('d.m.Y', $note->created_at) }}</td>
                                        <td data-label="Автомобиль" class="text-center"><a class="text-primary" href="{{ route('car.show', $note->car->car_id) }}">{{ Helper::carName($note->car) }}</a></td>
                                        <td data-label="Заголовок" class="text-start"><a class="text-primary" href="{{ route('note.show', $note->note_id) }}">{{ Str::limit($note->title, 30) }}</a></td>
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
                                        <td colspan="6">
                                            <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('Заметки отсутствуют') }}</div>
                                        </td>
                                    </tr>
                                @endforelse

                                <div>
                                    {{ $notes->links() }}
                                </div>

                                </tbody>
                            </table>
                        @elsedesktop
                            <table class="table table-borderless border-top">
                                @forelse($notes as $note)
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

                                <div>
                                    {{ $notes->links() }}
                                </div>
                            </table>
                        @enddesktop

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('note.create') }}" class="btn btn-primary rounded">Добавить заметку</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
