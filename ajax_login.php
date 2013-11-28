<?include_once'init.php';
		$login_email = $_POST['username'];
		$login_password = $_POST['password'];
if(empty($login_email) || empty($login_password)){
echo 'Email and Password Required';
exit();
}						
//now validating the username and password
$login = login_check($login_email, $login_password);
		
	if($login === false) {
		echo "Email or Password Incorrect"; 
	}else{	
	//now set the session from here if needed
	setcookie('uid', $login, time()+2419200);	
echo "yes";
exit();
}
?>