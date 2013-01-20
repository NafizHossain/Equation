<?php

if(!$_COOKIE['login']) {
die("login first, please");
}

$user = $_COOKIE['login'];

//STEP 1 Connect To Database
$con = mysql_connect("localhost","Asaadhya","12345");
if (!$con)
{
die("MySQL could not connect!");
}
mysql_select_db("login", $con); 



$finerate = intval(mysql_result(mysql_query("SELECT finerate FROM finerate LIMIT 1"),0));

$t = mysql_query("SELECT `name` FROM `user` WHERE id = " . intval($user));
$name = mysql_result($t,0);

echo "<h1>Books for $name!</h1>";

$query = "SELECT * FROM `books` WHERE `Signed-out-by` =  $user";
$result = mysql_query($query);
$three = False;
while($row = mysql_fetch_array($result))
{
	$checked = date_create_from_format("Y-m-d",$row['Signeddate']);
	$today = new DateTime();
	$days = date_diff($checked,$today)->d;
	if($days > 14) {
		$fine = ($days-14)*$finerate;
	} else {
		$fine = 0;
	}

	//show the book here
	echo $row['Bookname'] . " -  " . "By: " . $row['BookAuthor'] . " - Book checked out for: $days days ";
	if($fine > 0) {
		echo "<br />You have an outstanding fine of <b>$" . $fine . "</b>";
	}
	echo '<br />' . "\n";
}

mysql_close($con);






?>