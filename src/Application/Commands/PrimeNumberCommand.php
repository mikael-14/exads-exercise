<?php

namespace ExadsExercises\Application\Commands;

use ExadsExercises\Domain\PrimeNumber\NumberIterator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * PrimeNumberCommand 
 * 
 * Command to run exercise 1. Prime numbers
 */
class PrimeNumberCommand extends Command
{
    const START_ARG = 'start';
    const END_ARG = 'end';
    const DESCRIPTION = '1. Prime Numbers';
    const HELP = 'Write a PHP script that prints all integer values from 1 to 100.
    Beside each number, print the numbers it is a multiple of (inside brackets and comma-separated). If
    only multiple of itself then print “[PRIME]”.';

    /**
     * @var string $defaultName Name of command
     */
    protected static $defaultName = 'run:prime-number';
    /**
     * @var array $alias of command
     */
    protected static $alias = ['run:exercise-1', 'run:1'];

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
            ->setAliases(self::$alias)
            ->addArgument(self::START_ARG, InputArgument::OPTIONAL, 'Start Number', 1)
            ->addArgument(self::END_ARG, InputArgument::OPTIONAL, 'End Number', 100);
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
        // Instantiate number range.
        $generator = new NumberIterator(intval($input->getArgument(self::START_ARG)), intval($input->getArgument(self::END_ARG)));
        foreach ($generator->fetch() as $number) {
            $output->writeln($number->output());
        }

        $output->writeln('Your command executed successfully.');

        return Command::SUCCESS;
    }
}
