<?php

/**
 * Register the commands 
 *
 */

use ExadsExercises\Application\Commands\ABTestingCommand;
use ExadsExercises\Application\Commands\ASCIIArrayCommand;
use ExadsExercises\Application\Commands\PrimeNumberCommand;
use ExadsExercises\Application\Commands\TVSeriesCommand;

return [
    PrimeNumberCommand::class,
    ASCIIArrayCommand::class,
    TVSeriesCommand::class,
    ABTestingCommand::class,
];
