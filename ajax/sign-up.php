<?php
	require_once '../includes/DB_Functions.php';

	if(!empty($_POST['un']) && !empty($_POST['pw'])){

		$username = htmlentities(trim($_POST['un']));
		$password = htmlentities(trim($_POST['pw']));

		$db = new DB_Functions();

		if($db->ifAdminExist($username)){
			echo 2;
		}
		else{
			$user = $db->newAdminAcc($username, $password);
			echo true;	
		}
	}
	else{
		echo 0;
	}
?>