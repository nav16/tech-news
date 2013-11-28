<?php

//Db information
$host = "localhost";
$db_name = "technews";
$username = "root";
$password = "";

//connect to database
mysql_connect("$host","$username","$password")or die("cannot connect to server ");

//selection of DB we need to connect to
mysql_select_db("$db_name")or die("cannot select DB");
?>