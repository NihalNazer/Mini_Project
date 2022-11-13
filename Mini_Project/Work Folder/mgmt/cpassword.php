<?php include("../config/conn.php"); ?>
<?php
//validation for admin page;
if(!isset($_SESSION['homsuser']) || !isset($_SESSION['homsutype']) ||($_SESSION['homsutype']!=12))
{
  echo"<script type=\"text/javascript\">
 window.location.assign(\"../login\")
</script>"; 
}
else
{
  $user=$_SESSION['homsuser'];
?>
<?php include("../template.inc.php"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

  
   <?php  head_part_home(); ?>
  
  <body class="skin-black">
    <div class="wrapper">

      <?php top($con); ?>
    <?php mgmt_nav($con); ?>
  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Management
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
             <!-- <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
            <li class="active"><i class="fa fa-magic"></i>Change Password (User) </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
    
<!----------------------------------------------------PAGE CONTENTS START HERE ------------------------------------------------->
<div class="row">  

     <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Change Passwod</h3>
                </div><!-- /.box-header -->


 <div class="my-box">   

 <?php 
if(isset($_POST["btnSubmit"]))
{
 //$currentPass=$_POST["txtCurrentPass"];
 $newPass=$_POST["txtNewPass"];
 $confirmPass=$_POST["txtConfirmPass"];
 
 //$ncurrentPass=SHA1(md5($currentPass));
 $nnewPass=SHA1(md5($newPass));

 $userid=$_POST["exphid"];
 //$ehid=$_POST["exphid"];
 
 if($newPass!='' && $confirmPass!='')
 {
	
		
			if($newPass==$confirmPass)
			{
				//$currentPass=$newPass;
				$updateQuery="UPDATE `user` SET `Password`='$nnewPass' WHERE `Uid`='$userid'";
				//echo $updateQuery;
				mysqli_query($con, $updateQuery);
			
			$selectOne="SELECT * FROM `user` WHERE `Uid`='$userid'";
			$resultOne=mysqli_query($con, $selectOne);
			$rowOne=mysqli_fetch_array($resultOne);
			$nameOne=$rowOne["Name"];
			
			echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                    $nameOne: Password Changed Succesfully ....
                  </div>";
				  $newPass= $confirmPass ='';
 
			}
			else
			{
				echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                   PASSWORD CONFIRMATION Failed...!
                  </div>";
			}	
		
 }	
 else
 {
	 echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                  PLEASE FILL ALL MANDATORY FIELDS...
                  </div>";
 }
 }

?>
</div>



<!----------------------------------EDIT WAREHOUSE---------------------------------->

<?php 
if(isset($_POST["btnPass"]))
{
	$ehid=$_POST["ehid"];
}
elseif(isset($_POST["btnSubmit"]))
{
	$ehid=$_POST["exphid"];
}
else
{
	$ehid='';
}
	
?>
<form role="form" method="post" enctype="multipart/form-data" >
                  <div class="box-body">
                  
                   
                    <div class="form-group">
                      <label for="Npass">New Password<span style="color:#FF0000">*</span></label>
                      <input name="txtNewPass" type="password" value="<?php echo @$newPass; ?>" class="form-control" id="Npass"  placeholder="Enter the New Password" />
                     
                    </div>
                    
                    <div class="form-group">
                      <label for="Copass">Confirm Password<span style="color:#FF0000">*</span></label>
                      <input name="txtConfirmPass" type="password" value="<?php echo @$confirmPass; ?>" class="form-control" id="Copass"  placeholder="Confirm the New Password" />
                     
                    </div>
                    
                    
				 </div><!-- /.box-body -->

                  <div class="box-footer">
                  <input name="exphid" type="hidden" value="<?php echo $ehid; ?>" />
                   <button type="submit" name="btnSubmit"  class="btn btn-primary"><i class="fa fa-check"></i> Change</button>
                  </div>
                </form>
    
               

                
              </div><!-- /.box -->
</div>



 <div class="col-md-6">
  <!-- TO DO List -->
      
              </div> 
</div>
<!----------------------------------------------------PAGE CONTENTS START HERE ------------------------------------------------->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php footer($con); ?>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    
     <?php jss(); ?>

  </body>
</html>
<?php
}
?>