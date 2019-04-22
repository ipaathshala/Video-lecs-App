<?php
	session_start();
	require_once("../includes/DB_Functions.php");
	if(isset($_SESSION["user_id"])){
		if(!empty($_POST['board']) && !empty($_POST['standard']) && !empty($_POST['subject']) && !empty($_POST['chapter'])){
			$board = htmlentities(trim($_POST['board']));
			$standard = htmlentities(trim($_POST['standard']));
			$subject = htmlentities(trim($_POST['subject']));
			$chapter = htmlentities(trim($_POST['chapter']));
			$status = 1;
			$array1 = $_POST['vtitle'];
			$array2 = $_POST['url'];

			$db = new DB_Functions();
			for($i = 0; $i < count($array1); $i++){
				$title = $array1[$i];
				$vurl = $array2[$i];
				$user = $db->ifChapterVideoExist($board, $standard, $subject, $chapter, $title, $vurl);
				if($user){
					echo 2;
					exit();
				}
				else{
					$db->newChapterVideo($board, $standard, $subject, $chapter, $title, base64_encode($vurl), $status);	
				}
			}
			echo 1;
		}
		else{
			echo 0;
		}
	}
	else{
		require_once("../signout.php");
	}
?>