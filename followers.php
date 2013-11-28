<?php
  include_once 'init.php';
include_once 'template/header.php';
 if(logged_in()){
?>
<title>Latest News | Tech News</title>
<div id="main">
<br>

<h2>Followers Post</h2>
<div id="updates">
<?
	$tbl_name="submit_link";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 2;

	/*
	   First get total number of rows in data table.
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE uid=(select followerid from follower_id where userid = ".$_COOKIE['uid'].") ";	
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];

	/* Setup vars for query. */
	$targetpage = "followers.php"; 	//your file name  (the name of this file)
	$limit = 15; 								//how many items to show per page
	$page = $_GET['page'];
	if($page)
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0

	/* Get data. */
	$sql = "select * from submit_link sub, follower_id foll where sub.topic <>' ' and sub.uid = foll.followerid and userid=".$_COOKIE['uid']." ORDER BY datetime DESC LIMIT $start, $limit";
	$result = mysql_query($sql);

	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1

	
	$pagination = "";
	if($lastpage > 1)
	{
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1)
			$pagination.= "<a href=\"$targetpage?page=$prev\">« previous</a>";
		else
			$pagination.= "<span class=\"disabled\">« previous</span>";

		//pages
			 $counter = $lastpage; 	
				
		//next button
		if ($page < $counter - 1)
			$pagination.= "<a href=\"$targetpage?page=$next\">next »</a>";
		else
			$pagination.= "<span class=\"disabled\">next »</span>";
		$pagination.= "</div>\n";

if ($page > $lastpage){
header( 'Location:error.php');
}
	}
if(mysql_num_rows($result)>0){
while($rows=mysql_fetch_array($result)){
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
	<a href="javascript:void(0);" class="unlike" title="voteDown" onclick="dislike_add(<?php echo $rows['id'];?>)">Down</a>
</div>

<a href="<?=$rows['name']?>">
<img src="<?=$fac?>" width="40px" height="40px" alt="" class="pilot"></a>
<?
$noc = Noofcomments($id);
?>
<div class="details">
<header><h3 class="headchk"><a href="<?=$rows['name']?>" class="Sg Ob Tc"><?=$rows['name']?></a></h3><span class="maui">&nbsp;-&nbsp; <span title="Time of post"><? echo $check; ?></span>&nbsp;-&nbsp; <span class="pl" title="Site"><small>(<? echo $parsed['host']; ?>)</small>
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
	}}
?>
<br/><br/>
<div><?=$pagination?></div>
</div>
</div>
<div id="sidebar">
<br>
<div>
<a href="submit.php" class="bsubmit">Submit a link</a>
<div class="combined"><table width="100%"><tr><td width="20%"><a href="submit.php"><img src="images/http.jpg" width="50px" height="50px"/></a></td><td width="80%"><div class="hag">any interesting: news, article, blog post, video, photo...</div></td></tr></table></div>
</div>
</div>

<?

}else{
header('Location: index.php');
}
include 'tracker.php';
include_once 'template/footer.php';
?>