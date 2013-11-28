<?php
include '../init.php';
 if(logged_in()){
$uid = isset($_REQUEST['member_id']) && is_numeric($_REQUEST['member_id']) ? intval($_REQUEST['member_id']) : '';
$entry_id = isset($_REQUEST['post_id']) && is_numeric($_REQUEST['post_id']) ? intval($_REQUEST['post_id']) : '';

$likes = 0;
if(@$_REQUEST['action'] == 1)
{
$result = mysql_query("update comments set clikes=clikes+1 where com_id= ".$entry_id);
$result = mysql_query("INSERT INTO clikes_track (com_id,uid) VALUES('".$entry_id."','".$uid."')");
$result = mysql_query("SELECT clikes FROM comments where com_id = ".$entry_id." ");

if (mysql_num_rows($result) > 0)
{
while( $obj = @mysql_fetch_array($result) )
{
$likes 	= $obj['clikes'];
}
}

echo $likes;
}
else if(@$_REQUEST['action'] == 2)
{
$result = mysql_query("update comments set clikes=clikes-1 where com_id= ".$entry_id);
$result = mysql_query("delete from clikes_track where com_id=".$entry_id." and uid=".$uid);
$result = mysql_query("SELECT clikes FROM comments where com_id = ".$entry_id);

if (mysql_num_rows($result) > 0)
{
while( $obj = @mysql_fetch_array($result) )
{
$likes 	= $obj['clikes'];
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