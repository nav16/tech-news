 <?php
  include 'init.php';

 if (isset($_GET['query'])){
  $query = $_GET['query'];
 }
if(!empty($query)){


$sql = "SELECT * FROM `submit_link` WHERE `topic` LIKE '%".mysql_real_escape_string($query)."%' LIMIT 0,5";
$sql_run = mysql_query($sql);

while ($query_row = mysql_fetch_assoc($sql_run)){
 echo '<div class="display" align="left"><a href="comment.php?id='.$query_row['id'].'">'.$query_row['topic'].'</a></div>';
}}
 ?>