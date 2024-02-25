<?php

namespace ExadsExercises\Domain\ASCIIArray;

use ExadsExercises\Domain\ASCIIArray\Exceptions\InvalidEndASCIIValueException;
use ExadsExercises\Domain\ASCIIArray\Exceptions\InvalidEndLengthValueException;
use ExadsExercises\Domain\ASCIIArray\Exceptions\InvalidStartASCIIValueException;
use ExadsExercises\Domain\ASCIIArray\Exceptions\InvalidStartLengthValueException;
use ExadsExercises\Domain\Common\Arr;

/**
 * Domain for generate array of integers
 */
class ASCIIGenerator
{
    /**
     * @var string start of array
     */
    private string $start;
    /**
     * @var string end of array
     */
    private string $end;

    /**
     * @var array array of characters
     */
    private array $asciiArray;
    /**
     * @param string $start of the array
     * @param string $end end of array
     */
    public function __construct(string $start, string $end)
    {
        if (strlen($start) !== 1) {
            throw new InvalidStartLengthValueException('Start value must be only one character.');
        }
        if ($this->isASCII($start) === false) {
            throw new InvalidStartASCIIValueException('Start value must be an ASCII character.');
        }
        if (strlen($end) !== 1) {
            throw new InvalidEndLengthValueException('End value must be only one character.');
        }
        if ($this->isASCII($end) === false) {
            throw new InvalidEndASCIIValueException('Start value must be an ASCII character.');
        }
        $this->start = $start;
        $this->end = $end;
        $this->generate();
    }
    /**
     * @return array asciiarray
     */
    public function getAsciiArray(): array
    {
        return $this->asciiArray;
    }
    /**
     * @param string $character to check if is a valid character. See more about https://www.ascii-code.com/ASCII
     * I'm gonna considerate beteween "!" until  "~" (33 until 126)
     * 
     * @return bool
     */
    private function isASCII(string $character): bool
    {
        $asciiValue = ord($character);
        return ($asciiValue >= 33 && $asciiValue <= 126);
    }
    /**
     * @return 
     * generate a random array of characters
     */
    private function generate()
    {
        //let's generate the arrays
        $this->asciiArray = Arr::generateOrderedArrayCharsASCII($this->start, $this->end);
    }

    /**
     * @return 
     */
    public function shuffleAndRemoveRandomElement()
    {
        Arr::randomShuffle($this->asciiArray);
        // Remove last element (it's shuffle so gonna be a random)
        array_pop($this->asciiArray);
    }
 
    /**
     * @return string
     * find missing elements compared to generated one
     */
    public function findRemovedElement()
    {
        // Find missing character using array_diff
        $missingElement = array_diff(Arr::generateOrderedArrayCharsASCII($this->start, $this->end), $this->asciiArray);
        return array_shift($missingElement);
    }
}
