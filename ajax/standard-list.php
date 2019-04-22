<?php
	session_start();
	require_once("../includes/DB_Functions.php");
	
	if(isset($_SESSION["user_id"])){
		db = new DB_Functions();
		if($db->standardList()){
			$response = array();
			$user = $db->standardList();
			foreach($user as $value){
?>
				<tr>
					<td><?php echo $response['standard_id'] = $value['standard_id'];?></td>
					<td><?php echo $response['standard_title'] = strtoupper($value['standard_title']);?></td>
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