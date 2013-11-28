 <?php
//Load latest comment 
include '../init.php';
 if(logged_in()){
include_once '../functions/functions.php';
include_once '../functions/tolink.php';
include_once '../functions/time_stamp.php';
$uid = $_COOKIE['uid'];
$Wall = new Wall_Updates();

if(isSet($_POST['comment']))
{
$comment=$_POST['comment'];
$msg_id=$_POST['msg_id'];
$ip=$_SERVER['REMOTE_ADDR'];
$cdata=$Wall->Insert_Comment($uid,$msg_id,$comment,$ip);
if($cdata)
{
$com_id=$cdata['com_id'];
 $comment=nl2br(htmlentities($cdata['comment']));
 $time=$cdata['created'];
 $username=$cdata['username'];
 $uid=$cdata['uid_fk'];
 $cface=$Wall->Gravatar($uid);
 ?>

<div class="Hq uz"  id="stcommentbody<?php echo $com_id; ?>">
<div class="Gq"><div class="Ho gx"><div class="Ae"><a href="user=<?=$username?>" class="g-s-n-aa Wk"><img src="<?php echo $cface; ?>" width="32px" height="32px" alt="" class="Ol Zb ag"/></a>
<div><a href="" class="Sg Ob qm" rel="nofollow"><?=$username?></a>
<span class="Fw"><span class="Uy Du"><span class="jkg"><?php time_stamp($time); ?></span>

<span id="clike-panel-<?php  echo $com_id;?>">
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

<div id="ppl_clike_div_<?php  echo $com_id;?>" <?=(($likes) ? 'style="float:none;color:red;display:inline;"' : 'style="display:none;float:none;"')?>>
<span id="clike-stats-<?php  echo $com_id;?>" style="font-style:italic; color:red; display:inline;font-weight:bold;">&hearts;<?=$clikes;?></span> 
</div>
<?
}
}
?>

</span></span>
<div class="Mi"><?php echo $comment; ?></div>
</div></div></div></div></div>

<?php
}
}}else{?>
<script>
alert('Please Login to continue..');
</script>
<?}
?>