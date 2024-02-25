#!/usr/bin/env php
<?php

/*
* First include the dependencies of composer, by require the generated autload
*/
require __DIR__ . '/vendor/autoload.php';

use ExadsExercises\Application\Commands\Handler\InstantiateCommand;
use ExadsExercises\Application\ExadsApp;
/*
* Inicialize the application
*/

$application = new ExadsApp(__DIR__);

/*
* Load the commands 
*/

$commands = require_once __DIR__ . '/src/Application/Bootstrap/Commands.php';

foreach ($commands as $command) {
    try {
        $commandInstance = InstantiateCommand::instantiate($command);
        $application->addCommand($commandInstance);
    } catch (\Exception $exception) {
        die($exception->getMessage());
    }
}

/*
* All load, let's run the application
*/
try {
    $application->run();
} catch (\Exception $exception) {
    die($exception->getMessage());
}