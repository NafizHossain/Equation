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

$finerate = intval(mysql_result(mysql_query("SELECT finerate FROM finerate LIMIT 1"),0));

$query = "SELECT * FROM books, user WHERE books.`Signed-out-by` = user.id";

$result = mysql_query($query);

echo "<h1>All currently signed out books</h1>\n";

while($row = mysql_fetch_assoc($result)) {
	$checked = date_create_from_format("Y-m-d",$row['Signeddate']);
	$today = new DateTime();
	$days = date_diff($checked,$today)->d;
	if($days > 14) {
		$fine = ($days-14)*$finerate;
	} else {
		$fine = 0;
	}

	//show the book here
	echo "ID: <b>" . $row['id'] . "</b> - " . $row['Bookname'] . " -  " . "By: " . $row['BookAuthor'] . ' Signed out by: ' . htmlspecialchars($row['name']) . " - Fine: <b>$" . $fine . "</b>". '<br />' . "\n";
}

echo "<br /><a href=\"activitylog.php\">View the activity log</a><br />\n";

echo "<h1>Delete book</h1>";
?>
<form action="deletebook.php" method="post">
<label for="bookid2">Book ID: </label><input id="bookid2" name="bookid2" type="text" /> <br />
<input type="submit" value="return" />
</form>

<h1>Update books</h1>
<form action="updatebook.php" method="get">
<label for="bookid">Book ID: </label><input id="bookid" name="bookid" type="text" /> <br />
<input type="submit" value="return" />
</form>

<h1>Add book</h1>
<form action="addbook.php" method="post">
Book Name: <input id="bookname" name="bookname" type="text" /><br />
Book Author: <input id="author" name="author" type="text" /><br />
Book ISBN: <input id="isbn" name="isbn" type="text" /><br />
<input type="submit" value="return" />
</form>

<h1>Change the fine rate</h1>
<form action="finerate.php" method="post">
New fine rate ($): <input id="rate" name="rate" type="text" /><br />
<input type="submit" value="return" />
</form>
