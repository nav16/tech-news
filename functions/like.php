<?php
function article_exists($id){
    $id = (int)$id;
    return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `submit_link` WHERE `id` = $id"), 0) == 0)? false : true;
	
}
 
function previously_liked($id){
	$id = (int)$id;
return (mysql_result(mysql_query("SELECT COUNT(`like_id`) FROM `likes` WHERE `user_id` = ".$_COOKIE['uid']." AND `article_id` = $id"), 0) == 0)? false : true;
	
}

function like_count($id){
	$id = (int)$id;
	return mysql_result(mysql_query("SELECT `article_likes` FROM `submit_link` WHERE `id` = $id"), 0, 'article_likes');
}


function add_like($id){
	$id = (int)$id;
	mysql_query("UPDATE `submit_link` SET `article_likes` = `article_likes` + 1 WHERE `id` = $id");
    mysql_query("INSERT INTO `likes` (`user_id`, `article_id`) VALUES (".$_COOKIE['uid'].", $id)");
	}
	
 //dislikes
 
 function previously_disliked($id){
	$id = (int)$id;
return (mysql_result(mysql_query("SELECT COUNT(`dislike_id`) FROM `dislikes` WHERE `user_id` = ".$_COOKIE['uid']." AND `article_id` = $id"), 0) == 0)? false : true;
}
  
function dislike_count($id){
	$id = (int)$id;
	return mysql_result(mysql_query("SELECT `article_dislikes` FROM `submit_link` WHERE `id` = $id"), 0, 'article_dislikes');
	
	
}

function add_dislike($id){
	$id = (int)$id;
	mysql_query("UPDATE `submit_link` SET `article_dislikes` = `article_dislikes` - 1 WHERE `id` = $id");
    mysql_query("INSERT INTO `dislikes` (`user_id`, `article_id`) VALUES (".$_COOKIE['uid'].", $id)");
	} 
?>