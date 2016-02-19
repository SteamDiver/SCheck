<?php
function __autoload($class_name)
{
    include $class_name.".php";
}
class Checker extends Scheck
{

    private $formatter;

    function __construct($text, $formatter)
    {
        parent::__construct($text);
        $this->formatter = $formatter;
    }
    function get_formatted()
    {
        switch ($this->formatter) {
            case new WebFormatter():
                $web = new WebFormatter($this->get_errors());
                $web->WriteToWeb($this->get_errors());
                break;
            case new ConsoleFormatter():
                $console = new ConsoleFormatter($this->get_errors());
                $console->WriteToConsole($this->get_errors());
                break;
        }
    }

}
$checker = new Checker($argv[1], new ConsoleFormatter());
$checker->check();
$checker->get_formatted();









