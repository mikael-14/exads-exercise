<?php

namespace ExadsExercises\Application;

use Exception;
use ExadsExercises\Application\Exceptions\InvalidCommandException;
use ExadsExercises\Application\Exceptions\MissingCommandException;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

use function PHPSTORM_META\type;

/**
 * ExadsApp class for running the command
 */
class ExadsApp
{
    /**
     * @var Application for console application Symfony\Component\Console\Application
     */
    private Application $application;

    /**
     * @var string $root Root path of application
     */
    private string $root;

    /**
     * ExadsApp constructor.
     *
     * @param string $root Root directory of application
     */
    public function __construct(string $root)
    {
        $this->application = new Application();
        $this->root = $root;
    }

    /**
     * Run application
     *
     * @throws Exception
     */
    public function run() : void
    {
        $this->loadDependencies();

        $this->application->run();
    }

    /**
     * Add command
     *
     * @param $command
     */
    public function addCommand($command)
    {
        if($command instanceof Command){
            $this->application->add($command);
            return;
        }

        throw new InvalidCommandException(
            print('Invalid command')
        );
    }

    /**
     * Load application dependencies
     * NOTE: This should be done using DI Container (see README.md file).
     */
    private function loadDependencies()
    {
        // Configuration dependency
        // Config::loadFrom($this->root);
    }
}