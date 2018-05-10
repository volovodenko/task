<?php


class Config
{
    protected static $config = [];


    public static function get($key)
    {
        return isset(self::$config[$key]) ? self::$config[$key] : null;
    }


    public static function set($key, $value)
    {
        self::$config[$key] = $value;
    }
}