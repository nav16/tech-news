
<?php

	include("init.php");
	$request = (int)$_REQUEST['id'];
	if(logged_in() && userid_exists($_REQUEST['id'])){
	$res = mysql_query("select * from follower_id where userid = ".$_COOKIE['uid']." AND followerid = ".$request);
	$check_result = @mysql_num_rows(@$res);
	
	if($check_result > 0)
	{
		@mysql_query("delete from follower_id where userid = ".$_COOKIE['uid']." AND followerid = ".$request);
	//$sml = @mysql_query("SELECT followers from users WHERE uid = ".$request);
		//$rows=mysql_fetch_array($sml);
		//$nofol=$rows['followers'];
		//@mysql_query("UPDATE users SET followers = ".$nofol."-1 uid = ".$request);
		echo '<a class="btn-follow" id="webut" href="javascript:;">+Follow</a>';
	}	
	else
	{
		@mysql_query("INSERT INTO follower_id (userid,followerid) VALUES('".$_COOKIE['uid']."','".$request."')");
     // $sml = @mysql_query("SELECT followers from users WHERE uid = ".$request);
		//$rows=mysql_fetch_array($sml);
		//$nofol=$rows['followers'];
		//@mysql_query("UPDATE users SET followers = ".$nofol."+1 WHERE uid = ".$request);
		echo '<a class="btn-following" id="webut" href="javascript:;">-Following</a>';
	}		
					
}else{?>
<script>
alert('Please Login to continue..');
</script>
<?}
?>