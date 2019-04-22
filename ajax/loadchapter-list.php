<?php
	session_start();
	require_once("../includes/DB_Functions.php");

	if(isset($_SESSION["user_id"])){
		if(!empty($_REQUEST['boardid']) && !empty($_REQUEST['standardid']) && !empty($_REQUEST['subjectid'])){
			$board = htmlentities(trim($_REQUEST['boardid']));
			$standard = htmlentities(trim($_REQUEST['standardid']));
			$subject = htmlentities(trim($_REQUEST['subjectid']));

			$db = new DB_Functions();
			$response = array();
			if($db->loadChapterList($board, $standard, $subject)){
				$user = $db->loadChapterList($board, $standard, $subject);
?>
				<option value="0">Select Chapter</option>
<?php
				foreach($user as $value){
?>
				<option value="<?php echo $response['chapter_id'] = $value['chapter_id'];?>">
					<?php echo $response['chapter_title'] = strtoupper($value['chapter_title']);?>
				</option>
<?php					
				}				
			}
		}
	}
	else{
		require_once("../signout.php");
	}
?>