<!DOCTYPE html>
<html>
<head>
    <title>Example</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="text-div">
    <?php
    include_once("SCheck.php");
    $o = new Scheck($_POST["text"]);
    $o->Check();
    ?>
    <h2>Enter your text into the form</h2>
    <form name="form" accept-charset="utf-8" method="POST" action="index.php">
        <textarea wrap="hard" id="text" name="text" rows="20" cols="10"
                  title="Enter your text here"><? echo($_POST["text"]) ?></textarea>
        <br>
        <input type=submit value="Check">
        <INPUT class="btn" value="Clear" type="submit" onclick="document.getElementById('text').value='';"/>
    </form>
    <br>

    <form name="err_form" accept-charset="utf-8" method="POST" action="SCheck.php">
        <textarea name="err" id="err" rows="10" title="Error list"><?php
            $tmp=$o->get_errors();
            if (!empty($tmp)) {
                foreach ($tmp as $error) {
                    echo "$error";
                }
            } else {
                echo "No errors";
            }
            ?>
        </textarea>
    </form>
    <br>
</div>
<hr>
<div class="checkedtextdiv">
    <?php
    echo $o->get_output();
    ?>
</div>
</body>
</html>