<?php
	session_statr();
	require_once("../includes/DB_Functions.php");

	if(isset($_SESSION["user_id"])){

		if(!empty($_POST['board']) && !empty($_POST['standard']) && !empty($_POST['subject'])){
			
			$new_board = htmlentities(trim($_POST['board']));
			$new_class = htmlentities(trim($_POST['standard']));
			$new_subject = htmlentities(trim($_POST['subject']));
			$filename = $_FILES["file"]["tmp_name"];

			$db = new DB_Functions();

			if($_FILES["file"]["size"] > 0){
				$file = fopen($filename, "r");
				while(($getData = fgetcsv($file, 10000, ",")) !== FALSE){
					$sql = $db->newChapters($new_board, $new_class, $new_subject, mysql_real_escape_string($getData[0]));
				}
				fclose($file);
				echo 1;
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