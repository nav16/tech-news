<?php

function parsePost($m){
		// parses the post with bbCode, smilies and also checks the badwords
		// Make sure we cannot ever post HTML 
		//$m = htmlspecialchars($m, ENT_QUOTES);

		// Youtube (to remove, comment out :))
		$yt_f = '/\[youtube\](.*?)\[\/youtube\]/is';
		$yt_r = "<div class=\"inimg\" style=\"max-width:150px;max-height:150px;\"><iframe title=\"YouTube video player\" width=\"100\" height=\"100\" src=\"http://www.youtube.com/embed/$1?rel=0\" frameborder=\"0\" allowfullscreen>Youtube video - [url=http://youtube.com/watch?v=$1]Watch now[/url]</iframe></div>";
		$m = preg_replace($yt_f,$yt_r,$m);
		
		// URLS, images and colours
		$url_f = array('/\[url\](.*?)\[\/url\]/is','/\[url=(.*?)\](.*?)\[\/url\]/is','/\[color=(.*?)\](.*?)\[\/color\]/is','/\[img\](.*?)\[\/img\]/is', '/\[font=(.*?)\](.*?)\[\/font\]/is'); 
		$url_r = array('<a href="$1" target="_blank" title="$1">$1</a>','<a href="$1" target="_blank" title="$1">$2</a>',
			'<span style="color: $1">$2</span>','<div class="inimg" style="max-width:100px;max-height:100px;"><img src="$1" alt="User posted image" title="User posted image" style="max-width:100px;max-height:100px;"/></div>', '<span style="font: $1">$2</span>');
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

 include_once 'init.php';

//require_once("nbbc.php");
//$bbcode = new BBCode;
include_once 'template/header.php';

?>
<title>Read Posts | Tech News</title>

<script type = "text/javascript" src="js/jquery.elastic.js"></script>
<div id="main">
<br>

<?if(logged_in()){?>
<div class="Cla">

<img src="<?=$face?>" width="40px" height="40px" class="Ol Rf gS Bla">

<div guidedhelpid="sharebox" class="Fm g-s-Ma-ba Ma Nf ke"  decorated="true">
<div class="Je">
<div class="ze point"></div>
<div class="hh dw" id="gogo" style="margin-top:10px;">
<div class="Kj bI newsopen" tabindex="0" role="button">Post Something...</div>
</div>

<div id="jome" style="display:none;" class="view" scroll="no">
<form action="postact.php" method="post" id="post_form" onsubmit="doCheck();"> 
<table width="60%" border="0" cellpadding="3" cellspacing="1">
<tr>
<label>Title</label>
<td width="100%"><input type="text" name="title" id="titl" size="94" placeholder="Enter suitable title"/></td></tr>
<tr>
<td width="65%"><div class="richeditor">
	
		<div class="container" scroll="no">
		<textarea id="conten" name="conten" cols="67" style="style='max-height:1000px;';max-width:width: 510px !important; min-height:50px;"></textarea>
		</div>
	</div>
	
</td>
</tr>
<tr><td>(Minimum 160 and Maximum 1000 characters)</td></tr>
</table>

<br />

</div>
</div>
<div class="Ng">
<div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td valign="top" class="bw">
<button class="a-f-e c-b c-b-da pm Nl c-b-E post_button" id="submit" style="-webkit-user-select: none;" onsubmit="doCheck();">Post</button><span id="mgbox" style="display:none; font-size:12px;"></span></td></tr></tbody></table></div>
</div>
</div>

 </form>
 
</div>


<br>

<?}?>

<h2>Read Posts</h2>
<?

	$tbl_name="submit_link";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 2;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE topic =' '";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = "readposts.php"; 	//your file name  (the name of this file)
	$limit = 15; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT *,UNIX_TIMESTAMP() - datetime AS TimeSpent FROM $tbl_name WHERE topic ='' ORDER BY datetime DESC LIMIT $start, $limit";
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
$parsed = parse_url($url);
$fac = Gravatar($rows['uid']);
$title = $rows['title'];
$url = preg_replace("![^a-z0-9]+!i", "-", $title);
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
<header><h3 class="headchk"><a href="<?=$rows['name']?>" class="Sg Ob Tc"><?=$rows['name']?></a></h3><span class="maui">&nbsp;-&nbsp; <span title="Time of post" ><? echo $check; ?></span><span class="comter">
<?$nou = Noofurls($rows['name']);
if($nou > 30){?>
<span class="badge moderator">TC</span>
<?}?>
<strong><a href="comment.php?id=<? echo $rows['id'];?>"><?=$noc ?> comments</a></strong></span></header>
</div>

<div class="ci">
<div class="wm"><a href="comment.php?id=<? echo $id;?>" target="new" class="yofu"><?= stripslashes($rows['title']);?></a></div>

<div class="gaa" style="max-height:96px !important;">
<? echo parsePost(stripslashes(substr($rows['content'], 0, 450)));?>
</div>

</div>

</div>

<div id="message_<?php echo $rows['id'];?>" class="msg">
</div>
</div>

<?php
	}}else{
	echo '<h2>No Post</h2>';
	}
?> 


<center><div><?=$pagination?></div></center>
</div>
<div id="sidebar">
<div>
<a href="submit.php" class="bsubmit">Submit a link</a>
<div class="combined"><table width="100%"><tr><td width="20%"><a href="submit.php"><img src="images/http.jpg" width="50px" height="50px"/></a></td><td width="80%"><div class="hag">any interesting: news, article, blog post, video, photo...</div></td></tr></table></div>
</div>
</div>
<?
include 'tracker.php';
include_once 'template/footer.php';
?>