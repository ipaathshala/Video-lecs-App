<?php
	session_start();
	require_once("../includes/DB_Functions.php");
	
	if(isset($_SESSION["user_id"])){
		if(!empty($_POST['subject'])){
			$subject = htmlentities(trim(strtolower($_POST['subject'])));
			$db = new DB_Functions();
			if($db->ifSubjectExist($subject)){
				echo 2;
			}
			else{
				$user = $db->saveNewSubject($subject);
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