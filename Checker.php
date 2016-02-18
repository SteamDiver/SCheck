<?php
include_once "SCheck.php";
class Checker extends Scheck
{
    private $formatter;


    function __construct($text, $formatter)
    {
        parent::__construct($text);
        $this->formatter = $formatter;
        require_once "$formatter.php";
    }

    function checker()
    {
        switch ($this->formatter) {
            case "WebFormatter":
                $this->Check();
                break;
            case "ConsoleFormatter":
                $obj=new Checker($argv[1],$argv[2]);
                $obj->checker();
                $obj->get_formatted();
                print_r("dsgsg");
        }
    }

    function get_formatted()
    {
        switch ($this->formatter) {
            case "WebFormatter":
                $web = new WebFormatter($this->get_errors());
                $web->WriteToWeb();
                break;
            case "ConsoleFormatter":
                $console = new ConsoleFormatter($this->get_errors());
                $console->WriteToConsole();
        }
    }

}








