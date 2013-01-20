<?php
//signout.php


//STEP 1 Connect To Database
$con = mysql_connect("localhost","Asaadhya","12345");
if (!$con)
{
die("MySQL could not connect!");
}
mysql_select_db("login", $con);

$bookid = $_POST['bookid'];
$userid = $_COOKIE['login'];

$query = "SELECT * FROM books WHERE id = " . intval($bookid) . " AND `Signed-out-by` = 0";

$res = mysql_query($query);
if(mysql_num_rows($res) < 1) {
	die("Sorry, the book was already signed out by someone.");
}

$query = "UPDATE books SET `Signed-out-by` = " . mysql_real_escape_string($userid) . ", Signeddate = CURDATE() WHERE id = " . intval($bookid) . " AND `Signed-out-by` = 0";
$res = mysql_query($query);
if($res === false) {
	echo "Error: " . mysql_error();
} else {
	echo "Book checked out!";
	mysql_query("INSERT INTO activitylog (`date`, `message`) VALUES (CURRENT_DATE(), 'The book $bookid was signed out.')");
}
?>