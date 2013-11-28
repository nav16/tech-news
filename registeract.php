<?php
include 'init.php';
	 if(!logged_in()){
	$register_email = $_POST['email'];
	$register_name = $_POST['name'];
	$register_mname = $_POST['mname'];
	$register_password = $_POST['password'];
		
	$errors = array();
	
	if(empty($register_email) || empty($register_name) || empty($register_password) || empty($register_mname)){
		$errors[] = 'All Fields Required';
		
	}else{
	    if(preg_match("/^[a-zA-Z0-9]+_?[a-zA-Z0-9]+$/D",$register_name))
	    { 	
			$errors[] = 'Not valid, use only underscore, alphabets and digits';
		}
		if(strlen($register_name) < 5)
	    { 	
			$errors[] = 'Too short, At least 6 characters required';
		}
		if(filter_var($register_email, FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'Email address not valid';
		 }
		if(strlen($register_email)> 255 || strlen($register_name)>35 || strlen(	$register_password)> 35){
			$errors[] = 'Too many characters';
		}
		if(user_exists($register_email) === true){
			$errors[] = 'Email already in use';	
		}
		if(username_exists($register_name) === true){
			$errors[] = 'Username already exists';	
		}
	
	}
	if(!empty($errors)){
		foreach($errors as $error) {
			echo $error;

		}
	}else{
	$register = user_register($register_email, $register_name, $register_password, $register_mname);
		setcookie("uid", $register, time() + 2419200);
		//$_SESSION['uid'] = $register;
		echo 'yes';
		exit();
	}
	}else{
	header("Location:index.php");
	}	

?>

