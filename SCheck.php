html>
<head>
<link rel=stylesheet type="text/css"
href="style.css"
<meta charset=utf-8">
<title>SCheck</title>
</head>
<body>

<div align=center>
<h2>Enter your text into the form</h2>
<form name="form" accept-charset="utf-8" method="POST" action="index.php">
<textarea wrap="hard" type="text" id="text" name="text" cols="150" rows="20"><? echo($_POST["text"])?></textarea>
<br>
<input type=submit value="Check">
<INPUT class="btn" value="Clear" type="submit" onclick="document.getElementById('text').value='';"/>
</form>
<form name="err_form" accept-charset="utf-8" method="POST" action="index.php">

<br>
</div>

<hr>

<div class="checkedtextdiv">
<?php 

$i=0; //error counter
//----------------array-of rules-----------------------------------------------	
				
$rules= array(					
0 => '..',
1 => ',,'
);

//------------------------------------------------------------------
$text=$_POST["text"];
$text=htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$str=explode("\r\n",$text); //split whole text into strings
	foreach ($str as $key => $value)  //for each string
	{
	 
		$words=explode(" ",$value);	//split string into words
		foreach( $words as $k =>$v) //for each word in the string
		{
			
			if ((($v==mb_strtolower($words[$k+1])) or ($v==mb_strtolower(trim($words[$k+1],"!@#$%^&*)(_+-=№;:?/\|<>,.")))) && $v!=NULL) //if words are the same
			{
			$col=stripos( $value , $v );
			$err[$i]="$i Repetition of the word '$v' at ($key;$col)"; //add to error array
			$i++;
			echo "<font class='error'><b>$v </b></font>";
			}
			else
			{ 
			foreach( $rules as $v1)
			{
				if (strpos($v,$v1)!=null)
				{
					$col=stripos( $value , $v );
					$err[$i]="$i Warning: '$v1' at ($key;$col)";
					$i++;
					$warn=true;
				}
				
				 			
			}
			if ($warn==true)
			{
				echo "<font class='warn'><b>$v </b> </font>";
				$warn=false;
			}
			else echo "<font class='normal'>$v </font>";
				
			}			
			
			
	
		
			
			
		
		}
	echo "<br>";	
	}


?>
<br>
<textarea name="err" id="err" cols="100" rows="10">
<?php if ($err!=NULL) {
		foreach ($err as $v1) echo "$v1 \n" ;
		} 
		
		else echo "No_errors"?>
</textarea>
</div>

</body>
</html>
