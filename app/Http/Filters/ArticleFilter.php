<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ArticleFilter extends AbstractFilter {

    public const CAR     = 'car';
    public const TITLE   = 'title';
    public const ARTICLE = 'article';

    /**
     * @return array[]
     */
    protected function getCallbacks(): array
    {
        return [

            self::CAR     => [$this, 'car'],
            self::TITLE   => [$this, 'title'],
            self::ARTICLE => [$this, 'article'],
        ];
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

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function title(Builder $builder, $value): void
    {
        $builder->where('title', 'like', '%' . $value . '%');
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function article(Builder $builder, $value): void
    {
        $builder->where('article', $value);
    }

}
