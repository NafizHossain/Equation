<?php

if(!$_COOKIE['login']) {
die("login first, please");
}

$user = intval($_COOKIE['login']);



$con = mysql_connect("localhost","Asaadhya","12345");
if (!$con)
{
die("MySQL could not connect!");
}
mysql_select_db("login", $con);

if(array_key_exists("bookid",$_POST)) {
	$bookid = intval($_POST['bookid']);
	$q = mysql_query("INSERT INTO favourites (bookid, userid) VALUES ($bookid, $user)");
	if(!$q) {
		echo "Error. " . mysql_error();
	} else {
		echo "Book should be successfully added";
	}
}
echo '<h1>Your favourite books:</h1>';

$result = mysql_query("SELECT books.id, books.Bookname, books.BookAuthor FROM books, favourites WHERE favourites.userid = $user AND favourites.bookid = books.id");
while($row = mysql_fetch_array($result)) {
	//show the book here
	echo "ID: <b>" . $row['id'] . "</b> - " . $row['Bookname'] . " -  " . "By: " . $row['BookAuthor'] . '<br />' . "\n";
}

?>
<h1>Add a book to favourites</h1>
<form action="favourites.php" method="post">
<label for="bookid">Book ID: </label><input id="bookid" name="bookid" type="text" /> <br />
<input type="submit" value="Sign out" />
</form>

