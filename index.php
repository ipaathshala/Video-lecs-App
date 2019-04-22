  <?php error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Sign-in</title>
    <!-- CSS  -->
    <?php require_once('require/header-css.php');?>
  </head>
  <body>
    <div class="wrapper-page">
      <div class="card">
        <div class="card-body">
          <h3 class="text-center m-0"><a href="sign-up" class="logo logo-admin"><img src="assets/images/logo.png" height="150" alt="logo"></a></h3>
          <div class="p-3">
            <h4 class="text-muted font-18 m-b-5 text-center">Welcome Back!</h4>
            <p class="text-muted text-center">Login to your account</p>
            <form class="form-horizontal m-t-30">
              <div class="form-group">
                <input type="text" class="form-control" id="un" name="un" value="<?php echo $_POST['un'];?>" placeholder="Enter email" autocomplete="off">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="pw" name="pw" value="<?php echo $_POST['pw'];?>" placeholder="Enter password">
              </div>
              <div class="form-group row m-t-20">
                <div class="col-12 text-right">
                  <button class="btn btn-dark w-md waves-effect waves-light" type="submit" name="submit">Sign In</button>
                </div>
              </div>
              <div class="form-group">
                <div class="alert alert-danger" role="alert" id="invun"><strong>Error! Invalid username</strong></div>
                <div class="alert alert-danger" role="alert" id="invpw"><strong>Error! Invalid password</strong></div>
                <div class="alert alert-danger" role="alert" id="invlogin"><strong>Error! Invalid login credentials</strong> </div>
                <div class="alert alert-danger" role="alert" id="invalid"><strong>Error! Some error occurs unable to login</strong></div>
                <div class="alert alert-danger" role="alert" id="fail"><strong>Error! Unable to proceed your request</strong></div>
                <div class="alert alert-success" role="alert" id="success"><strong>Success! Logged in successfully</strong></div>
                <div class="text-center"><i class="fas fa-spinner fa-spin" id="loader"></i></div>
              </div>
              <div class="form-group m-t-10 mb-0 row">
                <div class="col-12 m-t-20">
                  <p class="font-14 text-muted mb-0 text-center">Forgot your password ? <a href="forgot-password" class="text-primary">Click Here</a></p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- jQuery  -->
    <?php require_once('require/footer-js.php');?>
    <script src="custom-js/sign-in.js"></script>
  </body>
</html>