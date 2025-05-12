<?php

use App\Support\Env;

if (!function_exists('env')) {
    /**
     * Retrieves the value of an environment variable.
     *
     * @param string $key The name of the environment variable.
     * @param mixed|null $default The default value to return if the environment variable does not exist.
     * @return mixed Returns the value of the environment variable, or the default value if not found.
     */
    function env(string $key, mixed $default = null): mixed
    {
        return Env::get($key, $default);
    }
}