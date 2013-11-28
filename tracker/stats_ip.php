<meta name="robots" content="noindex">
<?php
include_once 'connection.php';
include_once 'functions/date.php';
$cur_IP = mysql_real_escape_string(htmlentities($_GET["IP"]));

  echo "Pages viewed by $cur_IP:<br><br>";
	$query = "SELECT *,UNIX_TIMESTAMP() - date_auto AS TimeSpent FROM tracker WHERE IP = '$cur_IP' ORDER BY date_auto DESC";
	$result = mysql_query($query);
	echo '<table width="50%"><tr><td width="30%">Page </td><td width="20%">Date</td></tr>';
	
	
    for ($i  = 0; $i <mysql_num_rows($result); $i++)
	{
		$page = mysql_result($result, $i, "page");
		$date = mysql_result($result, $i, "date_auto");
		$date_auto = mysql_result($result, $i, "TimeSpent");
		$check = datefor($date, $date_auto);
				
		echo "<tr><td width='30%'>$page </td><td width='20%'>$check</td></tr>";
	
	}
echo '</table>';
?>
