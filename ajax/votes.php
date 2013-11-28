<?php
include '../init.php';

if(logged_in()){
	if(isset($_REQUEST['article_id'], $_COOKIE['uid']) && article_exists($_REQUEST['article_id'])){
	
	$id =	$_GET['article_id'];
	$act =	$_GET['action'];
		switch ($act){
    case "like":
           if(previously_liked($id) === true){
				echo 'You\'ve already liked this!';	
					exit();
			}else{
				add_like($id);
				echo 'true';
				exit();
			}
        break;
    case "dislike":
	if(previously_disliked($id) === true){
				echo 'You\'ve already disliked this!';		
                exit();			
			}else{
				add_dislike($id);
				echo 'true';
				exit();
			}    
        break;
    case "total":
      echo like_count($id) + dislike_count($id);
        break;
}

	}}else{
			echo 'Please <a href="login.php">Login</a> to vote!';
		}
