<?php
class WebFormatter
{
    function __construct($errors)
    {
        $this->errors=$errors;
    }

    public function WriteToWeb()
    {
        foreach ($this->errors as $value) {
            echo($value);
        }
    }
}







