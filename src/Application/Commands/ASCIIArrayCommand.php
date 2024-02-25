<?php

namespace ExadsExercises\Application\Commands;

use ExadsExercises\Domain\ASCIIArray\ASCIIGenerator;
use ExadsExercises\Presentation\Console\ASCIIArray\ShuffledArray;
use ExadsExercises\Presentation\Console\ASCIIArray\StartArray;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * ASCIIArrayCommand 
 * 
 * Command to run exercise 2. Array ASCII
 */
class ASCIIArrayCommand extends Command
{
    const START_ARG = 'start';
    const END_ARG = 'end';
    const DESCRIPTION = '2. ASCII Array';
    const HELP = 'Write a PHP script to generate a random array containing all the ASCII characters from comma (“,”) to
    pipe (“|”). Then randomly remove and discard an arbitrary element from this newly generated array.
    Write the code to efficiently determine the missing character.';

    /**
     * @var string $defaultName Name of command
     */
    protected static $defaultName = 'run:ascii-array';
    /**
     * @var array $alias of command
     */
    protected static $alias = ['run:exercise-2', 'run:2'];

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
            ->addArgument(self::START_ARG, InputArgument::OPTIONAL, 'Start Character', ',')
            ->addArgument(self::END_ARG, InputArgument::OPTIONAL, 'End Character', '|');
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
        // Run the task.
        $generator = new ASCIIGenerator($input->getArgument(self::START_ARG), $input->getArgument(self::END_ARG));
        $asciiArray = new StartArray($generator->getAsciiArray());
        $output->writeln($asciiArray->output());
        //shuffle and remove
        $generator->shuffleAndRemoveRandomElement();
        $shuffledAsciiArray = new ShuffledArray($generator->getAsciiArray());
        $output->writeln($shuffledAsciiArray->output());
        //find 
        $output->writeln('Find: '.$generator->findRemovedElement());
        $output->writeln('Your command executed successfully.');

        return Command::SUCCESS;
    }
}
