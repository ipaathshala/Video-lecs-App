<?php
	session_start();
	require_once("../includes/DB_Functions.php");

	if(isset($_SESSION["user_id"])){
		if(!empty($_POST['board']) && !empty($_POST['standard']) && !empty($_POST['fn']) && !empty($_POST['ln']) && !empty($_POST['un']) && !empty($_POST['pw'])){
			$board = htmlentities(trim($_POST['board']));
			$standard = htmlentities(trim($_POST['standard']));
			$firstname = htmlentities(trim($_POST['fn']));
			$lastname = htmlentities(trim($_POST['ln']));
			$username = htmlentities(trim($_POST['un']));
			$password = htmlentities(trim($_POST['pw']));
			$status = 1;

			$db = new DB_Functions();
			if($db->singleStudentExist($username)){
				echo 2;
			}
			else{
				$user = $db->singleStudentProfile($board, $standard, $firstname, $lastname, $username, $password, $status);
				if($user){
					echo 1;
				}
				else{
					echo 0;
				}
			}
		}
	}
	else{
		require_once("../signout.php");
	}
?>