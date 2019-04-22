<?php
	session_start();
	require_once("../includes/DB_Functions.php");
	
	if(isset($_SESSION["user_id"])){
		if(!empty($_POST['board']) && !empty($_POST['standard'])){
			$new_board = htmlentities(trim($_POST['board']));
			$new_standard = htmlentities(trim($_POST['standard']));
			$filename = $_FILES["file"]["tmp_name"];
			$status = 1;

			$db = new DB_Functions();
			if($_FILES["file"]["size"] > 0){
				$file = fopen($filename, "r");
				while(($getData = fgetcsv($file, 10000, ",")) !== FALSE){
					$sql = $db->bulkStudentUpload($new_board, $new_standard, $getData[0], $getData[1], $getData[2], $getData[3], $status);
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