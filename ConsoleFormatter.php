<?php
class ConsoleFormatter
{
    function write($errors)
    {
        print ("\n");
        foreach ($errors as $value) {
            print($value);
        }
    }
}







