<?
 include_once 'init.php'; 
$user_data = user_data('uid', 'username', 'email');
$uid = $user_data['uid'];
$name =  $user_data['username'];
$email =  $user_data['email'];

$title=mysql_real_escape_string(htmlentities($_POST['titl']));
$content=mysql_real_escape_string(htmlentities($_POST['conten']));
$IP = $_SERVER['REMOTE_ADDR'];

if (!$title | !$content) 
   {
 		echo 'Complete all the required fields';
		exit();
 	}
if(strlen($title) < 20){
echo 'Title less than 20 characters';
exit();
}
if(strlen($content) < 160){
echo 'Content less than 160 characters';
exit();
}
$sql1 ="SELECT id FROM submit_link WHERE title ='$title'";
$result=mysql_query($sql1);
$sitecheck = mysql_num_rows($result);
if($sitecheck > 0){
while($rows=mysql_fetch_array($result)){
$id = $rows['id'];
echo '<a href="comment.php?id='.$id.'">Already Submitted</a>';
exit();
}}

$datetime=time(); //create date time
	
     
	$sql="INSERT INTO submit_link (title, name, datetime, content, IP, email, uid)VALUES('$title', '$name', '$datetime', '$content', '$IP', '$email', '$uid')";
	$result=mysql_query($sql);

	if($result){
	echo 'yes';
	}else {
	echo "ERROR";
	}
    
   
mysql_close();
?>