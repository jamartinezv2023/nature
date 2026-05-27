<?php

namespace App\Infrastructure\Persistence;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function connection(): PDO
    {
        if (self::$connection === null) {

            try {

                self::$connection = new PDO(
                    'sqlite:' . $_ENV['DB_DATABASE']
                );

                self::$connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

            } catch (PDOException $e) {

                die(
                    'Database connection error: '
                    . $e->getMessage()
                );
            }
        }

        return self::$connection;
    }
}
