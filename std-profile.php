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
    <title>Bulk Upload</title>
    <!-- Plugins css -->
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
        require_once('require/sidebar.php'); 
        ?>
      <div class="content-page">
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="card m-b-20 m-t-20">
                  <div class="card-body">
                    <h4 class="mt-0 header-title">Create Student Profile</h4>
                    <form>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <select class="form-control select2" id="board" name="board">
                              <option value="0">Select Board</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <select class="form-control select2" id="standard" name="standard">
                              <option value="0">Select Standard</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <input type="text" class="form-control" placeholder="Student First Name" id="fn" name="fn" value="<?php echo $_POST['fn'];?>" autocomplete="off">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <input type="text" class="form-control" placeholder="Student Last Name" id="ln" name="ln" value="<?php echo $_POST['ln'];?>" autocomplete="off">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <input type="text" class="form-control" placeholder="Student Email Address" id="un" name="un" value="<?php echo $_POST['un'];?>" autocomplete="off">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" id="pw" name="pw" value="<?php echo $_POST['pw'];?>">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group text-center">
                            <i class="fa fa-spinner fa-spin" id="loader"></i>
                            <button type="submit" name="submit" class="btn btn-dark waves-effect waves-light">SAVE RECORD</button>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <div class="alert alert-danger" role="alert" id="invboard"><strong>Error! Select board</strong></div>
                            <div class="alert alert-danger" role="alert" id="invclass"><strong>Error! Select Standard</strong></div>
                            <div class="alert alert-danger" role="alert" id="invnm"><strong>Error! Invalid name format</strong></div>
                            <div class="alert alert-danger" role="alert" id="invun"><strong>Error! Invalid email format</strong></div>
                            <div class="alert alert-danger" role="alert" id="invpw"><strong>Error! Invalid password format</strong></div>
                            <div class="alert alert-danger" role="alert" id="duplicate"><strong>Error! Record already exist</strong></div>
                            <div class="alert alert-danger" role="alert" id="invalid"><strong>Error! Some error occurs unable to save record</strong></div>
                            <div class="alert alert-danger" role="alert" id="fail"><strong>Error! Unable to proceed your request</strong></div>
                            <div class="alert alert-success" role="alert" id="success"><strong>Success! Records saved successfully</strong></div>
                          </div>
                        </div>
                      </div>
                    </form>
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
    <script src="custom-js/std-profile.js"></script>
  </body>
</html>