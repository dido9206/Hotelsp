<?php

session_start();


$host = "localhost";

$username = "root";

$password = "1qazZAQ!";

$db = "hotels";

@mysql_connect($host,$username,$password) or die ("error");

@mysql_select_db($db) or die("error");

?>