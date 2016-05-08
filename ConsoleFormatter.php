<?php
class ConsoleFormatter
{
    /**
     * Print errors
     * @param $errors
     */
    function write($errors)
    {
        print ("\n");
        foreach ($errors as $value) {
            print($value);
        }
    }
}







