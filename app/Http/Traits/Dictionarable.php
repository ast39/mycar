<?php

namespace App\Http\Traits;

use App\Models\Article;
use App\Models\Car;
use App\Models\CarMark;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

trait Dictionarable {

    /**
     * Все валюты
     *
     * @return array
     */
    private function marks(): array
    {
        return CarMark::all()->sortBy('title')->toArray();
    }

    /**
     * Все мотоциклы
     *
     * @return array
     */
    protected function cars(): array
    {
        return Car::where('owner_id', Auth::id())
            ->get()
            ->toArray();
    }

    /**
     * Все запчасти
     *
     * @return array
     */
    protected function articles(): array
    {
        return Article::where('client_id', Auth::id())
            ->get()
            ->toArray();
    }

    /**
     * Все заметки
     *
     * @return array
     */
    protected function notes(): array
    {
        return Note::where('client_id', Auth::id())
            ->get()
            ->toArray();
    }

}
