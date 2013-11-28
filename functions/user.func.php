<?php
	function logged_in(){
	return isset($_COOKIE['uid']);
	}
	function Gravatar($id)
	{
	   $query = mysql_query("SELECT email FROM `users` WHERE `uid` = '$id'") or die(mysql_error());
	   $row=mysql_fetch_array($query);
	   if(!empty($row))
	   {
	    $email=$row['email'];
        $lowercase = strtolower($email);
        $imagecode = md5( $lowercase );
		$fkimg = urlencode('http://technews.iteching.info/images/default.png');
		$data="http://www.gravatar.com/avatar/$imagecode?d=$fkimg";
	    return $data;
		}
	}
	function login_check($email, $password){
		$email = mysql_real_escape_string(strtolower($email));
		//$name = mysql_real_escape_string(strtolower($name));
		$login_query = mysql_query("SELECT COUNT('uid') as `count`, `uid` FROM `users` WHERE `email` = '$email' AND `password` = '".md5($password)."'");
		return (mysql_result($login_query, 0) == 1) ? mysql_result($login_query, 0, 'uid') : false;
	
	}
	function user_data(){
		$args = func_get_args();
		$fields = '`'.implode('`, `', $args).'`';
		$query = mysql_query("SELECT $fields FROM `users` WHERE `uid` = ".$_COOKIE['uid']);
		$query_result = mysql_fetch_assoc($query);
		foreach($args as $field){
		$args[$field] = $query_result[$field];
			
		}
	return $args;	
	}
	function user_register($email,$name, $password, $mname){
		$email = mysql_real_escape_string(strtolower($email));
		$name = mysql_real_escape_string(strtolower($name));
        $mname = mysql_real_escape_string($mname);
		mysql_query("INSERT INTO `users` (email, username, password, mname) VALUES('$email', '$name', '".md5($password)."', '$mname')");
		return mysql_insert_id();	
	}
	function user_exists($email){
		$email = mysql_real_escape_string(strtolower($email));
		$query = mysql_query("SELECT COUNT('uid') FROM `users` WHERE `email` = '$email'");
		return (mysql_result($query, 0) == 1) ? true : false;
	}
	function username_exists($name){
		$name = mysql_real_escape_string(strtolower($name));
		$query = mysql_query("SELECT COUNT('uid') FROM `users` WHERE `username` = '$name'");
		return (mysql_result($query, 0) == 1) ? true : false;
	}
	function userid_exists($uid){
		$uid = (int)$uid;
		$query = mysql_query("SELECT COUNT('uid') FROM `users` WHERE `uid` = '$uid'");
		return (mysql_result($query, 0) == 1) ? true : false;
	}
	function Noofcomments($pid){
		$sql = "SELECT * FROM messages WHERE pid = '$pid'";
		$result = mysql_query($sql);
		$noc = mysql_num_rows($result);
		return $noc;
}
function Noofurls($uid){
		$sql = "SELECT * FROM submit_link WHERE name = '$uid'";
		$result = mysql_query($sql);
		$nou = mysql_num_rows($result);
		return $nou;
}
?>