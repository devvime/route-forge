<?php

class Test
{
    static $tests = [];

    public static function add($name, $function) {
        array_push(self::$tests, [
            "name" => $name,
            "function" => $function
        ]);
    }

    public static function run() {
        foreach(self::$tests as $test) {
            echo "\nRunning test: " . $test['name'] . "\n\n";
            $test['function']();
        }
    }
}