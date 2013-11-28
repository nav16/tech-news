<?php
	include_once 'connection.php';
    $cur_id = rawurldecode($_GET["url"]);
	$this_page = $_SERVER["PHP_SELF"].'/'.$cur_id ;
	$IP = $_SERVER["REMOTE_ADDR"];
	$date_auto = time();

	$query = "INSERT INTO tracker (page, IP, date_auto) VALUES ('$this_page', '$IP','$date_auto')";
	mysql_query($query);
	
	$query = "SELECT count(*) FROM tracker WHERE page = '$this_page'";
	$result=mysql_query($query);
	$views = mysql_result($result,0,"count(*)");
	
	//echo 'Page Views'. $views;
	


?>