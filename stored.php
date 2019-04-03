<!-- HTML DOCTYPE and header -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Let's Do XSS</title>
<link href="styles.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<!-- PHP connection to database variables-->
<?php

$dbname = 'test';
$dbuser = 'user';
$dbpass = 'password';
$dbhost = '192.168.33.10';

$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");

?>


<!-- This is the HTML giving the DIV taking user input -->
<div id="inputDiv"> 
<form action="stored.php" method="get">
	<div id="enterPrompt">Enter a comment:</div>
	<div id="inputField"><input type="text" name="datText"></div>
	<div id="btn"> <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit"/></div>
</form>
</div>

<?PHP 

$text = $_GET["datText"];

if(isset($_GET['btnSubmit'])){
	//Checking the database connection
	if(!$link){
		die("Connection failed mate: " . mysqli_connect_error());
	}

	//Querying the database, inserting the new comment
	$sql = "INSERT INTO table1 (comment) VALUES ('$text')";
	$result = mysqli_query($link, $sql);
}

?>


<!-- Outputting the database -->
<div id="putThisOut">

	<?PHP
	$sql = "SELECT * FROM table1";
	$result = mysqli_query($link, $sql);


	while($row = mysqli_fetch_array($result)){
		$comment = $row['comment'];
		echo("<div id='outputDiv'>");
		echo($comment);
		echo("</div>");
	}

	?>
</div>

</body>
</html>