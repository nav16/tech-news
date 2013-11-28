<?php
 include_once 'init.php';
if(!logged_in()){
?>
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
			
<a href="index.php" class="button home">Top</a>
<a href="news.php" class="button flag">New</a>
<a href="readposts.php" class="button add">Posts</a> 		
<a href="login.php" class="button add">Login</a>
<a href="login.php" class="button delete">Sign Up</a>

<?}else{

}?>
</div>
</div>
</div>

<div id="container">
<div id="content-wrap">
<div id="content">
<table>
<tr>
<td>

<div style="margin-top:20px; width:450px;">
<h2>Sign Up</h2>
<br>
<div guidedhelpid="sharebox" class="Fm g-s-Ma-ba Ma Nf ke"  decorated="true">
 <form action="registeract.php" method="post" id="register_form">
<div class="Je">  
 <table width="100%" border="0" cellpadding="3" cellspacing="1"> 
<tr><td width="20%"><label>Username*</label></td><td>:</td><td><input type="name" name="register_name" id="name" placeholder="eg: navneetpandey" size="45"/></td></tr>
 <tr><td width="20%"><label>Full Name*</label></td><td>:</td><td><input type="name" name="register_mname" id="mname" placeholder="eg: Navneet Pandey" size="45"/></td></tr>
 <tr>
<td width="20%"><label>Email*</label></td><td>:</td><td><input type="email" name="register_email" id="email" placeholder="eg: nava@gmail.com" size="45"/></td></tr>
<tr><td width="20%"><label>Password*</label></td><td>:</td><td><input type="password" name="register_password" id="pass" placeholder="Enter Your Password" size="45"/></td></tr></table>
</div>

<div class="Ng">
<div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td valign="top" class="bw">
<button class="a-f-e c-b c-b-da pm Nl c-b-E sign_button" id="submit">Sign Up</button><span id="msagbox" style="display:none; font-size:12px;"></span>
</td></tr></tbody></table></div>
</div>
 </form>
</div>
</div>
</td>
<td>OR</td>
<td>

<div style="margin-top:-70px; width:400px;">
<h2>Login</h2>
<br>
<div guidedhelpid="sharebox" class="Fm g-s-Ma-ba Ma Nf ke"  decorated="true">
<form method="post" action="ajax_login.php" id="login_form">
<div class="Je">
 <table width="100%" border="0" cellpadding="3" cellspacing="1">
 <tr>
<td width="20%"><label>Email*</label></td><td>:</td><td><input type="email" name="login_email" placeholder="eg: nava@gmail.com" id="username" size="45"/></td></tr>
<tr><td width="20%"><label>Password*</label></td><td>:</td><td><input type="password" name="login_password" id="password" placeholder="Enter Your Password" size="45"/></td></tr></table>
</div>
<div class="Ng">
<div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td valign="top" class="bw">
<button class="a-f-e c-b c-b-da pm Nl c-b-E login_button" id="submit">Login</button><span id="msgbox" style="display:none; font-size:12px;"></span>
</td></tr></tbody></table>
</div>
</div>
</form>
 </div>
 </div>
</td>
</tr>
</table>
 <br>
<div id="descpr"><b>Yes, just these many fields.</b> You'll have to join to see the full features.</div>
<?
}else{
header("Location:index.php");
}
include 'tracker.php';
?>