<?php
function __autoload($class_name)
{
    include $class_name . '.php';
}

    $checker = new Checker($argv[1], new ConsoleFormatter());
    $checker->check();








