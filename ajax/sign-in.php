<?php
	session_start();
	require_once '../includes/DB_Functions.php';
	
	error_reporting(E_ALL);

	if(!empty($_POST['un']) && !empty($_POST['pw'])){

		$username = htmlentities(trim($_POST['un']));
		$password = htmlentities(trim($_POST['pw']));

		$db = new DB_Functions();

		if($user= $db->adminLogin($username, $password)){
			$_SESSION["user_id"] = $user["admin_id"];
			$_SESSION["user_name"] = $user["email"];
			echo 1;
		}
		else{
			echo 0;
		}
	}
	else{
		echo 2;
	}
?>