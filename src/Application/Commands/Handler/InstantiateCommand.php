<?php

namespace ExadsExercises\Application\Commands\Handler;


use ExadsExercises\Application\Exceptions\InvalidCommandException;
use Symfony\Component\Console\Command\Command;
use ReflectionClass;


class InstantiateCommand
{
    /**
     * Builds command instance
     *
     * @param string $namespace namespace to build ExadsExercises\Application\Commands\...
     *
     * @return object|Command
     * @throws InvalidCommandException
     */
    public static function instantiate(string $namespace): object
    {
        $class = new ReflectionClass($namespace);
        if (self::isValid($class))
            return $class->newInstance();

        throw new InvalidCommandException(
            sprintf('Invalid command %s', $namespace)
        );
    }

    /**
     * Check if given class is valid
     *
     * @param ReflectionClass $class Class instance to test
     *
     * @return bool
     */
    private static function isValid(ReflectionClass $class)
    {
        return $class->isSubclassOf(Command::class) && $class->isInstantiable();
    }
}
