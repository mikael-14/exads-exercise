<?php

namespace ExadsExercises\Infrastructure;

use Symfony\Component\Dotenv\Dotenv;

class Config
{
    /**
     * @param string $dir
     *
     * Load config from file
     */
    public static function loadConfig($dir)
    {
        $envFilePath = $dir . '/.env';

        if (!file_exists($envFilePath)) {
            throw new \RuntimeException('.env file not found at: ' . $envFilePath);
        }
        $dotenv = new Dotenv();
        $dotenv->load($dir . '/.env');
    }

    /**
     * @param string $key Configuration key
     * @param mixed  $default Default value, if required not found
     *
     * Get configuration key.
     */
    public static function get(string $key, $default = null)
    {
        return array_key_exists($key, $_SERVER) ? $_SERVER[$key] : $default;
    }
}
