<html>
<head>
    <link rel=stylesheet type="text/css"
          href="style.css">
    <meta charset=utf-8">
    <title>SCheck</title>
</head>
<body>

<div class="checkedtextdiv">
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
        echo "<br>";
    }
    ?>

    <!----------------input------------------------------------------------------------>
    <div align=center>
        <h2>Enter your text into the form</h2>
        <form name="form" accept-charset="utf-8" method="POST" action="SCheck.php">
        <textarea wrap="hard" id="text" name="text" cols="150" rows="20"
                  title="Enter your text here"><? echo($_POST["text"]) ?></textarea>
            <br>
            <input type=submit value="Check">
            <INPUT class="btn" value="Clear" type="submit" onclick="document.getElementById('text').value='';"/>
        </form>
        <form name="err_form" accept-charset="utf-8" method="POST" action="SCheck.php">

            <br>
    </div>
    <hr>

    <!----------output---------------------------------------------------------------->
    <br>
    <textarea name="err" id="err" cols="100" rows="10" title="Error list"><?php
        if (!empty($err)) {
        } else echo "No_errors";
        ?>
    </textarea>
    <br>
    <? if (!empty($output)) {
        echo $output;
    } ?>
</div>
</body>
</html>