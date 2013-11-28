<?php
include_once 'connection.php';
include_once 'functions/date.php';
   $query = "SELECT * FROM tracker GROUP BY IP";
    $result = mysql_query($query);
	$views = mysql_num_rows($result);
	echo $views."unique IPs<br><br>";
	
	echo "IP Views:<br>";
	$query = "SELECT *, count(*) FROM tracker GROUP BY IP";
   $result = mysql_query($query);
   
   for ($i  = 0; $i <mysql_num_rows($result); $i++)
   {
		
		$IP = mysql_real_escape_string(htmlentities(mysql_result($result, $i, "IP")));
		$views = mysql_result($result, $i, "count(*)");
		
		echo '<a href = "stats_ip.php?IP='.$IP.'">'.$IP.' </a>';
		echo "views: $views<br>";
   
   }
	echo "<br>Page Views:<br>";
	$query = "SELECT *, count(*) FROM tracker GROUP BY page";
   $result = mysql_query($query);
   
   for ($i  = 0; $i <mysql_num_rows($result); $i++)
   {
		$page = mysql_result($result, $i, "page");
		
		$views = mysql_result($result, $i, "count(*)");
		
		echo "$page ";
		echo "views: $views<br>";
   
   }  
   

?>