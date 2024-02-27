<?php

namespace ExadsExercises\Domain\TVSeries\Infrastructure;

use ExadsExercises\Domain\TVSeries\TVSeriesInterval;

interface TVSeriesIntervalRepositoryInterface
{
    
    public function save(TVSeriesInterval $TVSeriesInterval): void;
    
    public function findById(int $id): ?TVSeriesInterval;

    public function toArray(TVSeriesInterval $TVSeriesInterval): array;

   
}
