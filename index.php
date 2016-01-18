<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SCheck</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div align=center>
    <h2>Enter your text into the form</h2>
    <form name="form" accept-charset="utf-8" method="POST" action="index.php">
        <textarea wrap="hard" id="text" name="text" cols="150" rows="20"
                  title="Enter your text here"><? echo($_POST["text"]) ?></textarea>
        <br>
        <input type=submit value="Check">
        <INPUT class="btn" value="Clear" type="submit" onclick="document.getElementById('text').value='';"/>
    </form>
    <br>
    <?php include_once("SCheck.php"); ?>
    <form name="err_form" accept-charset="utf-8" method="POST" action="SCheck.php">
        <textarea name="err" id="err" cols="100" rows="10" title="Error list"><?php
            if (!empty($err)) {
                foreach ($err as $error) {
                    echo "$error";
                }
            } else {
                echo "No errors";
            }
            ?></textarea>
        <br>
</div>
<hr>
<div class="checkedtextdiv">
    <?php
    if (!empty($output)) {
        echo($output);
    }
    ?>
</div>
</body>
</html>