<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ServiceFilter extends AbstractFilter {

    public const CAR     = 'car';
    public const TITLE   = 'title';
    public const SERVICE = 'service';
    public const STATUS  = 'status';

    /**
     * @return array[]
     */
    protected function getCallbacks(): array
    {
        return [

            self::CAR     => [$this, 'car'],
            self::TITLE   => [$this, 'title'],
            self::SERVICE => [$this, 'service'],
            self::STATUS  => [$this, 'status'],
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
    public function service(Builder $builder, $value): void
    {
        $builder->where('service_title', 'like', '%'. $value . '%');
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function status(Builder $builder, $value): void
    {
        $builder->where('status', $value);
    }

}
