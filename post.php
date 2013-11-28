<?
if(logged_in()){
$user_data = user_data('username');
?>
<h2><?=$user_data['username']?>, Post Something</h2><br/>
<table width="70%" border="0" cellpadding="3" cellspacing="1">
<form action="postact.php" method="post" id="post_form"> 
<tr>
<td width="15%"><label>Title</label></td><td>:</td><td><input type="text" name="title" id="titl" size="100" placeholder="Enter suitable title"/></td></tr>
<tr></tr>
<tr>
<td width="15%"><label>Content</label></td><td>:</td><td><textarea cols="72" placeholder="Tell us something" rows="10" id="conten" name="conten" maxlength="1000"></textarea></td>
</tr><tr><td></td>
<td></td><td>(Minimum 160 and Maximum 1000 characters)<div id="barbox"><div id="bara"></div></div><div id="counta">0</div></td></tr>
<tr><td></td><td></td><td><input type="submit" value="Submit" id="submit" class="button"/><span id="mgbox" style="display:none; font-size:12px;"></td>
 </form></tr>
</table>
<?}else{
echo 'Login To Continue';
}
include 'tracker.php';

?>