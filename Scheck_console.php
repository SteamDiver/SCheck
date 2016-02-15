<?php
require_once "SCheck.php";
class Scheck_console extends Scheck
{

    function WriteToConsole()
    {
        $this->Check();
        $errors = $this->get_errors();
        print_r("\n");
        foreach ($errors as $value) {
            print_r($value);
        }
    }
}
$obj = new Scheck_console($argv[1]);
$obj->WriteToConsole();






