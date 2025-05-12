<?php

namespace App\Support;

use Dotenv\Repository\RepositoryInterface;
use RuntimeException;

class Env
{
    /**
     * The environment repository instance.
     *
     * @var RepositoryInterface|null
     */
    protected static ?RepositoryInterface $repository = null;

    public static function setRepository(RepositoryInterface $repository): void
    {
        if(self::$repository !== null) {
            throw new RuntimeException('The repository has already been set.');
        }

        self::$repository = $repository;
    }

    /**
     * Get the value of an environment variable.
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $value = self::$repository->get($key);

        if ($value === null) {
            return $default;
        }

        // Parse the value (handle 'true', 'false', 'null', etc.)
        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'null':
            case '(null)':
                return null;
            case 'empty':
            case '(empty)':
                return '';
            default:
                // Handle quoted strings
                if (preg_match('/^["\'](.*)["\']$/', $value, $matches)) {
                    return $matches[1];
                }
                return $value;
        }
    }
}