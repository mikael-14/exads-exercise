<?php

namespace ExadsExercises\Domain\ABTesting;

use ExadsExercises\Domain\ABTesting\Exceptions\SplitPercentNotFillException;

/**
 * Domain Design
 */
class Design
{
    /**
     * @var int id
     */
    private int $id;
    /**
     * @var string name of the design
     */
    private string $name;
    /**
     * @var int percent of the design been chosen
     */
    private int $splitPercent;

    public function __construct($id, $name, $splitPercent)
    {
        $this->id = $id;
        $this->name = $name;
        $this->splitPercent = $splitPercent;
    }

    /**
     * @return int id
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * @return string name of the design
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * @return int percent of the design 
     */
    public function getSplitPercent(): int
    {
        return $this->splitPercent;
    }
}
