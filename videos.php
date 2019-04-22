<?php
  session_start();
  include_once('includes/DB_Functions.php');
  $db = new DB_Functions();
  error_reporting(0);
  if(!$_SESSION["user_id"] && $_SESSION["user_name"]){
    header("Location:signout.php");
  }
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Videos</title>
    <link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
    <?php require_once('require/header-css.php'); ?>
  </head>
  <body>
    <div id="wrapper">
      <?php 
        require_once('require/top-bar.php'); 
        require_once('require/side-bar.php'); 
        ?>
      <div class="content-page">
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="card m-b-20 m-t-20">
                  <div class="card-body">
                    <h4 class="mt-0 header-title">Lecture Video</h4>
                    <form enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <div class="alert alert-danger" role="alert" id="norecords"><strong>Error! No records to show</strong></div>
                            <div class="alert alert-success" role="alert" id="records"><strong>Success! Records fetched successfully</strong></div>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <select class="form-control select2" id="subject" name="subject">
                              <option value="0">Select Subject</option>
                            </select>
                            <input type="hidden" class="form-control" name="student" id="student" value="<?php echo $_SESSION['user_id'];?>">
                          </div>
                        </div>
                        <div class="col-sm-9">
                          <div class="form-group">
                            <select class="form-control select2" id="chapter" name="chapter">
                              <option value="0">Select Chapter</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </form>
                    <div class="row" id="videobody">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once('require/footer.php'); ?>
      </div>
    </div>
    <!-- jQuery  -->
    <?php require_once('require/footer-js.php'); ?>
    <!-- Plugins js -->
    <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
    <script src="assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
    <!-- Plugins Init js -->
    <script src="assets/pages/form-advanced.js"></script>
    <script src="custom-js/load-video.js"></script>
  </body>
</html>