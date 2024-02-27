<?php

namespace ExadsExercises\Application\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * ABTestingCommand 
 * 
 * Command to run exercise 4. A/B Testing 
 */
class ABTestingCommand extends Command
{
    const DESCRIPTION = '4. A/B Testing';
    const HELP = 'Exads would like to A/B test some promotional designs to see which provides the best conversion rate.
Write a snippet of PHP code that redirects end users to the different designs based on the data provided by this library: packagist.org/exads/ab-test-data
The data will be structured as follows:
    “promotion” => [
        “id” => 1,
        “name” => “main”,
        “designs” => [
            [ “designId” => 1, “designName” => “Design 1”, “splitPercent” => 50 ],
            [ “designId” => 2, “designName” => “Design 2”, “splitPercent” => 25 ],
            [ “designId” => 3, “designName” => “Design 3”, “splitPercent” => 25 ],
        ]
    ]
The code needs to be object-oriented and scalable. The number of designs per promotion may vary.';

    /**
     * @var string $defaultName Name of command
     */
    protected static $defaultName = 'run:ab-testing';
    /**
     * @var array $alias of command
     */
    protected static $alias = ['run:exercise-4', 'run:4'];

    /**
     * Configure command
     * 
     * the full command description shown when running the command with the "--help" option
     */
    protected function configure()
    {
        $this
            ->setName(self::$defaultName)
            ->setDescription(self::DESCRIPTION)
            ->setHelp(self::HELP)
            ->setAliases(self::$alias);
    }

    /**
     * Command logic execution
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $output->writeln('Your command executed successfully.\n');

        return Command::SUCCESS;
    }
}
