 <?	
$msg_id=$_POST['msg_id'];
 //Load latest comment 
include '../init.php';
include_once '../functions/functions.php';
include_once '../functions/tolink.php';
include_once '../functions/time_stamp.php';
$Wall = new Wall_Updates();
$commentcollapsed = array_reverse($Wall->ShowComments($msg_id));
?>
<div id="zooo_<?php echo $msg_id; ?>">
<?//Loading Comments link with load_updates.php
foreach($commentcollapsed as $cdata)
 {
 $com_id=$cdata['com_id'];
 $comment=tolink(nl2br(htmlentities($cdata['comment'] )));
 $time=$cdata['created'];
 $username=$cdata['username'];
 $uid=$cdata['uid_fk'];
 $cface=$Wall->Gravatar($uid);
  $logid = $_COOKIE['uid'];
$flag_already_liked_c = 0;
$nResult = mysql_query("SELECT * FROM clikes_track WHERE uid=".$logid." AND com_id=".$com_id);
if (mysql_num_rows($nResult)){
$flag_already_liked_c = 1;
 }
 ?>
	
<div class="Hq uz"  id="stcommentbody<?php echo $com_id; ?>">

<div class="Gq"><div class="Ho gx"><div class="Ae"><a href="user=<?=$username?>" class="g-s-n-aa Wk"><img src="<?php echo $cface; ?>" width="32px" height="32px" alt="" class="Ol Zb ag"/></a>

<div><a href="" class="Sg Ob qm" rel="nofollow"><?=$username?></a>

<span class="Fw"><span class="Uy Du"><span class="jkg"><?php time_stamp($time); ?></span><span id="clike-panel-<?php  echo $com_id;?>">
<?php

if ($flag_already_liked_c == 0) {$e = 'cool';?>

<a href="javascript: void(0)" id="post_id<?php  echo $com_id;?>" onclick="javascript: Clikethis(<?php echo $_COOKIE['uid'];?>,<?php  echo $com_id;?>,1);">Like</a>
<?php }else {$e = 'uncool';?>

<a href="javascript: void(0)" id="post_id<?php  echo $com_id;?>" onclick="javascript: Clikethis(<?php echo $_COOKIE['uid'];?>,<?php  echo $com_id;?>,2);">Unlike</a>
<?php }?>
</span>
<?
$result = mysql_query("SELECT clikes FROM comments where com_id = ".$com_id);

if (mysql_num_rows($result) > 0)
{
while( $obj = @mysql_fetch_array($result) )
{
$clikes 	= $obj['clikes'];
?>

<div id="ppl_clike_div_<?php  echo $com_id;?>" <?=(($clikes) ? 'style="float:none; color:red; display:inline;"' : 'style="display:none;float:none;"')?>>
<span id="clike-stats-<?php  echo $com_id;?>">&hearts;<?=$clikes;?></span> 
</div>
<?
}
}
?>

</span></span>
<div class="Mi"><?php echo stripslashes($comment); ?></div>

</div></div></div></div></div>
<?php 
}
?></div>