<?php

namespace ExadsExercises\Domain\Common;

use ExadsExercises\Domain\Common\Exceptions\InvalidRangeException;

class Arr
{
    /**
     * Generates array of integers given a start and end
     *
     * @param int $start value to start at
     * @param int $end value to end at
     *
     * @return array<int>
     */    
    public static function generateRandomInteger(int $start, int $end): array
    {
        if ($start >= $end) {
            throw new InvalidRangeException("Invalid start and end");
        }
        $array = [];
        for ($x = $start; $x <= $end; $x++) {
            $array[] = $x;
        }

        return $array;
    }
}
