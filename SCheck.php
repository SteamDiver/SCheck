<?php

class Scheck
{
    private $output = "";
    private $err;

    function __construct($text)
    {
        $this->text = $text;
    }


    /**
     *Check text
     * @see Scheck::check_rules to check text accroding to special rules
     */
    function check()
    {
        $this->text = str_replace(array("\r\n", "\r", "\n"), ' ', $this->text);

        $this->text = htmlspecialchars($this->text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

        preg_match_all($this->get_regex(), $this->text, $matches, PREG_OFFSET_CAPTURE);                           //error checker

        foreach ($matches[0] as $key => $value) {                                             //set error list
            $this->set_error($matches[0][$key][0], $matches[0][$key][1]);
        }

        $this->check_rules($this->get_rules("rules.txt"));


        if ($this->err == NULL) {
            $this->err[0] = "No errors";
        }
    }

    /**
     * Returns regex for checking from config.txt
     * @return string
     */
    private function get_regex()
    {
    return file("config.txt")[0];
    }

    /**
     * @return array  Array of errors
     */
    public function get_errors()
    {
        return $this->err;
    }


    /**
     * Get rules from file
     * @param $file string Path to file with rules
     * @return array Array of rules
     */
    private function get_rules($file)
    {
        return file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }


    /**
     * Add error to error array
     * @param $value string Error value
     * @param $at int Position in text
     */
    function set_error($value, $at)
    {
        $this->err[] = "Warning: '$value' at $at\n";
    }


    /**
     * Check text according to the rules given in array $rules
     * @param $rules array array of rules
     * @see SCheck::get_rules() to read rules from file
     */
    function check_rules($rules)
    {
        foreach ($rules as $v) {

            preg_match_all('/' . preg_quote($v) . '+/iu', $this->text, $matches, PREG_OFFSET_CAPTURE);
            foreach ($matches[0] as $key => $value) {                                             //set error list
                $this->set_error($matches[0][$key][0], $matches[0][$key][1]);
            }
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

