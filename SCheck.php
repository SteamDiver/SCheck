<?php

class Scheck
{
    private $output = "";
    private $err;

    function __construct($text)
    {
        $this->text = $text;
    }

    function check()
    {

        $i = 0; //error counter

        $rules = $this->get_rules("rules.txt");

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
                    $this->set_error($i, $v, $key, $col, false);
                    $i++;
                    $this->set_output($v, "error");
                } else {
                    $type = $this->check_rules($rules, $key, $value, $v, $i);
                    $this->set_output($v, $type);
                }
            }
            $this->output .= "<br>";
        }
        if ($this->err == NULL) {
            $this->err[0] = "No errors";
        }
    }

    public function get_output()
    {
        return $this->output;
    }

    public function get_errors()
    {
        return $this->err;
    }

    function get_rules($file)
    {
        return file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }

    function set_error($i, $value, $row, $col, $warn)
    {
        if ($warn == true) {
            $this->err[$i] = "$i Warning: '$value' at ($row;$col)\n";
        } else {
            $this->err[$i] = "$i Repetition of the word '$value' at ($row;$col)\n";
        }
        return $this->err;
    }

    function check_rules($rules, $string_key, $string, $word, $i)
    {
        $type = "";
        foreach ($rules as $v1) {
            if (($v1 != null) && (strstr($word, $v1) != null)) {
                $col = stripos($string, $word);
                $type = "warn";//means there was warning
                $this->set_error($i, $v1, $string_key, $col, true);
                $i++;

            }
        }
        return $type;

    }

    function set_output($value, $type)
    {
        switch ($type) {
            case "error":
                $this->output .= "<span class='error'><b>$value </b></span>";
                break;
            case "warn":
                $this->output .= "<span class='warn'><b>$value </b> </span>";
                break;
            default:
                $this->output .= "<span class='normal'>$value </span>";
        }


    }
}

