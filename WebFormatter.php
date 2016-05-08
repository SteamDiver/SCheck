<?php
class WebFormatter
{
    /**
     * Echo errors
     * @param $errors
     */
    public function write($errors)
    {
        foreach ($errors as $value) {
            echo($value);
        }

    }
}







