<?php
$pid=(int)$_GET['id'];
include_once 'init.php';
$sql="SELECT * FROM submit_link WHERE id='$pid'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result);
if (!$rows) {
header('Location: index.php');
die();
}
include_once 'functions/functions.php';
include_once 'functions/tolink.php';
include_once 'functions/time_stamp.php';
include_once 'session.php';
$Wall = new Wall_Updates();
$updatesarray=$Wall->Updates($pid);
include_once 'template/header.php';
?>
<link href="css/wall.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/wall.js"></script>
<script type="text/javascript" src="js/smileys.js"></script>
<script type = "text/javascript" src="js/jquery.elastic.js"></script>


<style>
.info{ background:#FFFFFF;}
.title{ font-family:Verdana, Arial, Helvetica, sans-serif; font-size:8pt; font-weight:bold;}
.url{ font-family:Verdana, Arial, Helvetica, sans-serif; font-size:8pt; padding:0px;}
.desc{ font-family:Verdana, Arial, Helvetica, sans-serif; font-size:8pt; }
</style>
<div id="main">
<?
$tbl_name="submit_link";		
	/* Get data. */
$sql = "SELECT *,UNIX_TIMESTAMP() - datetime AS TimeSpent FROM $tbl_name WHERE topic <>'' AND id = '$pid'";
$result = mysql_query($sql);
	

if(mysql_num_rows($result)>0){
while($rows=mysql_fetch_array($result)){
		$total = $rows['article_dislikes'] + $rows['article_likes']; //this is the net result of voting up and voting down
$check = datefor($rows['datetime'], $rows['TimeSpent']);
$id = $rows['id'];	
$uid = 	$rows['email'];	
$url = rawurldecode($rows['site']);
$parsed = parse_url($url);
$facr = Gravatar($rows['uid']);

?>
<title><?=stripslashes($rows['topic'])?> | Tech News</title>

<div tabindex="-1" class="sommr">
<div class="holder">
<div id="leftbox">

 	<a href="javascript:void(0);" class="like" title="voteUp" onclick="like_add(<?php echo $rows['id'];?>)">Up</a>
<span class="vote-count" onload="total_votes(<?php echo $rows['id'];?>)" id="article_<?php echo $rows['id'];?>"><?=$total?></span>
	<a href="javascript:void(0);" class="unlike" title="voteDown" onclick="dislike_add(<?php echo $rows['id'];?>)">Down</a>
</div>

<a href="<?=$rows['name']?>">
<img src="<?=$facr?>" width="40px" height="40px" alt="" class="pilot"/></a>
<?
$noc = Noofcomments($id);
?>
<div class="details">
<header><h3 class="headchk"><a href="<?=$rows['name']?>" class="Sg Ob Tc"><?=$rows['name']?></a></h3><span class="maui">&nbsp;-&nbsp; <span title="Time of post" tabindex="0"><? echo $check; ?></span>&nbsp;-&nbsp; <span class="pl" title="Site" tabindex="0"><small>(<? echo $parsed['host']; ?>)</small>
</span><span class="comter"><?$nou = Noofurls($rows['name']);
if($nou > 30){?>
<span class="badge moderator">TC</span>
<?}?><strong><a href="comment.php?id=<? echo $rows['id'];?>"><?=$noc ?> comments</a></strong></span></header>
</div>

<div class="ci">
<div class="wm"><a href="redirect.php?url=<? echo $url;?>" rel="nofollow" target="new" class="yofu"><?= stripslashes($rows['topic']); ?></a></div>
<script>

$(document).ready(function()
{
$('.gaa').load('fetechmeta.php?url=<?=$url;?>');
$('#shortened-url').load('shorturl.php?longUrl=technews.iteching.info/comment.php?id=<?=$id;?>');	
$("#shorturl-link").click(function(){
$(this).select();
});
});
</script>

<div class="gaa">
<center><img src="images/loader.gif"/></center>

</div>
</div>

</div>
<div id="message_<?php echo $rows['id'];?>" class="msg">
</div>
</div>

<?php
//post
}}else{
function parsePost($m){
		// parses the post with bbCode, smilies and also checks the badwords
		// Make sure we cannot ever post HTML 
		//$m = htmlspecialchars($m, ENT_QUOTES);

		// Youtube (to remove, comment out :))
		$yt_f = '/\[youtube\](.*?)\[\/youtube\]/is';
		$yt_r = "<iframe title=\"YouTube video player\" width=\"460\" height=\"160\" src=\"http://www.youtube.com/embed/$1?rel=0\" frameborder=\"0\" allowfullscreen>Youtube video - [url=http://youtube.com/watch?v=$1]Watch now[/url]</iframe>";
		$m = preg_replace($yt_f,$yt_r,$m);
		
		// URLS, images and colours
		$url_f = array('/\[url\](.*?)\[\/url\]/is','/\[url=(.*?)\](.*?)\[\/url\]/is','/\[color=(.*?)\](.*?)\[\/color\]/is','/\[img\](.*?)\[\/img\]/is', '/\[font=(.*?)\](.*?)\[\/font\]/is'); 
		$url_r = array('<a href="$1" target="_blank" title="$1">$1</a>','<a href="$1" target="_blank" title="$1">$2</a>',
			'<span style="color: $1">$2</span>','<div class="inimg" style="max-width:500px;max-height:500px;"><center><img src="$1" style="max-width:500px;max-height:500px;"/></center></div>', '<span style="font: $1">$2</span>');
		// replace
		$m = preg_replace($url_f,$url_r,$m);
		
		// Standard bbCode
		$bb_f = array('[b]','[/b]','[u]','[/u]','[i]','[/i]','[ul]','[/ul]','[li]','[/li]');
		$bb_r = array('<strong>','</strong>','<u>','</u>','<em>','</em>','<ul>','</ul>','<li>','</li>');
		$m = str_ireplace($bb_f,$bb_r,$m);

		// For Security...
		$m = str_ireplace("%3C%73%63%72%69%70%74","&lt;script",$m);
		$m = str_ireplace("%64%6F%63%75%6D%65%6E%74%2E%63%6F%6F%6B%69%65","document&#46;cookie",$m);
		$m = preg_replace("#javascript\:#is","java script:",$m);
		$m = preg_replace("#vbscript\:#is","vb script:",$m);
		$m = str_ireplace("`","&#96;",$m);
		$m = preg_replace("#moz\-binding:#is","moz binding:",$m);
		$m = str_ireplace("<script","&lt;script",$m);
		$m = str_ireplace("&#8238;",'',$m);
		// now, we can send it back
		return $m;
}


$sql = "SELECT *,UNIX_TIMESTAMP() - datetime AS TimeSpent FROM $tbl_name WHERE topic ='' AND id = '$pid'";
$result = mysql_query($sql);
	

if(mysql_num_rows($result)>0){
while($rows=mysql_fetch_array($result)){
		$total = $rows['article_dislikes'] + $rows['article_likes']; //this is the net result of voting up and voting down
$check = datefor($rows['datetime'], $rows['TimeSpent']);
$id = $rows['id'];	
$uid = 	$rows['email'];	
$fac = Gravatar($rows['uid']);
?>

<title><?=stripslashes($rows['title']);?> | Tech News</title>

<div tabindex="-1" class="sommr">
<div class="holder">

<div id="leftbox">
 	<a href="javascript:void(0);" class="like" title="voteUp" onclick="like_add(<?php echo $rows['id'];?>)">Up</a>
<span class="vote-count" onload="total_votes(<?php echo $rows['id'];?>)" id="article_<?php echo $rows['id'];?>"><?=$total?></span>
	<a href="javascript:void(0);" class="unlike" title="voteDown" onclick="dislike_add(<?php echo $rows['id'];?>)">Down</a>
</div>


<a href="<?=$rows['name']?>">
<img src="<?=$face?>" width="48px" height="48px" alt="" class="pilot"></a>
<?
$noc = Noofcomments($id);
?>
<div class="details">
<header><h3 class="headchk"><a href="<?=$rows['name']?>" class="Sg Ob Tc"><?=$rows['name']?></a></h3><span class="maui">&nbsp;-&nbsp; <span title="Time of post" tabindex="0"><? echo $check; ?></span><span class="comter"><?$nou = Noofurls($rows['name']);
if($nou > 30){?>
<span class="badge moderator">TC</span>
<?}?><strong><a href="comment.php?id=<? echo $rows['id'];?>"><?=$noc ?> comments</a></strong></span></header>
</div>
<meta type="desc" content="Hello Babu"/>
<div class="ze point"></div>
<div class="ci">
<div class="wm"><a href="comment.php?id=<? echo $id;?>" target="new" class="yofu"><?= stripslashes($rows['title']);?></a>
</div>
<script>

$(document).ready(function()
{
 $('#shortened-url').load('shorturl.php?longUrl=technews.iteching.info/comment.php?id=<?=$id;?>');	
$("#shorturl-link").click(function(){
$(this).select();
});
});
</script>
<div class="gaa">
<? echo parsePost(stripslashes(nl2br($rows['content'])));?>
</div>
</div>
</div>
<div id="message_<?php echo $rows['id'];?>" class="msg">
</div>

</div>

<?}}}?>

<? if(logged_in()){?>
<div id="leave">
<div class="Cla">
<img src="<?=$face?>" width="48px" height="48px" class="Ol Rf gS Bla">
<form method="post" action="">
<div guidedhelpid="sharebox" class="Fm g-s-Ma-ba Ma Nf ke"  decorated="true">
<div class="Je">

<textarea cols="64" placeholder="Give an update..." rows="2" class="xe watermark" style='max-width:465px; max-height:1000px; min-height:50px;' name="update" id="update<?=$pid;?>" maxlength="1000"></textarea>
<div class="ze point"></div>
</div>
<div class="Ng">
<div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td valign="top" class="bw">

<div role="button" class="a-f-e c-b c-b-da pm Nl c-b-E update_button" id="<?=$pid;?>" style="-webkit-user-select: none; " >Update</div></td></tr></tbody></table></div>

</div>
</div>
</form>

</div>
</div>

<?}
else{?>
<h4>Login To Comment</h4>
<?}
?>
<div style="margin-top:25px!important;" >
<div id="council">
<?php 
$noc = Noofcomments($id);
if($noc==0){
echo '<b>Be the first person to comment</b>';
}
include('comments/load_messages.php'); ?>

</div></div></div>
<div id="sidebar">
<div class="linkinfo">
<span id="shortened-url">
<center><img src="images/loader.gif"></center>
</span>
</div>
<br>
<div>
<a href="submit.php" class="bsubmit">Submit a link</a>
<div class="combined"><table width="100%"><tr><td width="20%"><a href="submit.php"><img src="images/http.jpg" width="50px" height="50px"/></a></td><td width="80%"><div class="hag">any interesting: news, article, blog post, video, photo...</div></td></tr></table></div>
</div>
</div>
<?
include_once 'tracker/tracker.php';
include_once 'template/footer.php';
?>
