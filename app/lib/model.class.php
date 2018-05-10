<?php


class Model
{
    private static $connection;

    public function __construct()
    {
        if (!isset(self::$connection)) {
            $dbHost = Config::get("db.host");
            $dbName = Config::get("db.name");
            $dbUser = Config::get("db.user");
            $dbPass = Config::get("db.password");

            self::$connection = new PDO("mysql: host=$dbHost; dbname=$dbName", $dbUser, $dbPass);

            if (!self::$connection) {
                throw new Exception("Could not connect to DB");
            }
        }
    }

    public static function dbQuery($query)
    {
        if (!self::$connection) {
            return false;
        }

        try {
            $result = self::$connection->query($query);
        } catch (Exception $e) {
            setFlash("Write error: " . $e, false);
            return false;
        }

        return $result->fetchAll(PDO::FETCH_ASSOC);

    }

    public static function escape($query)
    {
        return self::$connection->quote($query);
    }
}