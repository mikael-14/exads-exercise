<?php

namespace ExadsExercises\Domain\TVSeries\Infrastructure;

use ExadsExercises\Domain\TVSeries\Exceptions\TVSeriesNotFoundException;
use ExadsExercises\Domain\TVSeries\TVSeries;
use ExadsExercises\Domain\TVSeries\TVSeriesInterval;
use ExadsExercises\Infrastructure\Database\DB;

class TVSeriesRepository implements TVSeriesRepositoryInterface
{
    const TABLE = 'tv_series';

    public function save(TVSeries $tvseries): void
    {
        $data = $this->toArray($tvseries);
        DB::instance()->insert(self::TABLE, $data);
    }

    public function findById($id): ?TVSeries
    {
        $row = DB::instance()->select(self::TABLE, '*', ['id' => $id]);
        if ($row === null) {
            throw new TVSeriesNotFoundException('Tvserie not found');
        }
        $row = $row[0]; //onlt need first
        return new TVSeries($row['id'], $row['title'], $row['channel'], $row['gender']);
    }
    public function toArray(TVSeries $tvseries): array
    {
        return [
            'id' => $tvseries->getId(),
            'title' => $tvseries->getTitle(),
            'channel' => $tvseries->getChannel(),
            'gender' => $tvseries->getGender(),
        ];
    }

    public function findByTitle($title): ?TVSeries
    {
        $row = DB::instance()->select(self::TABLE, '*', ['title' => $title]);
        if ($row === null) {
            throw new TVSeriesNotFoundException('Tvserie not found');
        }
        return new TVSeries($row['id'], $row['title'], $row['channel'], $row['gender']);
    }
    public function findByIdOrByTitle($search): ?TVSeries
    {
        $row = DB::instance()->select(self::TABLE, '*', ['id' => $search, 'title' => $search], "OR");
        if ($row === null) {
            throw new TVSeriesNotFoundException('Tvserie not found');
        }
        $row = $row[0]; //only need first
        return new TVSeries($row['id'], $row['title'], $row['channel'], $row['gender']);
    }
    public function getNextAirTime($inputDateTime = null,string $title = null): ?TVSeries
    {
        $dateTime = ($inputDateTime) ? strtotime($inputDateTime) : time();
        $table1 = self::TABLE;
        $table2 = TVSeriesIntervalRepository::TABLE;
        $tvseriesintervals =  DB::instance()->selectInnerJoin(
            $table1,
            $table2,
            "{$table1}.id={$table2}.id_tv_series",
            "*",
            ['title' => $title],
            'tv_series_intervals.week_day, tv_series_intervals.show_time'
        );
        foreach ($tvseriesintervals as $tvseriesinterval) {
            $showTime = strtotime($tvseriesinterval['week_day'] . ' ' . $tvseriesinterval['show_time']);
            if ($showTime >= $dateTime) {
                $tvseries = new TVSeries($tvseriesinterval['id'],$tvseriesinterval['title'],$tvseriesinterval['channel'],$tvseriesinterval['gender']);
                $tvseries->addInterval(new TVSeriesInterval($tvseriesinterval['id'],$tvseriesinterval['week_day'],$tvseriesinterval['show_time']));
                return $tvseries;
            }
        }
        return null;
    }
}
