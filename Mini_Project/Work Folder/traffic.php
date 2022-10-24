<?php include("config/connlog.php"); ?>
<?php echo "Redirecting..."; ?> 
<?php
if(isset($_SESSION['homsuser']))
{
	require_once("class/user.php");
   	$userclass=new users();
   	$userclass->user=$_SESSION['homsuser'];
	$userclass->con=$con;
	$userclass->userinfo();
	$uurl=$userclass->userurl;
	echo"<script type=\"text/javascript\">
 window.location.assign(\"$uurl\");
</script>";	
}
else
{
	echo"<script type=\"text/javascript\">
 window.location.assign(\"login/\");
</script>";
}
?>