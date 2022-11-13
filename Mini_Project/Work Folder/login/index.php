<?php include("../config/connlog.php"); ?>
<?php
function login($con)
{
	if (isset($_POST['username']) && isset($_POST['username'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];
  $npassword=SHA1(md5($password));


$selectuser="Select `Uid`, `Userid`, `Categoryid` from `user` WHERE `Userid`='$username' AND `Password`='$npassword'";
$resultuser=mysqli_query($con,$selectuser);
if(mysqli_num_rows($resultuser)==1)
{
	//echo "ok";
	$rowuser=mysqli_fetch_array($resultuser);
	$usr=$rowuser["Uid"];
	$_SESSION["homsuser"]=$rowuser["Uid"];
	$_SESSION["homsusername"]=$rowuser["Userid"];
	$_SESSION["homsutype"]=$rowuser["Categoryid"];
	
	$upadteflag="UPDATE `user` SET `Uflag`=1 WHERE `Uid`='$usr'";
	mysqli_query($con,$upadteflag);

  if (isset($_POST['remember']) && $_POST['remember'] == 'on') 
  {
    /*
     * Set Cookie from here for 12 hour
     * */
    setcookie("homsusername", $username, time()+(60*60*12));
    //setcookie("password", $password, time()+(60*60*1));  /* expire in 1 hour */
  }
  echo"<script type=\"text/javascript\">
 window.location.assign(\"../traffic.php\")
</script>";

 }
 else
 {
	 ?>
	 <i class="fa fa-warning"></i> Invalid Username or Password... 
     <?php
 }
  } 
}
?>
<?php
if(isset($_SESSION['homsuser'])) 
{
	echo"<script type=\"text/javascript\">
 window.location.assign(\"../traffic.php\")
</script>";
}
	?>
<?php
if (isset($_COOKIE['homsusername'])) {
    //$username = $_COOKIE['username'];
	echo"<script type=\"text/javascript\">
 window.location.assign(\"remember.php\")
</script>";
  }
?>
 <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
        <!-- iCheck -->
    <link href="../plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
     <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="UTF-8">
    <title>ORDER MANGEMENT | Log in</title>
     <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../index.php">
        <img src="../profile/LOGO.gif"/>
        </a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">
        <?php echo get_client_ip().' @ '.$CurrentDate.' '.$CurrentTime;?></p>
        
       <form method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username"  placeholder="Username" value="<?php echo @$username;?>"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password"  name="password"  class="form-control" placeholder="Password" value="<?php echo @$password;?>"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" name="remember"> Remember Me
                </label>
              </div>                      
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

         
        <div class="my-box" style="color:#F00;"> 
        
      <?php
	  if (isset($_POST["submit"]))
	  {
		 login($con);
		  }
		?>
       
        </div>

        

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

   
    <?php mysqli_close($con); ?>
  </body>
</html>