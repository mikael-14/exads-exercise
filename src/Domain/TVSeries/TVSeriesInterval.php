<?php

namespace ExadsExercises\Domain\TVSeries;

use ExadsExercises\Domain\TVSeries\Exceptions\TVSeriesIntervalInvalidDateException;

/**
 * Populate a MySQL (InnoDB) database with data from at least 3 TV Series using the following structure:
 * tv_series -> (id, title, channel, gender);
 * tv_series_intervals -> (id_tv_series, week_day, show_time);
 * * Provide the SQL scripts that create and populate the DB;
 * Using OOP, write a code that tells when the next TV Series will air based on the current time-date or an
 * inputted time-date, and that can be optionally filtered by TV Series title.
 */
class TVSeriesInterval
{
    /**
     * @var int tv_serie id
     */
    private int $idTvSeries;
    /**
     * @var string weekday
     */
    private string $weekDay;
    /**
     * @var string showtime
     */
    private string $showTime;
    /**
     * @var TVSeries 
     */
    private TVSeries $tvSeries;

    public function __construct(int $idTvSeries, string $weekDay, string $showTime)
    {
        $this->idTvSeries = $idTvSeries;
        $timezone = new \DateTimeZone('GMT');
        try {
            $weekDayFormat = new \DateTime($weekDay,$timezone);
        } catch (\Exception $e) {
            throw new TVSeriesIntervalInvalidDateException('Invalid week day format.'.$e->getMessage());
        }
        $this->weekDay = $weekDayFormat->format('l');
        try {
            $showTimeFormat = new \DateTime($showTime,$timezone);
        } catch (\Exception $e) {
            throw new TVSeriesIntervalInvalidDateException('Invalid show time format.'.$e->getMessage());
        }
        $this->showTime = $showTimeFormat->format('H:i:s');
    }

    /**
     * getters
     */
    public function getIdTvSeries(): int
    {
        return $this->idTvSeries;
    }
    public function getWeekDay(): string
    {
        return $this->weekDay;
    }
    public function getShowTime(): string
    {
        return $this->showTime;
    }
    public function getTVSeries(): TVSeries
    {
        return $this->tvSeries;
    }
    /**
     * setters
     */
    /**
     * @param TVSeries $tvSeries
     * 
     * @return void
     */
    public function setTVSeries(TVSeries $tvSeries): void
    {
        $this->tvSeries = $tvSeries;
    }
}
