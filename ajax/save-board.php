<?php
	session_start();
	require_once '../includes/DB_Functions.php';

	if(isset($_SESSION["user_id"])){
		
		if(!empty($_POST['board'])){
			$board = htmlentities(trim(strtolower($_POST['board'])));
			$db = new DB_Functions();
			if($db->ifBoardExist($board)){
				echo 2;
			}
			else{
				$user = $db->saveNewBoard($board);
				if($user){
					echo 1;
				}
				else{
					echo 2;
				}
			}
		}
	}
	else{
		require_once("../signout.php");
	}
?>