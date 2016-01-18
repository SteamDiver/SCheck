<?php


    $i = 0; //error counter
    //----------------array-of-rules-----------------------------------------------

    $rules = file("rules.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    //------------------------------------------------------------------
    $text = $_POST["text"];
    $text = htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $str = explode("\r\n", $text); //split whole text into strings
    foreach ($str as $key => $value)  //for each string
    {
        $words = explode(" ", $value);    //split string into words
        foreach ($words as $k => $v) //for each word in the string
        {
            if (((mb_strtolower($v) == mb_strtolower($words[$k + 1])) || (mb_strtolower($v) == mb_strtolower(trim($words[$k + 1], "!@#$%^&*)(_+-=№;:?/\|<>,.")))) && ($v != NULL)) //if words are the same
            {
                $col = stripos($value, $v);
                $err[$i] = "$i Repetition of the word '$v' at ($key;$col)"; //add to error array
                $i++;
                $output .= "<span class='error'><b>$v </b></span>";
            } else {
                foreach ($rules as $v1) {
                    if (($v1 != null) && (strstr($v, $v1) != null)) {
                        $col = stripos($value, $v);
                        $err[$i] = "$i Warning: '$v1' at ($key;$col)";
                        $i++;
                        $warn = true;
                    }
                }
                if (!empty($warn) && $warn == true) {
                    $output .= "<span class='warn'><b>$v </b> </span>";
                    $warn = false;
                } else $output .= "<span class='normal'>$v </span>";
            }
        }
        $output .="<br>";
    }