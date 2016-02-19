<?php
class ConsoleFormatter
{
    function WriteToConsole($errors)
    {
        print_r("\n");
        foreach ($errors as $value) {
            print_r($value);
        }
    }
}







