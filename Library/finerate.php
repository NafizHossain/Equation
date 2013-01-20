<?php

if(!$_COOKIE['login']) {
die("login first, please");
}

$user = intval($_COOKIE['login']);

$res = mysql_query($query);

$con = mysql_connect("localhost","Asaadhya","12345");
if (!$con)
{
die("MySQL could not connect!");
}
mysql_select_db("login", $con);

$res = mysql_query("SELECT isadmin FROM user WHERE id = $user LIMIT 1");
if(intval(mysql_fetch_array($res)[0]) < 1) {
	die("Sorry, you need to be a librarian to do this");
}

echo "Welcome fellow librarian";

$rate = intval($_POST['rate']);
if(!mysql_query("UPDATE finerate SET finerate = $rate")) {
	echo "Failed to update fine rate.";
} else {
	echo "Successfully updated the fine rate.";
	mysql_query("INSERT INTO activitylog (`date`, `message`) VALUES (CURRENT_DATE(), 'The fine rate was changed to $rate .')");
}

?>