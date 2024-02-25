<?php

namespace ExadsExercises\Domain\Multiple;

use ExadsExercises\Domain\Common\Arr;
use ExadsExercises\Domain\Multiple\Exceptions\InvalidEndValueException;
use ExadsExercises\Domain\Multiple\Exceptions\InvalidStartValueException;
use ExadsExercises\Presentation\Console\Number\Multiple;
use ExadsExercises\Presentation\Console\Number\Prime;

/**
 * Domain for generate array of integers
 */
class NumberGenerator
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
     * @return array of integers
     */
    public function generate(): array
    {
        return Arr::generateRandomInteger($this->start, $this->end);
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
