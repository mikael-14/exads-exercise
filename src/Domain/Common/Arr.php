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
    public static function generateOrderedArrayOfInteger(int $start, int $end): array
    {
        if ($start >= $end) {
            $tmp=$start;
            $start=$end;
            $end=$tmp;
            unset($tmp);
        }
        return range($start, $end);
    }

    /**
     * @param string $start character to start
     * @param int $end character to end
     * 
     * @return array<string>
     */
    public static function generateOrderedArrayCharsASCII(string $start, string $end): array
    {
        return range($start, $end);
    }

    public static function randomShuffle(array &$array)
    {
        return shuffle($array);
    }
}
