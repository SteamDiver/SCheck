<?php

class Scheck
{
    private $output = "";
    private $err;

    function __construct($text)
    {
        $this->text = $text;
    }

    function Check()
    {

        $err = null;
        $i = 0; //error counter
        //-----------------rules-----------------------------------------------

        $rules = file("rules.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        //------------------------------------------------------------------
        $this->text = htmlspecialchars($this->text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $str = explode("\r\n", $this->text); //split whole text into strings
        foreach ($str as $key => $value)  //for each string
        {
            $words = explode(" ", $value);    //split string into words
            foreach ($words as $k => $v) //for each word in the string
            {
                if (((mb_strtolower($v) == mb_strtolower($words[$k + 1])) || (mb_strtolower($v) == mb_strtolower(trim($words[$k + 1], "!@#$%^&*)(_+-=№;:?/\|<>,.")))) && ($v != NULL)) //if words are the same
                {
                    $col = stripos($value, $v);
                    $this->err[$i] = "$i Repetition of the word '$v' at ($key;$col)\n"; //add to error array
                    $i++;
                    $this->output .= "<span class='error'><b>$v </b></span>";
                } else {

                    foreach ($rules as $v1) {
                        if (($v1 != null) && (strstr($v, $v1) != null)) {
                            $col = stripos($value, $v);
                            $this->err[$i] = "$i Warning: '$v1' at ($key;$col)";
                            $i++;
                            $warn = true;
                        }
                    }
                    if (!empty($warn) && $warn == true) {
                        $this->output .= "<span class='warn'><b>$v </b> </span>";
                        $warn = false;
                    } else $this->output .= "<span class='normal'>$v </span>";
                }
            }
            $this->output .= "<br>";
        }
//        return array($output, $err);
    }

    function get_output()
    {
        return $this->output;
    }

    function get_errors()
    {
        return $this->err;
    }
}

