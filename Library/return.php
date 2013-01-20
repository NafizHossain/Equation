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


$bookid = intval($_POST['bookid2']);
$userid = intval($_COOKIE['login']);

$query = "UPDATE books SET `Signed-out-by` = 0 WHERE id = $bookid AND `Signed-out-by` = $userid";
$result = mysql_query($query);
if($result === false) {
	echo "Failed to return the book.";
} else {
	echo "Book returned!";
	mysql_query("INSERT INTO activitylog (`date`, `message`) VALUES (CURRENT_DATE(), 'The book $bookid was returned.')");
}


mysql_close($con);






?>