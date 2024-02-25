<?php

namespace ExadsExercises\Domain\PrimeNumber;

use ExadsExercises\Domain\PrimeNumber\Exceptions\InvalidEndValueException;
use ExadsExercises\Domain\PrimeNumber\Exceptions\InvalidStartValueException;
use ExadsExercises\Presentation\Console\PrimeNumber\Multiple;
use ExadsExercises\Presentation\Console\PrimeNumber\Prime;

/**
 * Domain for iterate between numbers
 * 
 * 1. Prime Numbers
 * Write a PHP script that prints all integer values from 1 to 100.
 * Beside each number, print the numbers it is a multiple of (inside brackets and comma-separated). If
 * only multiple of itself then print “[PRIME]”.
 */
class NumberIterator
{
    /**
     * @var int start of array
     */
    private int $start;
    /**
     * @var int end of array
     */
    private int $end;
    /**
     * @param int $start of the array
     * @param int $end end of array
     */
    public function __construct(int $start, int $end)
    {
        if ($start < 0)
            throw new InvalidStartValueException('Start value cannot be less than 0.');
        if ($start >= $end)
            throw new InvalidEndValueException('End value should be greater than start value.');

        $this->start = $start;
        $this->end = $end;
    }


    /**
     * @return 
     */
    public function fetch()
    {
        for ($number = $this->start; $number <= $this->end; $number++) {
            //only go to half of the current number to check the multiples, because 
            if ($number < 2) {
                // 0 isn't prime number
                // 1 isn't prime number: "1" can only be divided by one number, 1 itself, so with this definition 1 is not a prime number
                // https://www.wgtn.ac.nz/science/ask-a-researcher/is-1-a-prime-number
                yield new Multiple($number, [$number]);
                continue;
            }

            $multiples = $this->multiples($number);
            if (count($multiples) === 1) { //is prime number
                yield new Prime($number);
                continue;
            }
            yield new Multiple($number, $multiples);
        }
    }

    /**
     * @param int $number to seek the divisor 
     * 
     * @return array of multiples
     */
    private function multiples(int $number): array
    {
        // every number is divisible by 1
        $multiples = [1];
        //only need to go through half of the number 
        $highestIntegralSquareRoot = floor($number / 2);
        for ($i = 2; $i <= $highestIntegralSquareRoot; $i++) {
            if ($number % $i == 0) {
                $multiples[] = $i;
            }
        }
        return $multiples;
    }
}
