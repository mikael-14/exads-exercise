<?php

namespace ExadsExercises\Domain\TVSeries;

/**
 * Populate a MySQL (InnoDB) database with data from at least 3 TV Series using the following structure:
 * tv_series -> (id, title, channel, gender);
 * tv_series_intervals -> (id_tv_series, week_day, show_time);
 * * Provide the SQL scripts that create and populate the DB;
 * Using OOP, write a code that tells when the next TV Series will air based on the current time-date or an
 * inputted time-date, and that can be optionally filtered by TV Series title.
 */
class TVSeries
{
    /**
     * @var id 
     */
    private int|null $id;
    /**
     * @var string title
     */
    private string $title;
    /**
     * @var string channel name
     */
    private string $channel;
    /**
     * @var string gender name
     */
    private string $gender;
    /**
     * @var array<TVSeriesInterval|null>
     */
    private array $TVSeriesIntervals =[];

    public function __construct(int|null $id, string $title, string $channel, string $gender)
    {
        $this->id = $id;
        $this->title = $title;
        $this->channel = $channel;
        $this->gender = $gender;
    }
    /**
     * getters
     */
    public function getId(): int|null
    {
        return $this->id ? $this->id : null;
    }
    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function getChannel(): ?string
    {
        return $this->channel;
    }
    public function getGender(): string
    {
        return $this->gender;
    }
    public function getTVSeriesIntervals(): array
    {
        return $this->TVSeriesIntervals;
    }

    public function addInterval(TVSeriesInterval $interval): void
    {
        $this->TVSeriesIntervals[] = $interval;
    }
    
}
