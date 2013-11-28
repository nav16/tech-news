<?php

error_reporting(0);
//Db information
session_start();
$host = "localhost";
$db_name = "technews";
$username = "root";
$password = "";
//connect to database
mysql_connect("$host","$username","$password")or die("cannot connect to server ");

//selection of DB we need to connect to
mysql_select_db("$db_name")or die("cannot select DB");

include 'functions/user.func.php';
include 'functions/like.php';
include 'functions/date.php';



?>