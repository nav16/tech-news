<?php

class Wall_Updates {
	
     // Updates   	
	  public function Updates($pid) 
	{
	$pid =(int)$pid; 
	    $query = mysql_query("SELECT M.msg_id, M.uid_fk, M.message, M.created, U.username FROM messages M, users U  WHERE M.uid_fk=U.uid and M.pid='$pid' order by M.msg_id desc ") or die(mysql_error());
         while($row=mysql_fetch_array($query))
		$data[]=$row;
	     if(!empty($data))
		{
			 return $data;
		}
		
    }
	//Comments
	   public function Comments($msg_id) 
	{
	$msg_id = (int)$msg_id;
	    $query = mysql_query("SELECT C.com_id, C.uid_fk, C.comment, C.created, U.username FROM comments C, users U WHERE C.uid_fk=U.uid and C.msg_id_fk='$msg_id' order by C.com_id desc LIMIT 0,2") or die(mysql_error());
	   while($row=mysql_fetch_array($query))
	    $data[]=$row;
        if(!empty($data))
		{
       return $data;
         }
	}
		public function fetchcomm($msg_id)
	{
		$msg_id = (int)$msg_id;
		$query = mysql_query("SELECT C.com_id, C.uid_fk, C.comment, C.created, U.username FROM comments C, users U WHERE C.uid_fk=U.uid and C.msg_id_fk='$msg_id' order by C.com_id desc") or die(mysql_error());
		while($row=mysql_fetch_array($query))
		$data[]=$row;
		if(!empty($data))
		{
		return $data;
		 }
	}
	
	public function CommentsColl($msg_id) 
	{
	$msg_id = (int)$msg_id;
	    $query = mysql_query("SELECT C.com_id, C.uid_fk, C.comment, C.created, U.username FROM comments C, users U WHERE C.uid_fk=U.uid and C.msg_id_fk='$msg_id' order by C.com_id asc") or die(mysql_error());
	   $data=mysql_num_rows($query);	    
       return $data;
    }
	
	public function ShowComments($msg_id)
	{
		$msg_id = (int)$msg_id;
		$query = mysql_query("SELECT C.com_id, C.uid_fk, C.comment, C.created, U.username FROM comments C, users U WHERE C.uid_fk=U.uid and C.msg_id_fk='$msg_id' order by C.com_id desc LIMIT 2,1000") or die(mysql_error());
		while($row=mysql_fetch_array($query))
		$data[]=$row;
		if(!empty($data))
		{
		return $data;
		 }
	}
	
	//Avatar Image
	public function Gravatar($uid) 
	{
	$uid = (int)$uid;
	    $query = mysql_query("SELECT email FROM `users` WHERE uid='$uid'") or die(mysql_error());
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

	//Insert Update
	public function Insert_Update($uid, $update, $pid) 
	{  
	$uid = (int)$uid;
	$update=htmlentities(mysql_real_escape_string($update));
	$pid = (int)$pid;
	   $time=time();
	  	   $ip=$_SERVER['REMOTE_ADDR'];
        $query = mysql_query("SELECT msg_id,message FROM `messages` WHERE uid_fk='$uid' order by msg_id desc limit 1") or die(mysql_error());
        $result = mysql_fetch_array($query);
		
        if ($update!=$result['message']) {
            $query = mysql_query("INSERT INTO `messages` (message, uid_fk, pid, ip,created) VALUES ('$update', '$uid', '$pid', '$ip','$time')") or die(mysql_error());
            $newquery = mysql_query("SELECT M.msg_id, M.uid_fk, M.message, M.created, U.username FROM messages M, users U where M.uid_fk=U.uid and M.pid='$pid' order by M.msg_id desc limit 1 ");
            $result = mysql_fetch_array($newquery);
			 return $result;
        } 
		else
		{
			 return false;
		}
      
    }
	//Insert Comments
	public function Insert_Comment($uid,$msg_id,$comment) 
	{
	$uid = (int)$uid;
	$msg_id = (int)$msg_id;
		$comment=htmlentities(mysql_real_escape_string($comment));
	   	$time=time();
	   $ip=$_SERVER['REMOTE_ADDR'];
        $query = mysql_query("SELECT com_id,comment FROM `comments` WHERE uid_fk='$uid' and msg_id_fk='$msg_id' order by com_id desc limit 1 ") or die(mysql_error());
        $result = mysql_fetch_array($query);
    
		if ($comment!=$result['comment']) {
            $query = mysql_query("INSERT INTO `comments` (comment, uid_fk,msg_id_fk,ip,created) VALUES ('$comment', '$uid','$msg_id', '$ip','$time')") or die(mysql_error());
            $newquery = mysql_query("SELECT C.com_id, C.uid_fk, C.comment, C.msg_id_fk, C.created, U.username FROM comments C, users U where C.uid_fk=U.uid and C.uid_fk='$uid' and C.msg_id_fk='$msg_id' order by C.com_id desc limit 1 ");
            $result = mysql_fetch_array($newquery);
         
		   return $result;
        } 
		else
		{
		return false;
		}
    }	
}

?>