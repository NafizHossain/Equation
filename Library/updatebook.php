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

echo "<p></p>\n";

$bookid = intval($_GET['bookid']);
if(array_key_exists("bookname",$_POST)) {
	$bookname = $_POST['bookname'];
	$author = $_POST['author'];
	$isbn = $_POST['isbn'];
	$res = mysql_query("UPDATE books SET Bookname = '$bookname', BookAuthor = '$author', BookISBN = '$isbn' WHERE id = $bookid");
	if($res === false) {
		echo "Failed to update book<br />\n";
	} else {
		echo "Updated book successfully.<br />\n";
	}
}

$arr = mysql_fetch_assoc(mysql_query("SELECT * FROM books WHERE id = $bookid"));

?>

<form method="post">
Book Name: <input id="bookname" name="bookname" type="text" value="<?php echo $arr["Bookname"]; ?>" /><br />
Book Author: <input id="author" name="author" type="text" value="<?php echo $arr["BookAuthor"]; ?>" /><br />
Book ISBN: <input id="isbn" name="isbn" type="text" value="<?php echo $arr["BookISBN"]; ?>" /><br />
<input type="submit" value="return" />
</form>
