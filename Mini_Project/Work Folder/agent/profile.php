<?php include("../config/connbdm.php"); ?>
<?php
//validation for admin page;
if(!isset($_SESSION['homsuser']) || !isset($_SESSION['homsutype']) ||($_SESSION['homsutype']!=8))
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
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
 
 <?php  head_part(); ?>
  <body class="skin-black">
    <div class="wrapper">

      	<?php top($con); ?>
      <!-- Left side column. contains the logo and sidebar -->
   <?php  bdm_nav($con); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Agent
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
             <!-- <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
            <li class="active"><i class="fa fa-pencil"></i> Profile</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
    
<!----------------------------------------------------PAGE CONTENTS START HERE ------------------------------------------------->
<div class="row">  

     <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Manage Profile</h3>
                </div><!-- /.box-header -->


 <div class="my-box">   
 
 <?php 
if(isset($_POST["btnEdit"]))
{
$edtUserid=$_POST["txtEdtUserid"];
//$edtUserCatg=$_POST["ddlEdtUserCat"];
$edtName=$_POST["txtEdtName"];
$today = date("Y-m-d H:i:s");
//$edtdateTime=$today;

//$edtDateTime=$_POST["txtEdtDateTime"];
$edtGender=$_POST["ddlEdtGender"];
$edtAddress=$_POST["textareaEdtAddress"];
$edtEmail=$_POST["txtEdtEmail"];
$edtPhone=$_POST["txtEdtPhone"];
$edtRemark=$_POST["txtareaEdtRemark"];

$hid=$_POST["hid"];

	if($edtUserid!='' && $edtName!='' && $edtGender!='' && $edtAddress!='' && $edtPhone!='')
	{
		$querySelect="SELECT * FROM  `user` WHERE `Userid`='$edtUserid' and `Uid`!='$hid'";
		$resultCustomer=mysqli_query($con, $querySelect);
		//echo $querySelect;
		if(mysqli_num_rows($resultCustomer)>=1)
		{
			 echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    ALREADY EXISTING USERID: $edtUserid...
                  </div>";
		}
		else
		{
		$updateQuery="UPDATE `user` SET	`Userid`='$edtUserid',	`Name`='$edtName',`Gender`='$edtGender',	`Address`='$edtAddress',	`Email`='$edtEmail',	Phone='$edtPhone',	`Remark`='$edtRemark' WHERE `Uid`=$hid";
	//	echo $updateQuery;
		mysqli_query($con, $updateQuery);
		echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                    Updated Successfully...
                  </div>";
		}	
	}
	else
	{
	echo"<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>
                    Please fill all Mandatory fields...
                  </div>";
	}
}
?>
</div>


<?php 

	$editUId=$_SESSION['homsuser'];
	//echo "you are editting";
	$editSelect="SELECT * FROM `user` WHERE `Uid`='$editUId'";
   // echo $editSelect;
	$result=mysqli_query($con, $editSelect);
	$editRow=mysqli_fetch_array($result)
	
?>
<!----------------------------------EDIT WAREHOUSE---------------------------------->
<form role="form" method="post" enctype="multipart/form-data" >
                  <div class="box-body">
                  
                    <div class="form-group">
                      <label for="Userid">User Id<span style="color:#FF0000">*</span></label>
                      <input name="txtEdtUserid" id="Userid" type="text" value="<?php echo $editRow["Userid"];?>"  class="form-control"  placeholder="Enter User Id" />
                    </div>
                    
                     <div class="form-group">
                      <label for="UserCat">User Category<span style="color:#FF0000">*</span></label>
                      <select name="ddlEdtUserCat" id="UserCat" class="form-control"  disabled >
                      
                      <!-- user added-->
      <?php 
	  $editId=$editRow["Categoryid"];
	 // echo $editDistId;
		  $selectCatQuery="select * from `user_category` where `cid`='$editId' and `Status`='1'";
	  $resultCat=mysqli_query($con, $selectCatQuery);
	  while($resultCatRow=mysqli_fetch_array($resultCat))
	  {
	  ?>
      <option selected="selected" value="<?php echo @$resultCatRow["cid"];?>"><?php echo @$resultCatRow["Category"];?> </option>    
      <?php
	  }
	  ?>
        <!--other dist into dropdown-->
      <?php 
	  $selectOthercatQuery="select * from `user_category` where `cid`!='$editId' and `Status`='1'";
	  $resultCatQuery=mysqli_query($con, $selectOthercatQuery);
	  while($rowCat=mysqli_fetch_array($resultCatQuery))
	  {
	 ?>
     <option value="<?php echo @$rowCat["cid"];?>"><?php echo $rowCat["Category"];?> </option>
     <?php
	  }
	  ?>
      </select>
