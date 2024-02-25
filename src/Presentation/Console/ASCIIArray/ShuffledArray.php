<?php

namespace ExadsExercises\Presentation\Console\ASCIIArray;

use ExadsExercises\Presentation\Console\InterfaceOutput;

class ShuffledArray implements InterfaceOutput
{

    /**
     * @var array array
     */
    private array $array;
    /**
     * @return string method to output to the console
     */
    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function output()
    {
        return 'Shuffled Array - '.count($this->array).': '.implode(' ', $this->array) . '';
    }
}
