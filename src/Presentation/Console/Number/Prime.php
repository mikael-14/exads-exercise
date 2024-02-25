<?php

namespace ExadsExercises\Presentation\Console\Number;

use ExadsExercises\Presentation\Console\InterfaceOutput;

class Prime implements InterfaceOutput
{

    /**
     * @var int number
     */
    private int $number;
    /**
     * @return string method to output to the console
     */
    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function output()
    {
        return $this->number . ' [PRIME]';
    }
}
