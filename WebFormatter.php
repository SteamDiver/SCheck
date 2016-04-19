<?php
class WebFormatter
{
    public function write($errors)
    {
        foreach ($errors as $value) {
            echo($value);
        }

    }
}







