<?php
	session_start();
	require_once("../includes/DB_Functions.php");

	if(isset($_SESSION["user_id"])){
		$db = new DB_Functions();	
		$subject_id = htmlentities(trim($_REQUEST['subjectid']));
		$student_id = htmlentities(trim($_REQUEST['stdid']));	

		if($db->vidoechapterList($student_id, $subject_id)){
			$response = array();
			$user = $db->vidoechapterList($student_id, $subject_id);
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
	else{
		require_once("../signout.php");
	}
?>
		
