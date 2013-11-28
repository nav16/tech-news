 <?

foreach($updatesarray as $data)
 {
 $msg_id=$data['msg_id'];
 $orimessage=$data['message'];
 $message=tolink(nl2br(htmlentities($data['message'])));
  $time=$data['created'];
   $username=$data['username'];
 $uid=$data['uid_fk'];
 $fa=$Wall->Gravatar($uid);
 $commentsarray=array_reverse($Wall->Comments($msg_id));
 $commentsColl=$Wall->CommentsColl($msg_id);
 
  $flag_already_liked = 0;
$nResult = mysql_query("SELECT * FROM clikes_track WHERE uid=".$_COOKIE['uid']." AND msg_id=".$msg_id);
if (mysql_num_rows($nResult))
{
$flag_already_liked = 1;
} 
 
?>

<div class="sommr" id="commwid">
<div class="holder" id="stbody<?php echo $msg_id;?>">
<span role="button" class="optmen" title="Options menu"></span>

<a href="user=<?=$username?>">
<img src="<?=$fa?>" width="40px" height="40px" alt="" class="pilot"></a>

<div class="details">
<header><h3 class="headchk"><a href="user=<?=$username;?>" class="Sg Ob Tc"><?=$username;?></a></h3><span class="maui">&nbsp;-&nbsp; <span title="Time of post"><? echo time_stamp($time); ?></span></header>
</div>
<div class="ci">
<div class="wm">
<?php echo stripslashes($message);?>
</div>
</div>


<div class="baseui">

<span id="like-panel-<?php  echo $msg_id?>">
<?php if (@$flag_already_liked == 0) {$e = 'cool';?>
<div id="po" href="javascript:void(0);" role="button" class="esw eswd Hf Od" id="post_id<?php  echo $msg_id?>" onclick="javascript: likethis(<?php echo $_COOKIE['uid']?>,<?php  echo $msg_id?>,1);"><span class="sr ew" id="loadera<?php  echo $msg_id?>"></span></div>
<?php }else { $e = 'uncool';?>
<div id="po" href="javascript:void(0);" role="button" class="esw Hf Od eswa" id="post_id<?php  echo $msg_id?>" onclick="javascript: likethis(<?php echo $_COOKIE['uid']?>,<?php  echo $msg_id?>,2);"><span class="sr ew" id="loadera<?php  echo $msg_id?>"></span></div>
<?php }?>
</span>
<?$result = mysql_query("SELECT * FROM messages where msg_id = ".$msg_id);
if (mysql_num_rows($result) > 0)
{
while( $obj = @mysql_fetch_array($result))
{
$likes 	= $obj['likes'];
?>

<div class="bommu">
<div class="iP">
<div class="showPpl" id="ppl_like_div_<?php  echo $msg_id?>" <?=((@$likes) ? 'style="display:inline;"' : 'style="display:none"')?>>
<span id="like-stats-<?php  echo $msg_id?>" style="color:red; display:inline;"><b>&hearts;<?php echo (($likes) ? $likes : 0);?></b></span>
</div>	
</div>
<div class="aka"></div>
<?}
}?>


</div></div></div>
<div class="Lj FE"><div class="Se Eu"><div class="ak tr"><div class="iP" style="margin-top:5px;">
<?if($commentsColl > 2){?>
<div class="tr clickOpen" id="collapsed_<?php  echo $msg_id?>">
<div class="Ko">
<span role="button" class="a-n sF"><span class="gh Ni"><?php echo $commentsColl?></span><span class="Oi"> comments</span></span><div class="a-f-e">
</div></div>
<div id="dido" style="display:none">
<span role="button" class="a-n sF"><span class="gh Ni">Hide</span><span class="Oi">Comments</span></span>
</div>
</div>
<?}?> 

</div></div>
<div class="O7 mP">

<div id="commentload<?php echo $msg_id;?>">
<div id="loadComments<?php  echo $msg_id?>"></div>
<?php include('load_comments.php') ?>
</div>
</div>
<? if(logged_in()){?>
<div id="baum<?=$msg_id?>">
<div class="hh dw">
<div tabindex="0" class="Kj bI commentopen" id="<?=$msg_id?>" role="button">Add a comment...</div></div>
</div>

<div class="commentupdate" style='display:none' id='commentbox<?php echo $msg_id;?>'>

<div class="Up Cu">

<img src="<?=$face?>" width="32px" height="32px" alt="" class="Ol Zb ag m8">

<form method="post" action="">
<div class="Rm">
<textarea name="comment" class="commareaa" cols="50" maxlength="1000" style='max-width:380px; max-height:500px; min-height:40px;' placeholoder="Leave a comment!" id="ctextarea<?php echo $msg_id;?>" autofocus="autofocus"></textarea>
</div>

<div role="button" class="a-f-e c-b c-b-da c-b-E comment_button"  id="<?php echo $msg_id;?>" style="-webkit-user-select: none;">Post comment</div><div type="reset" role="button" class="a-f-e c-b c-b-T cancelbutton" id="cancel<?=$msg_id?>" style="-webkit-user-select: none; ">Cancel</div>
</form>
</div>
</div>
<?}?>
</div></div></div>

<?php
  }   
 ?>