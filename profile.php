<? 

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
			'<span style="color: $1">$2</span>','<div class="inimg" style="max-width:150px;max-height:150px;"><img src="$1" alt="User posted image" title="User posted image" style="max-width:150px;max-height:150px;"/></div>', '<span style="font: $1">$2</span>');
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
 
$profile = $_GET['user'];
include_once 'init.php';
$sql="SELECT * FROM users WHERE username='$profile'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result);
if (!$rows) {
header('Location: index.php');
die();
}
include_once 'template/header.php';

?>


<?php 
$sql2="SELECT * FROM users WHERE username = '$profile'";
$result2=mysql_query($sql2);
if($row=mysql_fetch_assoc($result2)){
$facer = Gravatar($row['uid']);
?>
<title><?=$row['username']?>'s Profile | Tech News</title>
<div id="sidebar">
<div class="tn-panel">
<div class="img-username">
<div class="user-title">
<a href="<?=$row['username']?>" class="fullname"><?=$row['mname']?></a>
<a href="<?=$row['username']?>" class="username"><?=$row['username']?></a>
</div>
</div>
<?
$sql="SELECT * FROM users WHERE username='$profile' LIMIT 0,1";
$result=mysql_query($sql);
while ($rows = mysql_fetch_array($result)){
if(($_COOKIE['uid'] != $rows['uid']) && logged_in()){
$res = mysql_query("SELECT * FROM follower_id WHERE userid = ".$_COOKIE['uid']." AND followerid = ".$rows['uid']);
$check_result = @mysql_num_rows(@$res);
if($check_result > 0)
{?>
<span class="buttons" id="button_<?php echo $rows['uid']?>"><a class="btn-following"  id="webut" href="javascript:;">-Following</a></span>
<?php
}
else
{?>
<span class="buttons" id="button_<?php echo $rows['uid']?>"><a class="btn-follow"  id="webut" href="javascript:;">+Follow</a></span>
<?php
}}
?>
<?
$sql3="SELECT * FROM submit_link WHERE name = '$profile'";
$result3=mysql_query($sql3);
$count = mysql_num_rows($result3);
$ress = mysql_query("SELECT * FROM follower_id WHERE followerid = ".$rows['uid']);
$fresult = @mysql_num_rows(@$ress);
echo '<div class="bio"><img src='.$facer.' width="50px" height="50px" class="userImage"><br> &nbsp;<span class="XCa ">Followers:</span><span class="Yta Zta">'.' '. $fresult.'</span><br> &nbsp;<span class="XCa ">Link karma: </span><span class="Yta Zta">'.$count.'</span></div>';
}
}
?>

</div>
<div>
<a href="submit.php" class="bsubmit">Submit a link</a>
<div class="combined"><table width="100%"><tr><td width="20%"><a href="submit.php"><img src="images/http.jpg" width="50px" height="50px"/></a></td><td width="80%"><div class="hag">any interesting: news, article, blog post, video, photo...</div></td></tr></table></div>
</div>
</div>

