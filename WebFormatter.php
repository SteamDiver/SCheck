<?php
class WebFormatter
{
    public function WriteToWeb($errors)
    {
        foreach ($errors as $value) {
            echo($value);
        }

    }
}







