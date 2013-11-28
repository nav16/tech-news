<?php
include 'init.php';
include_once 'template/header.php';

?>
<title>Latest News | Tech News</title>
<div id="main">
<?if(logged_in() == 9){?>
<script type="text/javascript">
$(document).ready(function()
{
$('a.delete_p').live("click", function(e){

		if(confirm('Are you sure you want to delete this post?')==false)

		return false;
		e.preventDefault();
		var temp    = $(this).attr('id').replace('del_','');	

			$.ajax({
				type: 'get',
				url: 'del.php?id='+ $(this).attr('id').replace('del_',''),
				data: '',
				beforeSend: function(){
				},
				success: function(){

				}
			});
		});
		});
</script>
<?}?>
<?if(logged_in()){?>
<script type="text/javascript">
$(function() {
	function fetchUrl() {
	var url = $("#link").val();if (url != "") {
	$("#btsubmit").attr("disabled", "disabled");
	$("#btsubmit").css("color", "#999");
	$("#btsubmit").css("border-color", "#999");
	$("#error").fadeOut('slow');
	$.ajax({
		dataType: "json",
		type: "POST",
		url: "fetch_url.php",
		data: "url="+$("#link").val(),
		success: function(msg) {
			$("input[name=title]").val(msg.title.title);
			$('.Jee').css('display', '');
			$(".stry").attr('src',msg.images.imgsrc);
		}
	});
} else {
$("input[name=title]").val();
}}
$("#btsubmit").click(function() {fetchUrl();});
});</script>

<div class="Cla" style="margin-top:20px; width: 546px;">

<img src="<?=$face?>" width="40px" height="40px" class="Ol Rf gS Bla">

<div guidedhelpid="sharebox" class="Fm g-s-Ma-ba Ma Nf ke"  decorated="true">
<div class="Je">

<div class="hh dw" id="gogo" style="margin-top:10px;">
<div class="Kj bI newsopen" tabindex="0" role="button">Submit a link...</div>
</div>

<div id="jome" style="display:none;">
<form action="submitact.php" method="post" id="submit_form">
 <table width="40%" border="0" cellpadding="3" cellspacing="1">
<tr><td width="15%"><label>URL</label></td><td>:</td><td><input type="url" name="url" id="link" size="85" autocomplete="off" placeholder="URL Of Post"/></td></tr>
<tr><td></td><td></td><td><span id="btsubmit">Check Url</span></td></tr>
<tr>
<td width="15%"><label>Title</label></td><td>:</td><td>	<div id="hidden">
<div id="detail" class="clear"><input type="text" name="title" id="title" size="85" autocomplete="off" placeholder="Title Of Post"/>	</div>
</div></td></tr>
</table>
<br />
<div class="pba"></div>
</div>
<div class="ze point"></div>
</div>

<div class="Ng">
<div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td valign="top" class="bw">
<button class="a-f-e c-b c-b-da pm Nl c-b-E news_button" id="submit" style="-webkit-user-select: none; " >Submit Link</button><span id="msagbox" style="display:none; font-size:12px;"></span></td></tr></tbody></table></div>
</div>
</div>
 </form>
</div>
<?}?>



<br>

<h2>Latest News</h2>
<div id="updates">
<?
	$tbl_name="submit_link";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 2;

	/*
	   First get total number of rows in data table.
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages['num'];

	/* Setup vars for query. */
	$targetpage = "news.php"; 	//your file name  (the name of this file)
	$limit = 15; 								//how many items to show per page
	$page = $_GET['page'];
	if($page)
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0

	/* Get data. */
	$sql = "SELECT *,UNIX_TIMESTAMP() - datetime AS TimeSpent FROM $tbl_name WHERE topic <>'' ORDER BY datetime DESC LIMIT $start, $limit";
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
	
?>
<div tabindex="-1" class="sommr">
<div class="holder">
<div id="leftbox">

 	<a href="javascript:void(0);" class="like" title="voteUp" onclick="like_add(<?php echo $rows['id'];?>)">Up</a>
<span class="vote-count" onload="total_votes(<?php echo $rows['id'];?>)" id="article_<?php echo $rows['id'];?>"><?=$total?></span>
	<a href="javascript:void(0);" class="unlike" title="voteDown" onclick="dislike_add(<?php echo $rows['id'];?>)">Down</a>
</div>

<a href="<?=$rows['name']?>">
<img src="<?php echo Gravatar($rows['uid']);?>" width="40px" height="40px" alt="" class="pilot"></a>
<?
$noc = Noofcomments($id);
?>
<div class="details">
<header><h3 class="headchk"><a href="<?=$rows['name']?>" class="Sg Ob Tc"><?=$rows['name']?></a></h3><span class="maui">&nbsp;-&nbsp; <span title="Time of post" tabindex="0"><?php echo $check; ?></span>&nbsp;-&nbsp; <span class="pl" title="Site" tabindex="0"><small>(<?=$parsed['host']; ?>)</small>
</span><span class="comter">
<?$nou = Noofurls($rows['name']);
if($nou > 30){?>
<span class="badge moderator">TC</span>
<?}?>
<strong><a href="comment.php?id=<? echo $rows['id'];?>"><?=$noc ?> comments</a></strong></span></header>
</div>

<div class="ci">
<div class="wm"><a href="redirect.php?url=<?=$url;?>" rel="nofollow" target="new" class="yofu"><?=stripslashes($rows['topic']); ?></a></div>
</div>
<?if(logged_in() && $_COOKIE['uid'] == 9){?>
<a href="javascript:;" id="del_<?=$id?>" class="delete_p" style="color:#ff0000;">Delete</a>
<?}
?>
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
include 'tracker.php';
include_once 'template/footer.php';
?>