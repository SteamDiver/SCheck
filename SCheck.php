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
        $this->text = str_replace(array("\r\n", "\r", "\n"), ' ', $this->text);

        $rules = $this->get_rules("rules.txt");

        $this->text = htmlspecialchars($this->text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

        preg_match_all('/(\b\w+\b)\s\1/iu', $this->text, $matches);                           //error checker

        foreach ($matches[0] as $key => $value) {                                             //set error list
            $this->set_error($i++, $matches[0][$key]);
        }

        $this->check_rules($rules, $this->text, $i);

        if ($this->err == NULL) {
            $this->err[0] = "No errors";
        }
    }

    /**
     * @return string
     * @deprecated No use due to no use of "set output()"
     */
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

    function set_error($i, $value)
    {

        $this->err[$i] = "$i Warning: '$value' \n";

        return $this->err;
    }

    function check_rules($rules, $text, $i)
    {
        $textarray = explode(" ", $text);
        foreach ($textarray as $word) {
            foreach ($rules as $v1) {
                if (($v1 != null) && (strstr($word, $v1) != null)) {

                    // $type = "warn";//means there was warning
                    $this->set_error($i++, $v1);
                    $i++;

                }
            }
        }

    }


    /**
     * @param $value
     * @param $type
     * @deprecated No use due to no fuck logic for this function
     */
    function set_output($value, $type)
    {
        switch ($type) {
            case "error":
                $this->output .= "<span class='error'><b>$value </b></span>";
                break;
            default:
                $this->output .= "<span class='normal'>$value </span>";
        }


    }
}

