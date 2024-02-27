<?php

namespace ExadsExercises\Application\Commands;

use ExadsExercises\Domain\TVSeries\Infrastructure\TVSeriesIntervalRepository;
use ExadsExercises\Domain\TVSeries\Infrastructure\TVSeriesRepository;
use ExadsExercises\Domain\TVSeries\TVSeries;
use ExadsExercises\Domain\TVSeries\TVSeriesInterval;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

/**
 * TVSeriesCommand 
 * 
 * Command to run exercise 3. TV Series
 */
class TVSeriesCommand extends Command
{
    const ACTION_ARG = 'action';
    const DESCRIPTION = '3. TV Series';
    const HELP = '
    OPTIONS:
        - create_tvseries
        - create_interval
        - next_tvseries

    Populate a MySQL (InnoDB) database with data from at least 3 TV Series using the following structure:
    tv_series -> (id, title, channel, gender);
    tv_series_intervals -> (id_tv_series, week_day, show_time);
    * Provide the SQL scripts that create and populate the DB;
    Using OOP, write a code that tells when the next TV Series will air based on the current time-date or an
    inputted time-date, and that can be optionally filtered by TV Series title.';

    /**
     * @var string $defaultName Name of command
     */
    protected static $defaultName = 'run:tv-series';
    /**
     * @var array $alias of command
     */
    protected static $alias = ['run:exercise-3', 'run:3'];

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
            ->addArgument(self::ACTION_ARG, InputArgument::REQUIRED, 'ACTION');
    }

    /**
     * Command logic execution
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     * 
     * https://symfony.com/doc/current/console/coloring.html for coloring output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        switch ($input->getArgument(self::ACTION_ARG)) {
            case 'create_tvseries':

                $titleQuestion = new Question('<question>Enter the TV series title:</question>');
                $title = $helper->ask($input, $output, $titleQuestion);
                $channelQuestion = new Question('<question>Enter the channel of the TV series:</question>');
                $channel = $helper->ask($input, $output, $channelQuestion);
                $genderQuestion = new Question('<question>Enter the gender of the TV series:</question>');
                $gender = $helper->ask($input, $output, $genderQuestion);
                //new entity
                $tvseries = new TVSeries(null,$title,$channel,$gender);
                $tvseriesRepository = new TVSeriesRepository();
                $tvseriesRepository->save($tvseries);

                break;
            case 'create_interval':

                $tvserieQuestion = new Question('<question>TV series (id|name):</question>');
                $tvserie = $helper->ask($input, $output, $tvserieQuestion);
                $tvseriesRepository = new TVSeriesRepository();
                $tvseries = $tvseriesRepository->findByIdOrByTitle($tvserie);

                $weekDayQuestion = new Question('<question>Enter the week day of the TV interval:</question>');
                $weekDay = $helper->ask($input, $output, $weekDayQuestion);
                $showTimeQuestion = new Question('<question>Enter the show time of the TV interval:</question>');
                $showTime = $helper->ask($input, $output, $showTimeQuestion);
                $TVSeriesInterval = new TVSeriesInterval($tvseries->getId(),$weekDay,$showTime);
                $TVSeriesIntervalRepository = new TVSeriesIntervalRepository();
                $TVSeriesIntervalRepository->save($TVSeriesInterval);

                break;
            case 'next_tvseries':
                $timeQuestion = new Question('<question>Input date time or empty to current:</question>');
                $time = $helper->ask($input, $output, $timeQuestion);
                $tvserieQuestion = new Question('<question>TV series (name) or empty to ignore:</question>');
                $tvserie = $helper->ask($input, $output, $tvserieQuestion);

                $tvseriesRepository = new TVSeriesRepository();
                $tvseries = $tvseriesRepository->getNextAirTime($time,$tvserie);
                if($tvseries){
                    $interval = $tvseries->getTVSeriesIntervals();
                    $output->writeln('Next is '.$tvseries->getTitle(). ' at '. $interval[0]->getWeekDay(). ' ' . $interval[0]->getShowtime() );
                } else {
                    $output->writeln('Not found any TV series');
                }
                break;
            case 'list':
                #to do
                break;
            default:
                $output->writeln([
                    "<comment>Your command is invalid.</comment>",
                    "<comment>create_tvseries</comment> => create a new tvserie",
                    "<comment>create_interval</comment> => create a new tvserie interval",
                    "<comment>find</comment> => find tvserie from date input",
                ]);
                return Command::INVALID;
                break;
        }
        $output->writeln('Your command executed successfully.');
        return Command::SUCCESS;
    }
}
