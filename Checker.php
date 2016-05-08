<?php
function __autoload($class_name)
{
    include $class_name . ".php";
}

class Checker extends Scheck implements FormatterInterface
{

    private $formatter;

    function __construct($text, $formatter)
    {
        parent::__construct($text);
        $this->formatter = $formatter;
    }


    /**
     *Format with formatter given in SCheck::__construct()
     */
    function format()
    {
        $obj = new $this->formatter;
        $obj->write($this->get_errors());
    }


}

$checker = new Checker($argv[1], new ConsoleFormatter());
$checker->check();









