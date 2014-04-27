<?php 
if ("local.thelonelama.com" === $_SERVER["SERVER_NAME"]) {
	$db = mysql_connect("localhost", "root", "Music2981") or die("Could not connect to databse.");
	mysql_select_db("thelonelama", $db);
} else {
	$db = mysql_connect("db525642704.db.1and1.com", "dbo525642704", "Music2981") or die("Could not connect to database");
	mysql_select_db("db525642704", $db);
}

?>