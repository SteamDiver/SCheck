<?php

class Scheck
{
    private $output = "";
    private $err;
    private $i;

    function __construct($text)
    {
        $this->text = $text;
    }

    function check()
    {

        $this->i = 1; //error counter
        $this->text = str_replace(array("\r\n", "\r", "\n"), ' ', $this->text);

        $this->text = htmlspecialchars($this->text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

        preg_match_all('/(\b\w+\b)\s\1/iu', $this->text, $matches, PREG_OFFSET_CAPTURE);                           //error checker

        foreach ($matches[0] as $key => $value) {                                             //set error list
            $this->set_error($this->i++, $matches[0][$key][0], $matches[0][$key][1]);
        }

        $this->check_rules($this->get_rules("rules.txt"));




        if ($this->err == NULL) {
            $this->err[0] = "No errors";
        }
    }

    /**
     * @return string
     * @deprecated
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

    function set_error($i, $value, $at)
    {

        $this->err[$i] = "$i Warning: '$value' at $at\n";

        return $this->err;
    }

    function check_rules($rules)
    {


        foreach ($rules as $v) {

           preg_match_all('/' . preg_quote($v) . '+/iu', $this->text, $matches, PREG_OFFSET_CAPTURE);
            foreach ($matches[0] as $key => $value) {                                             //set error list
                $this->set_error($this->i++, $matches[0][$key][0], $matches[0][$key][1]);
            }
        }



    }


    /**
     * @param $value
     * @param $type
     * @deprecated
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

