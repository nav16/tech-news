<?php

include '../init.php';
 if(logged_in()){
$uid = isset($_REQUEST['member_id']) && is_numeric($_REQUEST['member_id']) ? intval($_REQUEST['member_id']) : '';
$entry_id = isset($_REQUEST['post_id']) && is_numeric($_REQUEST['post_id']) ? intval($_REQUEST['post_id']) : '';

$likes = 0;
if(@$_REQUEST['action'] == 1)
{
$result = mysql_query("update messages set likes=likes+1 where msg_id= ".$entry_id);


$result = mysql_query("INSERT INTO clikes_track (msg_id,uid) VALUES('".$entry_id."','".$uid."')");

$result = mysql_query("SELECT * FROM messages where msg_id = ".$entry_id." ");
if (mysql_num_rows($result) > 0)
{
while( $obj = @mysql_fetch_array($result) )
{
$likes 	= $obj['likes'];
}
}

echo $likes;
}
else if(@$_REQUEST['action'] == 2)
{
$result = mysql_query("update messages set likes=likes-1 where msg_id= ".$entry_id);
$result = mysql_query("delete from clikes_track where msg_id=".$entry_id." and uid=".$uid);

$result = mysql_query("SELECT * FROM messages where msg_id = ".$entry_id);
if (mysql_num_rows($result) > 0)
{
while( $obj = @mysql_fetch_array($result))
{
$likes 	= $obj['likes'];
}
}
echo $likes;
}
}else{?>
<script>
alert('Please Login to continue..');
</script>
<?}
?>