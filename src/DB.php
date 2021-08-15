<?php

class DB
{
    public static $handle;

    public static function init()
    {
        $users =
        'CREATE TABLE IF NOT EXISTS user (
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        )';

        $waivers =
        'CREATE TABLE IF NOT EXISTS waiver (
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            description TEXT NOT NULL,
            due DATETIME NOT NULL,
            acknowledge_danger BOOLEAN NOT NULL
        )';

        self::$handle = new PDO('mysql:host=db;dbname=waiver', 'root', 'root');
        self::$handle->exec($users);
        self::$handle->exec($waivers);
    }
}
