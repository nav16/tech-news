<?
include 'init.php';
if(logged_in() && $_COOKIE['uid'] == 27){
mysql_query("delete from submit_link where id ='".$_REQUEST['id']."'");
mysql_query("delete from messages where pid ='".$_REQUEST['id']."'");
mysql_query("delete from likes where article_id ='".$_REQUEST['id']."'");
mysql_query("delete from dislikes where article_id ='".$_REQUEST['id']."'");
mysql_query("delete from messages where pid ='".$_REQUEST['id']."'");
mysql_query("delete from messages where pid ='".$_REQUEST['id']."'");
}
?>