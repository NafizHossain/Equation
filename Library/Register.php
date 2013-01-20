<?php 

	 
$con = mysql_connect("localhost","Asaadhya","12345");
if (!$con)
{
die("MySQL could not connect!");
}
mysql_select_db("login", $con); 

$two = "INSERT INTO user(name, username, password)
VALUES
('$_POST[name]','$_POST[username]','$_POST[password]')"; 

if(!mysql_query($two, $con))
{
print "error";
}
echo "Your data was added";
?>

