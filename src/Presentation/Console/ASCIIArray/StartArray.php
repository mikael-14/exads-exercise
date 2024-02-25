<?php

namespace ExadsExercises\Presentation\Console\ASCIIArray;

use ExadsExercises\Presentation\Console\InterfaceOutput;

class StartArray implements InterfaceOutput
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
        return 'Start Array - '.count($this->array).': '.implode(' ', $this->array) . '';
    }
}
