<?php

namespace ExadsExercises\Domain\TVSeries\Infrastructure;

use ExadsExercises\Domain\TVSeries\Exceptions\TVSeriesIntervalNotFoundException;
use ExadsExercises\Domain\TVSeries\TVSeries;
use ExadsExercises\Domain\TVSeries\TVSeriesInterval;
use ExadsExercises\Infrastructure\Database\DB;

class TVSeriesIntervalRepository implements TVSeriesIntervalRepositoryInterface
{
    const TABLE = 'tv_series_intervals';

    public function save(TVSeriesInterval $TVSeriesInterval): void
    {
        $data = $this->toArray($TVSeriesInterval);
        DB::instance()->insert(self::TABLE, $data);
    }

    public function findById(int $id): ?TVSeriesInterval
    {
        $row = DB::instance()->select(self::TABLE, '*', ['id' => $id]);
        if ($row === null) {
            throw new TVSeriesIntervalNotFoundException('TV Series Interval not found');
        }

        return new TVSeriesInterval($row['id_tv_series'], $row['week_day'], $row['show_time']);
    }
    public function toArray(TVSeriesInterval $TVSeriesInterval): array
    {
        return [
            'id_tv_series' => $TVSeriesInterval->getIdTvSeries(),
            'week_day' => $TVSeriesInterval->getWeekDay(),
            'show_time' => $TVSeriesInterval->getShowTime(),
        ];
    }
   
}
