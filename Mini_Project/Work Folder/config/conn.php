<?php
session_start();
$con = mysqli_connect("localhost","root","","project");
//Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to ORDER MANGNT Database: " . mysqli_connect_error();
  exit();
}
date_default_timezone_set('Asia/Kolkata');
					$CurrentDate=date('Y-m-d');
					$CurrentTime=date("h:i:s A");
?>