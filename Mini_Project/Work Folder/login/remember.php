<?php include("../config/connlog.php"); ?>
<?php
function login($con)
{
	if (isset($_POST['username']) && isset($_POST['username'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];
  $npassword=SHA1(md5($password));


$selectuser="Select `Uid`, `Userid`, `Categoryid` from `user` WHERE `Userid`='$username' AND `Password`='$npassword'";
$resultuser=mysqli_query($con, $selectuser);
if(mysqli_num_rows($resultuser)==1)
{
	//echo "ok";
	$rowuser=mysqli_fetch_array($resultuser);
	$usr=$rowuser["Uid"];
	$_SESSION["homsuser"]=$rowuser["Uid"];
	$_SESSION["homsusername"]=$rowuser["Userid"];
	$_SESSION["homsutype"]=$rowuser["Categoryid"];
	
	$upadteflag="UPDATE `user` SET `Uflag`=1 WHERE `Uid`='$usr'";
	mysqli_query($con, $upadteflag);

  echo"<script type=\"text/javascript\">
 window.location.assign(\"../traffic.php\")
</script>";

 }
 else
 {
	 ?>
	 <i class="fa fa-warning"></i> Check Your Password... 
     <?php
 }
  } 
}
?>
<?php
if (isset($_COOKIE['homsusername'])) {
    $username = $_COOKIE['homsusername'];
	$userselect="SELECT Uid FROM `user` WHERE `Userid`='$username'";
	$userresult=mysqli_query($con, $userselect);
	$userrow=mysqli_fetch_array($userresult);
	$uid=$userrow["Uid"];
  }
  else
  {
	  echo"<script type=\"text/javascript\">
 window.location.assign(\"index.php\")
</script>";
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
     <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <title>HANBAZ HOMS | Remeber</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

  </head>
  <body class="lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href="../index.php">
        <img src="../profile/HANBAZ-HOMS.gif"/>
        </a>
      </div>
      <!-- User name -->
       <?php
require_once("../class/user.php");
   	$userclasst=new users();
   	$userclasst->user=$uid;
	$userclasst->con=$con;
	$userclasst->userinfo();
?>
      <div class="lockscreen-name"><?php echo $userclasst->userfullname; ?></div>

      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
          <img src="../profile/<?php echo $userclasst->photo; ?>" alt="user image"/>
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials"  method="post">
          <div class="input-group">
          <input type="hidden" class="form-control" name="username"  placeholder="Username" value="<?php echo $userclasst->username; ?>"/>
            <input type="password" name="password" class="form-control" placeholder="password" />
            <div class="input-group-btn">
              <button class="btn" type="submit" name="submit"><i class="fa fa-arrow-right text-muted"></i></button>
            </div>
          </div>
        </form><!-- /.lockscreen credentials -->

      </div><!-- /.lockscreen-item -->


      <div class="help-block text-center">
              <div class="my-box" style="color:#F00;"> 
        
      <?php
	  if (isset($_POST["submit"]))
	  {
		login($con);  
		}
	?>
       
        </div>
        Enter your password to retrieve your session
      </div>
      <div class='text-center'>
        <a href="new.php">Or sign in as a different user</a>
      </div>
      
    </div><!-- /.center -->

    <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <?php mysqli_close($con); ?>
  </body>
</html>