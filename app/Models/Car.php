<?php

namespace App\Models;

use App\Http\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model {

    use HasFactory, Filterable, SoftDeletes;


    protected $table      = 'cars';

    protected $primaryKey = 'car_id';

    protected $keyType    = 'int';


    public $incrementing  = true;

    public $timestamps    = true;


    /**
     * Владелец байка
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * Производитель байка
     *
     * @return BelongsTo
     */
    public function mark(): BelongsTo
    {
        return $this->belongsTo(CarMark::class, 'mark_id', 'mark_id');
    }

    /**
     * Сервисные работы
     *
     * @return HasMany
     */
    public function works(): HasMany
    {
        return $this->hasMany(Service::class, 'car_id', 'car_id')
            ->orderByDesc('created_at');
    }

    /**
     * Каталог запчастей на байк
     *
     * @return HasMany
     */
    public function catalog(): HasMany
    {
        return $this->hasMany(Article::class, 'car_id', 'car_id')
            ->orderByDesc('created_at');
    }

    /**
     * Заметки про байк
     *
     * @return HasMany
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class, 'car_id', 'car_id')
            ->orderByDesc('created_at');
    }

    /**
     * Сразу же просчитаем кол-во обслуживаний
     *
     * @return int
     */
    public function getVisitsAttribute(): int
    {
        return Service::where('car_id', $this->car_id)
            ->count() ?: 0;
    }

    /**
     * Сразу же просчитаем сколько потрачено на обслуживание
     *
     * @return int
     */
    public function getCashedAttribute(): int
    {
        return Service::where('car_id', $this->car_id)
            ->get()
            ->pluck('price')
            ->sum() ?: 0;
    }

    /**
     * Минимальный зафиксированный пробег автомобиля в истории
     *
     * @return int
     */
    public function getMinMileageAttribute(): int
    {
        return min($this->collectAllMileages()) ?: 0;
    }

    /**
     * Максимальный зафиксированный пробег автомобиля в истории
     *
     * @return int
     */
    public function getMaxMileageAttribute(): int
    {
        return max($this->collectAllMileages()) ?: 0;
    }

    /**
     * Итоговый пробег автомобиля в истории
     *
     * @return int
     */
    public function getCarMileageAttribute(): int
    {
        $this->attributes['car_mileage'] = $this->getMaxMileageAttribute() - $this->getMinMileageAttribute();
        return $this->getMaxMileageAttribute() - $this->getMinMileageAttribute();
    }

    /**
     * Стоимость 1км пробега
     *
     * @return float
     */
    public function getKmPriceAttribute(): float
    {
        return round($this->getCashedAttribute() / max($this->getCarMileageAttribute(), 1), 2);
    }


    /**
     * @return array
     */
    private function collectAllMileages(): array
    {
        if (!is_null($this->works())) {
            $works_mileage = array_filter(
                array_map(function ($e) {
                    return $e['mileage'];
                }, $this->works()
                    ->get()
                    ->toArray()), function($e) {
                        return !is_null($e);
                    }
                );
        }

        if (!is_null($this->notes())) {
            $notes_mileage = array_filter(
                array_map(function ($e) {
                    return $e['mileage'];
                }, $this->notes()
                    ->get()
                    ->toArray()), function($e) {
                        return !is_null($e);
                    }
                );
        }

        return array_unique(array_merge($works_mileage ?: [], $notes_mileage ?: []));
    }


    protected $with = [
        'mark',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    protected $fillable = [
        'car_id', 'owner_id', 'mark_id', 'model', 'year', 'volume', 'vin', 'number', 'additional',
        'created_at', 'updated_at',
    ];

    protected $hidden = [
        'deleted_at',
    ];
}
