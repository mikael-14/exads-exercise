<?php

namespace ExadsExercises\Domain\TVSeries\Infrastructure;

use ExadsExercises\Domain\TVSeries\TVSeries;

interface TVSeriesRepositoryInterface
{
    public function toArray(TVSeries $tvseries): array;

    public function save(TVSeries $tvseries): void;
    
    public function findById(int $id): ?TVSeries;
    
    public function findByTitle($title): ?TVSeries;
    
    public function findByIdOrByTitle($search): ?TVSeries;
    
    public function getNextAirTime($inputDateTime = null,string $title = null): ?TVSeries;
}