<div id="main">
<?
$sql1="SELECT *,UNIX_TIMESTAMP() - datetime AS TimeSpent FROM submit_link WHERE name = '$profile' AND topic <>'' ORDER BY id desc LIMIT 0,10";
$result1=mysql_query($sql1);
if(mysql_num_rows($result)>0){?>
<?while($rows=mysql_fetch_array($result1)){
		$total = $rows['article_dislikes'] + $rows['article_likes']; //this is the net result of voting up and voting down
$check = datefor($rows['datetime'], $rows['TimeSpent']);
$id = $rows['id'];	
$uid = 	$rows['email'];	
$url = rawurldecode($rows['site']);
$parsed = parse_url($url);

?>
<div class="sommr">
<div class="holder">
<div id="leftbox">
 	<a href="javascript:void(0);" class="like" onclick="like_add(<?php echo $rows['id'];?>)">Up</a>
<span class="vote-count" onload="total_votes(<?php echo $rows['id'];?>)" id="article_<?php echo $rows['id'];?>"><?=$total?></span>
	<a href="javascript:void(0);" class="unlike" onclick="dislike_add(<?php echo $rows['id'];?>)">Down</a>
</div>

<a href="<?=$rows['name']?>">
<img src="<?=$facer?>" width="40px" height="40px" alt="" class="pilot"></a>
<?
$noc = Noofcomments($id);
?>
<div class="details">
<header><h3 class="headchk"><a href="<?=$rows['name']?>" class="Sg Ob Tc"><?=$rows['name']?></a></h3><span class="maui">&nbsp;-&nbsp; <span title="Time of post"><? echo $check; ?></span>&nbsp;-&nbsp; <span class="pl" title="Site" ><small>(<? echo $parsed['host']; ?>)</small>
</span><span class="comter">
<?$nou = Noofurls($rows['name']);
if($nou > 30){?>
<span class="badge moderator">TC</span>
<?}?>


<strong><a href="comment.php?id=<? echo $rows['id'];?>"><?=$noc ?> comments</a></strong></span></header>
</div>
<div class="ci">
<div class="wm"><a href="redirect.php?url=<? echo $url;?>" rel="nofollow" target="new" class="yofu"><?= stripslashes($rows['topic']); ?></a></div>
</div>

</div>
<div id="message_<?php echo $rows['id'];?>" class="msg">
</div>
</div>
<?php
	}}else{?>
	<br><h2>No URL Submitted</h2>
	<?}	
$sqla = "SELECT *,UNIX_TIMESTAMP() - datetime AS TimeSpent FROM submit_link WHERE name = '$profile' AND topic ='' ORDER BY id desc LIMIT 0,10";
$result = mysql_query($sqla);
	

if(mysql_num_rows($result)>0){?>
<br>
<h1>Posts</h1>
<?while($rows=mysql_fetch_array($result)){
		$total = $rows['article_dislikes'] + $rows['article_likes']; //this is the net result of voting up and voting down
$check = datefor($rows['datetime'], $rows['TimeSpent']);
$id = $rows['id'];	
$uid = 	$rows['email'];	


?>
<div class="sommr">
<div class="holder">
<div id="leftbox">

 	<a href="javascript:void(0);" class="like" title="voteUp" onclick="like_add(<?php echo $rows['id'];?>)">Up</a>
<span class="vote-count" onload="total_votes(<?php echo $rows['id'];?>)" id="article_<?php echo $rows['id'];?>"><?=$total?></span>
	<a href="javascript:void(0);" class="unlike" title="voteDown" onclick="dislike_add(<?php echo $rows['id'];?>)">Down</a>
</div>
<a href="<?=$rows['name']?>">
<img src="<?=$facer?>" width="40px" height="40px" alt="" class="pilot"></a>
<?
$noc = Noofcomments($id);
?>
<div class="details">
<header><h3 class="headchk"><a href="<?=$rows['name']?>" class="Sg Ob Tc"><?=$rows['name']?></a></h3><span class="maui">&nbsp;-&nbsp; <span title="Time of post"><? echo $check; ?></span><span class="comter">
<?$nou = Noofurls($rows['name']);
if($nou > 30){?>
<span class="badge moderator">TC</span>
<?}?>
<strong><a href="comment.php?id=<? echo $rows['id'];?>"><?=$noc ?> comments</a></strong></span></header>
</div>

<div class="ci">
<div class="wm"><a href="comment.php?id=<? echo $id;?>" target="new" class="yofu"><?= stripslashes($rows['title']);?></a></div>

<div class="gaa" style="max-height:150px !important;">
<? echo parsePost($rows['content']);?>
</div>

</div>


</div>

<div id="message_<?php echo $rows['id'];?>" class="msg">
</div>
</div>





	
<?	}}else{?>
<br><h2>No Posts Submitted</h2>
</div>
<?}
	include_once 'tracker.php';
	include_once 'template/footer.php';
?>