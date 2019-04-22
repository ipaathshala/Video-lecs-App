<?php
	session_start();
	require_once("../includes/DB_Functions.php");
	if(isset($_SESSION["user_id"])){
		$db = new DB_Functions();
		if($db->standardList()){
			$response = array();
			$user = $db->standardList();
?>
			<option value="0">Select Standard</option>
<?php
			foreach($user as $value){
?>
				<option value="<?php echo $response['standard_id'] = $value['standard_id'];?>">
					<?php echo $response['standard_title'] = strtoupper($value['standard_title']);?>
				</option>
<?php					
			}			
		}
	}
	else{
		require_once("../signout.php");
	}
?>