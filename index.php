<link rel="stylesheet" type="text/css" href="style.css">
<div align="center">
    <?php include_once("SCheck.php");
    $tmp = Check($_POST["text"]);
    ?>
    <h2>Enter your text into the form</h2>
    <form name="form" accept-charset="utf-8" method="POST" action="index.php"><textarea
            style="width: 95%; padding: 5px;" wrap="hard" id="text"
            name="text"
            rows="20"
            title="Enter your text here"><? echo($_POST["text"]) ?></textarea>
        <br>
        <input type=submit value="Check">
        <INPUT class="btn" value="Clear" type="submit" onclick="document.getElementById('text').value='';"/>
    </form>
    <br>

    <form name="err_form" accept-charset="utf-8" method="POST" action="SCheck.php">
        <textarea name="err" id="err" rows="10" title="Error list" style="width: 60%"><?php
            if (!empty($tmp[1])) {
                foreach ($tmp[1] as $error) {
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
    echo $tmp[0];
    ?>
</div>