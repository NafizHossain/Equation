<html>
<body>

<?php

//STEP 1 Connect To Database
$con = mysql_connect("localhost","Asaadhya","12345");
if (!$con)
{
die("MySQL could not connect!");
}
mysql_select_db("login", $con);

$result = mysql_query("SELECT * FROM user");
$three = False;
while($row = mysql_fetch_array($result))
{
if($row['username'] == $_POST['username'] && $row['password'] == $_POST['password']) 
{
setcookie('login',$row['id']);
echo "welcome fellow reader";

$a = "SELECT * FROM books";
$result = mysql_query($a);
echo "<h1>Here is a list of all books</h1>\n";
/*
1. The joys of Asaadhya   978-3-16-148410-0   
2. Biology 11                    1-800-999-3333   
3. Pokemon Adventures for Beginners 1-800-000-342542  
4. To Kill a Mockingbird            1-900-134343   
5. Macbeth                        1-45435-43543543      




*/

while($row = mysql_fetch_array($result)) {
	//show the book here
	echo "ID: <b>" . $row['id'] . "</b> - " . $row['Bookname'] . " -  " . "By: " . $row['BookAuthor'] . '<br />' . "\n";
}

?>
<hr />
<h2>Sign out a book</h2>
<form action="signout.php" method="post">
<label for="bookid">Book ID: </label><input id="bookid" name="bookid" type="text" /> <br />
<input type="submit" value="Sign out" />
</form>

<hr />
<h2>return a book</h2>
<form action="return.php" method="post">
<label for="bookid2">Book ID: </label><input id="bookid2" name="bookid2" type="text" /> <br />
<input type="submit" value="return" />
</form>


<?php
echo '<a href="books.php">Your signed out books</a><br />';
echo '<a href="favourites.php">Your favourite books</a><br />';


$res = mysql_query("SELECT isadmin FROM user WHERE id = $user LIMIT 1");
if(intval(mysql_fetch_array($res)[0]) < 1) {
	echo '<a href="librarianfile.php">Librarian interface</a>' . "\n";
}


$three = True;
}
} 
if($three == False)
{
echo "not a valid login";
}


//if(!$DB)
//{
//die("MySQL could not select Database!");
//}

//STEP 2 Declare Variables

//$username = $_POST['username'];
//$password = $_POST['password'];
//$Query = mysql_query("SELECT * FROM User WHERE Username='$Name' AND Password='$Pass'");
//$NumRows = mysql_num_rows($Query);
//$_SESSION['username'] = $Name;
//$_SESSION['password'] = $Pass;

//STEP 3 Check to See If User Entered All Of The Information

//if(empty($_SESSION['username']) || empty($_SESSION['password']))
//{
//die("Go back and login before you visit this page!");
//}

//if($Name && $Pass == "")
//{
//die("Please enter in a name and password!");
//}

//if($Name == "")
//{
//die("Please enter your name!" . "</br>");
//}

//if($Pass == "")
//{
//die("Please enter a password!");
//echo "</br>";
//}

//STEP 4 Check Username And Password With The MySQL Database

//if($NumRows != 0)
//{
//while($Row = mysql_fetch_assoc($Query))
//{
//$Database_Name = $Row['username'];
//$Database_Pass = $Row['password'];
//}
//}
//else
//{
//die("Incorrect Username or Password!");
//}

?>
</body>
</html>
