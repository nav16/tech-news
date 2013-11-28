<?
/*Check URL validation*/
 include_once 'init.php';
 if(logged_in()){
$user_data = user_data('uid', 'username', 'email');
$uid = $user_data['uid'];
$name =  $user_data['username'];
$email =  $user_data['email'];

$topic=mysql_real_escape_string($_POST['title']);
$site=mysql_real_escape_string($_POST['link']);
$IP = $_SERVER['REMOTE_ADDR'];
if (!$topic | !$site ) 
   {
 		echo 'You did not complete all of the required fields';
		exit();
 	}

$urlregex = "^(https?|ftp)\:\/\/([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*(\:[0-9]{2,5})?(\/([a-z0-9+\$_-]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?\$";
if (!eregi($urlregex, $site)){
echo "URL is not valid";
exit();
} 
/*
if (!filter_var($site, FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED)){
echo "URL is not valid";
exit();
}*/


$topic = mb_convert_encoding($topic, "HTML-ENTITIES", "UTF-8");
	
$site = urlencode($site);

$sql1 ="SELECT id FROM submit_link WHERE site ='$site'";
$result=mysql_query($sql1);
$sitecheck = mysql_num_rows($result);
if($sitecheck > 0){
while($rows=mysql_fetch_array($result)){
$id = $rows['id'];
//echo '<a href='comment.php?id=$id'>Already Exists Click To See</a>';
echo '<a href="comment.php?id='.$id.'">Already Submitted</a>';
exit();
}}

$datetime=time(); //create date time

	function save_image($inPath, $outPath) {
  $in  = fopen($inPath,  "rb");
  $out = fopen($outPath, "wb");

  while (!feof($in)) {
    $read = fread($in, 8192);
    fwrite($out, $read);
  }

  fclose($in);
  fclose($out);
}

// THE ORIGINAL IMAGE TO GET
$image_url = $_POST['img_url'];

// THE IMAGE EXTENSION
$image_type = end(explode(".", $image_url));

// THE NEW FILE NAME
$filename   = '/media/media_'. md5($image_url . $sku).'.'.$image_type;

// THE SAVE PATH
// OUTPUT: /var/www/site/media/catalog/product/FILE_NAME.FILE_TYPE

@chmod($filename, 0644);
// SAVE THIS BIATCH!
save_image($image_url, $filename);
     
	$sql="INSERT INTO submit_link (topic, name, datetime, site, IP, email, uid, img_url)VALUES('$topic', '$name', '$datetime', '$site', '$IP', '$email', '$uid', '$filename')";	
   $result=mysql_query($sql);   
	if($result){
	echo 'yes';
	}else {
	echo "ERROR";
	}
      
mysql_close();
}else{
echo "<a style='color:white !important;' href='login.php'>Login To Continue..</a>";
}
?>