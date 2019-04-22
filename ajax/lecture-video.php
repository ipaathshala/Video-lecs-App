<?php
	session_start();
	require_once("../includes/DB_Functions.php");
	if(isset($_SESSION["user_id"])){
		if(!empty($_REQUEST['subjectid']) && !empty($_REQUEST['chapterid'])){
			$subjectId = htmlentities(trim($_REQUEST['subjectid']));
			$chapterId = htmlentities(trim($_REQUEST['chapterid']));
			$db = new DB_Functions();
			if($db->lectureVideo($subjectId, $chapterId)){
				$user = $db->lectureVideo($subjectId, $chapterId);
				foreach($user as $value){
?>
					<div class="col-lg-4">
						<div class="card m-t-40">
							<div class="card-body">
								<h4 class="mt-0 header-title"><?php echo $response['video_title'] = ucfirst($value['video_title']); ?></h4>
								<div class="embed-responsive embed-responsive-16by9">
									<iframe src="<?php echo base64_decode($response['video_url'] = $value['video_url']) ;?>" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
								</div>
							</div>
						</div>
					</div>
<?php					
				}
			}
		}
	}
	else{
		require_once("../signout.php");
	}
?>