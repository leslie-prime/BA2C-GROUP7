<?php

class Singleton
{
    private static ?Singleton $instance = null;

    // Prevent direct object creation
    private function __construct()
    {
    }

    // Prevent cloning
    private function __clone()
    {
    }

    // Prevent unserialization
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    // Global access point
    public static function getInstance(): Singleton
    {
        if (self::$instance === null) {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }
}

// $one = Singleton::getInstance();
// $two = Singleton::getInstance();

// var_dump($one === $two); // true
