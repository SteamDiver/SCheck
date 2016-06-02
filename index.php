<!DOCTYPE html>
<html>
<head>
    <title>Example</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="text-div">
    <?php
    include_once("Checker.php");
    $isset=isset($_POST['text']);
    if ($isset){ $o = new Checker($_POST['text'],new WebFormatter());
    $o->check();}
    ?>
    <h2>Enter your text into the form</h2>
    <form name="form" accept-charset="utf-8" method="POST" action="index.php">
        <textarea  id="textarea" name="text" rows="20" cols="10"
                  title="Enter your text here"><? if ($isset){echo($_POST['text']);}?></textarea>
        <br>
        <input type=submit value="Check">
        <INPUT class="btn" value="Clear" type="submit" onclick="document.getElementById('textarea').value='';"/>
    </form>
    <br>

    <form name="err_form" accept-charset="utf-8" method="POST" action="SCheck.php">
        <textarea name="err" id="err" rows="10" title="Error list"><?php
            if (isset($o)){echo $o->format();};
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