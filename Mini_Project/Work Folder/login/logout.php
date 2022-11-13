<?php 
include("../config/connlog.php");
require_once("../class/user.php");
   	$userclass=new users();
   	$userclass->user=$_SESSION['homsuser'];
	$userclass->con=$con;
	$userclass->userinfo();
	
	$usr=$userclass->user;
	$upadteflag="UPDATE `user` SET `Uflag`=0 WHERE `Uid`='$usr'";
	mysqli_query($con, $upadteflag);
?>
<?php
if(isset($_SESSION['homsuser'])) 
{
	session_destroy();
	echo"<script type=\"text/javascript\">
 window.location.assign(\"../login\")
</script>";
}
	?>
