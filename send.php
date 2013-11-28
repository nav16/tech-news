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
$topic=mysql_real_escape_string(htmlentities($_GET['title']));
$site=mysql_real_escape_string(htmlentities($_GET['link'])); 
?>
<title>Submit | Tech News</title>
<div id="main">

<div id="tabs_wrapper">
	<div id="tabs_content_container">
		<div id="tab1" class="tab_content" style="display: block;">				
<div class="Cla" >

<img src="<?=$face?>" width="40px" height="40px" class="Ol Rf gS Bla">

<div guidedhelpid="sharebox" class="Fm g-s-Ma-ba Ma Nf ke">
<div class="Je">
<div id="descpr"><b>You are submitting a link.</b> The key to a successful submission is interesting content and a descriptive title.</div>
<div id="jome">
<div class="ze point"></div>
<form action="submitact.php" method="post" id="submit_form">
 <table width="40%" border="0" cellpadding="3" cellspacing="1">
<tr><td width="15%"><label>URL</label></td><td>:</td><td><input type="url" name="url" id="link" size="77" autocomplete="off" placeholder="URL Of Post" value="<?=$site?>"/></td></tr>
<tr>
<td width="15%"><label>Title</label></td><td>:</td><td>	<div id="hidden">
<div id="detail" class="clear"><input type="text" name="title" id="title" size="77" autocomplete="off" placeholder="Title Of Post" value="<?=$topic?>"/>	</div>
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
</div></div>
</div> 
</div>
</div>
<?}else{
header("Location:login.php");
}
include_once 'template/footer.php';
include 'tracker.php';
?>