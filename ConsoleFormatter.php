<?php
class ConsoleFormatter
{
    function __construct($errors)
    {
        $this->errors=$errors;
    }

    function WriteToConsole()
    {
        print_r("\n");
        foreach ($this->errors as $value) {
            print_r($value);
        }
    }
}






