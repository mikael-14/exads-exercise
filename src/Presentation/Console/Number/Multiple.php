<?php

namespace ExadsExercises\Presentation\Console\Number;

use ExadsExercises\Presentation\Console\InterfaceOutput;

class Multiple implements InterfaceOutput
{

    /**
     * @var int number
     */
    private int $number;
    /**
     * @var array multiples of number
     */
    private array $multiples;
    /**
     * @return string method to output to the console
     */
    public function __construct(int $number, array $multiples)
    {
        $this->number = $number;
        $this->multiples = $multiples;
    }

    public function output()
    {
        return $this->number . ' [' . implode(', ', $this->multiples) . ']';
    }
}
