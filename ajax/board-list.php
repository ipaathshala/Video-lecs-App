<?php
	session_start();
	require_once("../includes/DB_Functions.php");
	
	if(isset($_SESSION["user_id"])){
		$response = array();
		$db = new DB_Functions();
		if($db->boardList()){
			$user = $db->boardList();
			foreach($user as $value){
?>
				<tr>
					<td><?php echo $response['board_id'] = $value['board_id'];?></td>
					<td><?php echo $response['board_name'] = strtoupper($value['board_name']);?></td>
					<td>
						<a href="#" class="btn btn-dark waves-effect waves-light btn-sm"><i class="fa fa-edit"></i> EDIT</a>
						<a href="#" class="btn btn-primary waves-effect waves-light btn-sm"><i class="fa fa-trash"></i> DELETE</a>
					</td>
				</tr>
<?php				
			}
		}
	}
	else{
		require_once("../signout.php");
	}
?>