<?php
  include_once 'init.php';
include_once 'template/header.php';
?>
<title>Tech News - What's going on in the tech field</title>
<div id="main">		
<h2>News On Top</h2>
<div id="updates">

<?
	$tbl_name="submit_link";		//your table name
	

	/* Get data. */
	$sql = "SELECT *,UNIX_TIMESTAMP() - datetime AS TimeSpent FROM $tbl_name WHERE article_likes > 2 AND topic <>'' ORDER BY (((article_likes)-1) / pow(((datetime / 3600)+2), 1)) DESC";
	$result = mysql_query($sql);

while($rows = mysql_fetch_array($result)){
		$total = $rows['article_dislikes'] + $rows['article_likes']; //this is the net result of voting up and voting down
$check = datefor($rows['datetime'], $rows['TimeSpent']);
$id = $rows['id'];	
$uid = 	$rows['email'];	
$url = rawurldecode($rows['site']);
$parsed = parse_url($url);
$fac = Gravatar($rows['uid']);
?>
<div class="sommr">
<div class="holder">

<div id="leftbox">

 	<a href="javascript:void(0);" class="like" title="voteUp" onclick="like_add(<?php echo $rows['id'];?>)">Up</a>
<span class="vote-count" onload="total_votes(<?php echo $rows['id'];?>)" id="article_<?php echo $rows['id'];?>"><?=$total?></span>
	<a href="javascript:void(0);" title="voteDown" class="unlike" onclick="dislike_add(<?php echo $rows['id'];?>)">Down</a>
</div>



<a href="<?=$rows['name']?>">
<img src="<?=$fac?>" width="40px" height="40px" alt="" class="pilot"></a>
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
<div class="wm"><a href="redirect.php?url=<? echo $url;?>" rel="nofollow" target="new" class="yofu"><?= stripslashes($rows['topic']); ?>
</a></div>
<?=$scores?>
</div>

</div>
<div id="message_<?php echo $rows['id'];?>" class="msg">
</div>
</div>
<?php
	}
?> 
<br/><br/>
<div style="margin-left:250px;"><?=$pagination?></div>
</div>
</div>
<div id="sidebar">
<br>
<div>
<a href="submit.php" class="bsubmit">Submit a link</a>
<div class="combined"><table width="100%"><tbody><tr><td width="20%"><a href="submit.php"><img src="images/http.jpg" width="50px" height="50px"></a></td><td width="80%"><div class="hag">any interesting: news, article, blog post, video, photo...</div></td></tr></tbody></table></div>
</div>
<div>
<h3>Share Directly</h3>
Use Bookmarklet-&gt; <a href="javascript:location.href='http://technews.iteching.info/send.php?link='
                                +encodeURIComponent(location.href)  
                                +'&title='+encodeURIComponent(document.title)" target="new">+Tech News</a>
</div>
<?
include 'tracker.php';
include_once 'template/footer.php';
?>