<?
  include_once 'init.php';?>
<!DOCTYPE html>
<head>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type = "text/javascript" src="js/functions.js"></script>

 </head>
 <body>

<div id="bar">

<div id="innerbar">

<div id="search" name="search">	
 <table width="40%" border="0" cellpadding="3" cellspacing="1">
<form id="search" name="search">
<input type="text" placeholder="Type To Search" name="query" onkeyup="find();" list="results" size="40" autocomplete="off">
</form>
<div id="results">  </div></table>
</div>
<div id="nav">

  <?php
include 'connection.php';
		 if(logged_in()){
$user_data = user_data('username', 'email');
$email=$user_data['email'];
$lowercase = strtolower($email);
$imagecode = md5( $lowercase );
$face="http://www.gravatar.com/avatar.php?gravatar_id=$imagecode";
echo '<a href="'.$user_data['username'].'"><span class="button u"><img src='.$face.' width="28" height="28" class="header"/>Hello,'.' '. $user_data['username'].'</span></a>';?>

<a href="index.php" class="button home">Top</a>
<a href="news.php" class="button flag">New</a>
<a href="readposts.php" class="button add" id="buuu">Posts</a>
<a href="submit.php" class="button" style="top:2px;">Submit</a>

<span class="dropdown">
	<a class="button sss">.</a>
	<span class="submenu" style="display: none; ">

	  <ul class="root">
	    
	    <li >
	      <a href="<?=$user_data['username']?>" >Profile</a>
	    </li>
	 
	    <li>
	      <a href="#feedback">Send Feedback</a>
	    </li>



	    <li>
	      <a href="logout.php">Sign Out</a>
	    </li>
	  </ul>
	</span>
	</span>
<?}
?>
</div>
</div>
</div>

<div id="container">
<div id="content-wrap">
<div id="content">


<?
if(logged_in()){
$user_data = user_data('username');
?>
<title>Submit | Tech News</title>
    <link href="css/editor.css" rel="stylesheet" type="text/css" />
	<script src="js/editor.js" type="text/javascript"></script>
<div id="main">



<script type="text/javascript">
/* <![CDATA[ */
$(document).ready(function(){
	$("#tabs li").click(function() {
		//	First remove class "active" from currently active tab
		$("#tabs li").removeClass('active');

		//	Now add class "active" to the selected/clicked tab
		$(this).addClass("active");

		//	Hide all tab content
		$(".tab_content").hide();

		//	Here we get the href value of the selected tab
		var selected_tab = $(this).find("a").attr("href");

		//	Show the selected tab content
		$(selected_tab).fadeIn();

		//	At the end, we add return false so that the click on the link is not executed
		return false;
	});
});
/* ]]> */
</script>
<div id="tabs_wrapper">
	<div id="tabs_container">
		<ul id="tabs">
			<li class="active"><a href="#tab1">Link</a></li>
			<li><a class="icon_accept" href="#tab2">Post</a></li>
			
		</ul>
	</div>
	<div id="tabs_content_container">
		<div id="tab1" class="tab_content" style="display: block;">
				
	<script type="text/javascript">
$(function() {
function fetchUrl() {
var url = $("#link").val();
if (url != "") {
$("#btsubmit").attr("disabled", "disabled");
$("#btsubmit").css("color", "#999");
$("#btsubmit").css("border-color", "#999");
$("#error").fadeOut('slow');
$.ajax({
type: "POST",
url: "fetch_url.php",
data: "url="+$("#link").val(),
success: function(msg) {
$("input[name=title]").val(msg);							
}});} else {$("input[name=title]").val();
}}$("#btsubmit").click(function() {
fetchUrl();
});
});
</script>

<div class="Cla" >

<img src="<?=$face?>" width="48px" height="48px" class="Ol Rf gS Bla">

<div guidedhelpid="sharebox" class="Fm g-s-Ma-ba Ma Nf ke" style="width:497px;" decorated="true">
<div class="Je">
<div id="descpr"><b>You are submitting a link.</b> The key to a successful submission is interesting content and a descriptive title.</div>
<div id="jome">
<div class="ze point"></div>
<form action="submitact.php" method="post" id="submit_form">
 <table width="40%" border="0" cellpadding="3" cellspacing="1">
<tr><td width="15%"><label>URL</label></td><td>:</td><td><input type="url" name="url" id="link" size="77" autocomplete="off" placeholder="URL Of Post"/></td></tr>
<tr><td></td><td></td><td><span id="btsubmit">Check Url</span></td></tr>
<tr>
<td width="15%"><label>Title</label></td><td>:</td><td>	<div id="hidden">
<div id="detail" class="clear"><input type="text" name="title" id="title" size="77" autocomplete="off" placeholder="Title Of Post"/>	</div>
</div></td></tr>
</table>
<br />
</div>
</div>
<div class="Ng">
<div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td valign="top" class="bw">
<button class="a-f-e c-b c-b-da pm Nl c-b-E news_button" id="submit" style="-webkit-user-select: none; " >Submit Link</button><span id="msagbox" style="display:none; font-size:12px;"></span></td></tr></tbody></table></div>
</div>
</div>
 </form>
</div>
		</div>
		<div id="tab2" class="tab_content">
	
			<div class="Cla">

<img src="<?=$face?>" width="48px" height="48px" class="Ol Rf gS Bla">

<div guidedhelpid="sharebox" class="Fm g-s-Ma-ba Ma Nf ke"  decorated="true">
<div class="Je">
<div id="descpr"><b>
		You are submitting a text-based post.</b> Speak your mind. A title is required, you can insert image and video too.</div>
<div class="ze point"></div>
<div id="jome" class="view" scroll="no">
<form action="postact.php" method="post" id="post_form" onsubmit="doCheck();"> 
<table width="60%" border="0" cellpadding="3" cellspacing="1">
<tr>
<label>Title</label>
<td width="100%"><input type="text" name="title" id="titl" size="86" placeholder="Enter suitable title"/></td></tr>
<tr>
<td width="65%"><div class="richeditor">
		<div class="editbar">
			<button title="bold" onclick="doClick('bold');" type="button"><b>B</b></button>
			<button title="italic" onclick="doClick('italic');" type="button"><i>I</i></button>
			<button title="underline" onclick="doClick('underline');" type="button"><u>U</u></button>
			<button title="hyperlink" onclick="doLink();" type="button" style="background-image:url('images/url.gif');"></button>
			<button title="image" onclick="doImage();" type="button" style="background-image:url('images/img.gif');"></button>
			<button title="list" onclick="doClick('InsertUnorderedList');" type="button" style="background-image:url('images/icon_list.gif');"></button>
			<button title="color" onclick="showColorGrid2('none')" type="button" style="background-image:url('images/colors.gif');"></button><span id="colorpicker201" class="colorpicker201"></span>
			<button title="quote" onclick="doQuote();" type="button" style="background-image:url('images/icon_quote.png');"></button>
			<button title="youtube" onclick="doVideo();" type="button" style="background-image:url('images/icon_youtube.gif');"></button>
			<button title="switch to source" type="button" onclick="javascript:SwitchEditor()" style="background-image:url('images/icon_html.gif');"></button>
		</div>
		<div class="container" scroll="no">
		<textarea id="conten" name="conten" style="style='max-height:1000px;';width:100%; min-height:50px;"></textarea>
		</div>
	</div>
	<script type="text/javascript">
		initEditor("conten", true);
	</script>
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
		</div>
		
	</div>
</div>


</div>
<?}else{
header("Location:login.php");
}
include_once 'template/footer.php';
include 'tracker.php';
?>