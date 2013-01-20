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

$bookname = $_POST['bookname'];
$author = $_POST['author'];
$isbn = $_POST['isbn'];

$res = mysql_query("INSERT INTO books (Bookname, BookAuthor, BookISBN) VALUES('$bookname', '$author', '$isbn')");
if(!$res) {
	echo "Failed to add the book.";
} else {
	echo "Added book successfully.";
	mysql_query("INSERT INTO activitylog (`date`, `message`) VALUES (CURRENT_DATE(), 'The book $bookid was added.')");
}

?>