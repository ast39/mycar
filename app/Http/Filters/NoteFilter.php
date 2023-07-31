<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class NoteFilter extends AbstractFilter {

    public const PHRASE = 'phrase';
    public const CAR    = 'car';

    /**
     * @return array[]
     */
    protected function getCallbacks(): array
    {
        return [

            self::PHRASE => [$this, 'phrase'],
            self::CAR    => [$this, 'car'],
        ];
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function phrase(Builder $builder, $value): void
    {
        $builder->where('additional', 'like', '%' . $value . '%');
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function car(Builder $builder, $value): void
    {
        $builder->where('car_id', $value);
    }

}
