<?php
	session_start();
	require_once ("../includes/DB_Functions.php");

	if(isset($_SESSION["user_id"])){
		if(!empty($_POST['standard'])){

			$standard = htmlentities(trim(strtolower($_POST['standard'])));
			$db = new DB_Functions();
			if($db->ifStandardExist($standard)){
				echo 2;
			}
			else{
				$user = $db->saveNewStandard($standard);
				if($user){
					echo 1;
				}
				else{
					echo 2;
				}
			}
		}
		else{
			echo 0;
		}
	}
	else{
		require_once("../signout.php");
	}
?>