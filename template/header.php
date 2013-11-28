<!DOCTYPE html>
<head>

<link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/share.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type = "text/javascript" src="js/functions.js"></script>
<script type = "text/javascript" src="js/like.js"></script>
 </head>
 <body>

<div id="bar">

<div id="innerbar">
<span class="site-title">Tech News</span>
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
		 if(!logged_in()){?>
			
<a href="index.php" class="button home">Top News</a>
<a href="news.php" class="button flag">Latest</a>
<a href="login.php" id="opshare" class="button add">Login</a>

<div class="getshare" style="display:none; margin-left:-108px;">
<div style="margin-top:20px; position:relative;">
<div guidedhelpid="sharebox" class="Fm g-s-Ma-ba Ma Nf ke"  decorated="true">
<form method="post" action="ajax_login.php" id="login_form">
<div class="Je">
 <table width="100%" border="0" cellpadding="3" cellspacing="1">
 <tr>
<td width="20%"><label>Email*</label></td><td>:</td><td><input type="email" name="login_email" placeholder="eg: nava@gmail.com" id="username" size="45"/></td></tr>
<tr><td width="20%"><label>Password*</label></td><td>:</td><td><input type="password" name="login_password" id="password" placeholder="Enter Your Password" size="45"/></td></tr></table>
 <div class="beeperNu"></div>
</div>
<div class="Ng">
<div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td valign="top" class="bw">

<button class="a-f-e c-b c-b-da pm Nl c-b-E login_button" id="submit">Login</button><span id="msgbox" style="display:none; font-size:12px;"></span>

</td></tr></tbody></table></div>
</div>

</form>

 </div>
</div>
</div>

<a href="login.php" class="button delete">Sign Up</a>

<?}else{

$user_data = user_data('username', 'email');
$email=$user_data['email'];
$lowercase = strtolower($email);
$imagecode = md5( $lowercase );
$face="http://www.gravatar.com/avatar.php?gravatar_id=$imagecode";
echo '<a href="'.$user_data['username'].'"><span class="button u"><img src='.$face.' width="28" height="28" class="header"/>Hello,'.' '. $user_data['username'].'</span></a>';?>

<a href="index.php" class="button home">Top News</a>
<a href="news.php" class="button flag">Latest</a>
<a href="followers.php" class="button add" id="buuu">Followers</a>	
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