</div>

					<div class="form-group">
                      <label for="Name">Name<span style="color:#FF0000">*</span></label>
                      <input name="txtEdtName" type="text" value="<?php echo $editRow["Name"];?>" id="Name"   class="form-control"  placeholder="Enter Name" />
                    </div>
                    
                   <div class="form-group">
                      <label for="Gender">Gender<span style="color:#FF0000">*</span></label>
                      <select name="ddlEdtGender" id="Gender"  class="form-control" >
                      <?php if($editRow["Gender"]=="male"){ ?>
    <option value="">select</option>
     <option selected="selected" value="male">male</option>
      <option value="female">female</option>
      <?php
	}
	elseif($editRow["Gender"]=="female")
	{
	?>
    
     <option value="">select</option>
     <option value="male">male</option>
      <option selected="selected"  value="female">female</option>
      <?php
	}
	else
	{
	?>
     <option value="">select</option>
     <option value="male">male</option>
      <option value="female">female</option>
    <?php
	}
	?>
    				</select>
   				</div>
                 
                 <div class="form-group">
                      <label for="address">Address<span style="color:#FF0000">*</span></label>
                      <textarea name="textareaEdtAddress" id="address"  class="form-control"  placeholder="Enter Address" ><?php echo $editRow["Address"]?></textarea>
                
                    </div>   
                   
                   	<div class="form-group">
                      <label for="Email">Email</label>
                      <input name="txtEdtEmail" id="Email" type="email" value="<?php echo $editRow["Email"];?>" placeholder="example@abc.com"  class="form-control" />
                    </div>
                    
                    <div class="form-group">
                      <label for="Phone">Phone<span style="color:#FF0000">*</span></label>
                      <input name="txtEdtPhone" type="tel" value="<?php echo $editRow["Phone"];?>" id="Phone"   class="form-control"  placeholder="Enter Phone" />
                    </div>
                   
                   	
                    
    
    
    <div class="form-group">
                      <label for="Name">Remarks</label>
                      <textarea name="txtareaEdtRemark" rows="5" id="Name"   class="form-control"  placeholder="Enter Remarks (If Any)" ><?php echo $editRow["Remark"]?></textarea>
                    
    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                  <input name="hid" type="hidden" value="<?php echo $editRow["Uid"]?>" />
                   <button type="submit" name="btnEdit"  class="btn btn-primary"><i class="fa fa-plus"></i> Save</button>
                  </div>
                </form>
     
                
               

                
              </div><!-- /.box -->
</div>



 <div class="col-md-6">
  <!-- TO DO List -->
       <div class="box box-success">
                <div class="box-header">
               
                  <i class="fa fa-picture-o"></i>
                  <h3 class="box-title">Change Profile Picture </h3>
                 
                </div><!-- /.box-header -->
                
                
                <div class="box-body">
                
                <?php 
if(isset($_POST["btnChange"]))
{
				$target="../profile/";
				//echo $photo;
				$photo=$_FILES["txtPhoto"]["name"];
if($photo!='')
	{
		$oldimg=$editRow["Photo"];
		if($oldimg!='')
		{
			if (file_exists($target.$oldimg))
			{
				unlink($target.$oldimg);
			}
		}
	
	$photoname=$_FILES["txtPhoto"]["name"];
	$photosize=$_FILES["txtPhoto"]["size"];
	$phototype=$_FILES["txtPhoto"]["type"];
	$phototmp=$_FILES["txtPhoto"]["tmp_name"];
	
	//echo $photoname." ".$photosize." ".$phototype." ".$phototmp;
	
	if($photosize<100000)
	{
		if($phototype=="image/png" || $phototype=="image/jpg" || $phototype=="image/jpeg" || $phototype=="image/gif")
		{
			if (file_exists($target.$photoname))
			{
				echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    Please Rename Your Image...
                  </div>";
				
			}
			else
			{
	move_uploaded_file($phototmp,$target.$photoname);
	//echo "uploaded successfully";
				
		$updateQuery="UPDATE `user` SET `Photo`='$photoname' WHERE `Uid`='$editUId'";
		//echo $updateQuery;
		mysqli_query($con, $updateQuery);
		echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                    Profile Picture Changed Successfully...
                  </div>";
		}
		}
		else
		{
			echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    Unsupported Image Format...
                  </div>";
		}
	}
	}
}
?>
<?php
//echo $editUId;
$editSelectp="SELECT * FROM `user` WHERE `Uid`='$editUId'";
    //echo $editSelectp;
	$resultp=mysqli_query($con, $editSelectp);
	$editRowp=mysqli_fetch_array($resultp)
    ?>            
         <?php        
                 if($editRowp["Photo"]!='')
	{
	$pphoto=$editRowp["Photo"];
	}
	elseif($editRowp["Photo"]=='' && $editRowp["Gender"]=="male")
	{
	$pphoto="male.jpg";
	}
	elseif($editRowp["Photo"]=='' && $editRowp["Gender"]=="female")
	{
	$pphoto="female.jpg";
	}
	else
	{
		$pphoto="torra.jpg";
	}
    ?>
    <table>
    <form action="" method="post" enctype="multipart/form-data">
  <tr>
    <td rowspan="2"><img src="<?php echo '../profile/'.$pphoto; ?>" width="160"></td>
    <td rowspan="2" width="30">&nbsp;</td>
    <td valign="bottom"><input type="file" name="txtPhoto" value="<?php echo @$photo?>" id="Photo"  placeholder="Profile Picture" /></td>
  </tr>

  <tr>
  
  
    <td valign="top"> <br/><button type="submit" name="btnChange"  class="btn btn-primary"><i class="fa fa-refresh"></i> Change</button></td>
   
   
  </tr>
  </form> 
</table>

    
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
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