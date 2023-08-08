@php

@endphp

@extends('layouts.app')

@section('title', 'Карточка клиента')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-primary text-white">

                    <div class="card-header">{{ __('Карточка клиента') }}</div>

                    <div class="card-body bg-light">

                        <table class="table table-borderless">
                            <tbody>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Имя') }}</th>
                                <td class="text-end">{{ $client->name }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Логин') }}</th>
                                <td class="text-end">{{ $client->email }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Дата регистрации') }}</th>
                                <td class="text-end">{{ date('d.m.Y', $client->created_at) }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Автомобилей в гараже') }}</th>
                                <td class="text-end">{{ count($client->cars ?: []) }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Визитов на сервис') }}</th>
                                <td class="text-end">{{ $client->visits }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="text-start">{{ __('Оставлено в кассе') }}</th>
                                <td class="text-end">{{ number_format($client->cashed, 0, '.', ' ') }} р.</td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('client.edit') }}" class="btn btn-warning rounded">Изменить</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
