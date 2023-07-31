@php

@endphp

@extends('layouts.app')

@section('title', 'Карточка клиента')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">{{ __('Карточка клиента') }}</div>

                    <div class="card-body">

                        <table class="table table-striped table-borderless">
                            <tbody>
                            <tr>
                                <th scope="row">{{ __('Имя') }}</th>
                                <td>{{ $client->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Логин') }}</th>
                                <td>{{ $client->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Дата регистрации') }}</th>
                                <td>{{ date('d.m.Y', $client->created_at) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Автомобилей в гараже') }}</th>
                                <td>{{ count($client->cars ?: []) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Визитов на сервис') }}</th>
                                <td>{{ $client->visits }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Оставлено в кассе') }}</th>
                                <td>{{ number_format($client->cashed, 0, '.', ' ') }} р.</td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('client.edit', $client->id) }}" class="btn btn-warning rounded">Изменить</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
