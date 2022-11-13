<?php include("../config/conn.php"); ?>
<?php
//validation for admin page;
if(!isset($_SESSION['homsuser']) || !isset($_SESSION['homsutype']) ||($_SESSION['homsutype']!=1))
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
   <?php  admin_nav($con); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
             <!-- <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
            <li class="active"><i class="fa fa-users"></i> Users</li>
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
                  <h3 class="box-title">Manage Users</h3>
                </div><!-- /.box-header -->


 <div class="my-box">   
 
 <?php
 
 if(isset($_POST["delt"]))
{
	$did=$_POST["edit"];	
	$delete="UPDATE `user` SET `status`='0' WHERE `Uid`='$did'";
	//echo $delete;
	mysqli_query($con, $delete);
	
	$deletenum="Update `number_config` SET `ncstatus`='0' , `nctoDate`='$CurrentDate' Where `ncflag`='$did' AND `ncflag`!='1'";
	mysqli_query($con, $deletenum);
	
	echo "<div class=\"alert alert-info alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-info\"></i> Alert!</h4>
                   Deleted Successfully...
                  </div>";
}
?>
 
 <?php 
if(isset($_POST["btnSave"]))
{
$userid=$_POST["txtUserid"];
$userCatg=$_POST["ddlUserCat"];
$name=$_POST["txtName"];

$today = date("Y-m-d H:i:s");
$dateTime=$today;

//$dateTime=$_POST["txtDateTime"];
$gender=$_POST["ddlGender"];
$address=$_POST["textareaAddress"];
$email=$_POST["txtEmail"];
$phone=$_POST["txtPhone"];
$rpassword=$_POST["txtPassword"];
$password=SHA1(md5($rpassword));
$confrmPassword=$_POST["txtConfPassword"];
$photo=$_FILES["txtPhoto"]["name"];
$remark=$_POST["txtareaRemark"];

$userShft=$_POST["ddlShift"];

	if($userid!='' && $userCatg!='' && $name!='' && $dateTime!='' && $gender!='' && $address!=''  && $phone!='' && $password!='' && $confrmPassword!='')
	{
	$query="select * from `user` where `Userid`='$userid' and `Status`='1'";
	$queryResult=mysqli_query($con, $query);
		if(mysqli_num_rows($queryResult)>=1)
			{
				 echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    ALREADY EXISTING USERID: $userid...
                  </div>";
			}
		elseif($rpassword==$confrmPassword)
			{
				$target="../profile/";
				//echo $photo;
	if($photo!='')
	{
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
				
			$insertQuery="insert into `user` (Uid,	Userid,	Categoryid,	Name,	Datetime,	Gender,	Address,	Email,	Phone,Password,	Photo,	Remark,	Status, Uflag, shft) values(NULL,'$userid','$userCatg','$name','$dateTime','$gender','$address','$email','$phone','$password','$photoname','$remark','1','0', '$userShft')";
		echo $insertQuery;
		mysqli_query($con, $insertQuery);
		
		//number_configuration
		if($userCatg==2 || $userCatg==3)
		{
			$ncquery="select * from `user` where `Userid`='$userid' and `Status`='1'";
	$ncqueryResult=mysqli_query($con, $ncquery);
		if(mysqli_num_rows($ncqueryResult)>=1)
			{
				$ncRow=mysqli_fetch_array($ncqueryResult);
				$cuid=$ncRow["Uid"];
				$cuname=$ncRow["Name"];
				$cunumber=$ncRow["Phone"];	
				$cudate=substr($ncRow["Datetime"],0,10);
				
				$selectnumcon="select * From `number_config` WHERE `ncflag`='$cuid' and `ncstatus`='1'";
				$resultnumcon=mysqli_query($con, $selectnumcon);
				if(mysqli_num_rows($resultnumcon)>=1)
			{
				$numconRow=mysqli_fetch_array($resultnumcon);
				
				$numconUpdate="update `number_config` set `ncnumber`='$cunumber', `ncfor`='$cuname', `ncfromDate`='$cudate' where `ncflag`='$cuid' AND  `ncstatus`='1'";
				mysqli_query($con, $numconUpdate);
			}
			else
			{
				$numconInsert="insert into `number_config` (`ncid`, `ncnumber`, `ncfor`, `ncflag`, `ncfromDate`, `ncstatus`, `freshness`) values(NULL, '$cunumber', '$cuname', '$cuid', '$cudate', '1', '1')";
				mysqli_query($con, $numconInsert);
			}
					
			}
		}
		
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
	else
	{
		echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    Photo is Too Large...
                  </div>";
	}
}
else //image is not uploaded
{
	$insertQuery="insert into `user` (Uid,	Userid,	Categoryid,	Name,	Datetime,	Gender,	Address,	Email,	Phone,	Password,	Photo,	Remark,	Status,Uflag, shft) values(NULL,'$userid','$userCatg','$name','$dateTime','$gender','$address','$email','$phone','$password','','$remark','1','0', '$userShft')";
		//echo $insertQuery;
		mysqli_query($con, $insertQuery);
		
		//number_configuration
		if($userCatg==2 || $userCatg==3)
		{
			$ncquery="select * from `user` where `Userid`='$userid' and `Status`='1'";
	$ncqueryResult=mysqli_query($con, $ncquery);
		if(mysqli_num_rows($ncqueryResult)>=1)
			{
				$ncRow=mysqli_fetch_array($ncqueryResult);
				$cuid=$ncRow["Uid"];
				$cuname=$ncRow["Name"];
				$cunumber=$ncRow["Phone"];	
				$cudate=substr($ncRow["Datetime"],0,10);
				
				$selectnumcon="select * From `number_config` WHERE `ncflag`='$cuid' and `ncstatus`='1'";
				$resultnumcon=mysqli_query($con, $selectnumcon);
				if(mysqli_num_rows($resultnumcon)>=1)
			{
				$numconRow=mysqli_fetch_array($resultnumcon);
				
				$numconUpdate="update `number_config` set `ncnumber`='$cunumber', `ncfor`='$cuname', `ncfromDate`='$cudate' where `ncflag`='$cuid' AND  `ncstatus`='1'";
				mysqli_query($con, $numconUpdate);
			}
			else
			{
				$numconInsert="insert into `number_config` (`ncid`, `ncnumber`, `ncfor`, `ncflag`, `ncfromDate`, `ncstatus`, `freshness`) values(NULL, '$cunumber', '$cuname', '$cuid', '$cudate', '1', '1')";
				mysqli_query($con, $numconInsert);
			}
					
			}
		}
}
		
		
		echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                    User Added Successfully...
                  </div>";
				  $userid=$userCatg=$name=$gender=$address=$email=$phone=$rpassword=$password=$confrmPassword=$photo=$remark= $userShft='';
				  

			}
		else
			{
				
				echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    Confirmation Password is not matching...
                  </div>";
			}
	}
	else
	{
		echo"<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>
                    Please fill mandatory fields...
                  </div>";
	}
}

?>

<?php 
if(isset($_POST["btnEdit"]))
{
$edtUserid=$_POST["txtEdtUserid"];
$edtUserCatg=$_POST["ddlEdtUserCat"];
$edtName=$_POST["txtEdtName"];
$today = date("Y-m-d H:i:s");
//$edtdateTime=$today;

//$edtDateTime=$_POST["txtEdtDateTime"];
$edtGender=$_POST["ddlEdtGender"];
$edtAddress=$_POST["textareaEdtAddress"];
$edtEmail=$_POST["txtEdtEmail"];
$edtPhone=$_POST["txtEdtPhone"];
$edtRemark=$_POST["txtareaEdtRemark"];

$edtShft=$_POST["ddlEdtUserShift"];

$hid=$_POST["hid"];

	if($edtUserid!='' && $edtUserCatg!='' && $edtName!='' && $edtGender!='' && $edtAddress!='' && $edtPhone!='')
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
		$updateQuery="UPDATE `user` SET	`Userid`='$edtUserid',	`Categoryid`='$edtUserCatg',	`Name`='$edtName',`Gender`='$edtGender',	`Address`='$edtAddress',	`Email`='$edtEmail',	Phone='$edtPhone',	`Remark`='$edtRemark',	`Status`='1', `Uflag`='0', `shft`='$edtShft' WHERE `Uid`=$hid";
	//	echo $updateQuery;
		mysqli_query($con, $updateQuery);
		
		//number_configuration
		if($edtUserCatg==2 || $edtUserCatg==3)
		{
			$ncquery="select * from `user` where `Uid`='$hid' and `Status`='1'";
	$ncqueryResult=mysqli_query($con, $ncquery);
		if(mysqli_num_rows($ncqueryResult)>=1)
			{
				$ncRow=mysqli_fetch_array($ncqueryResult);
				$cuid=$ncRow["Uid"];
				$cuname=$ncRow["Name"];
				$cunumber=$ncRow["Phone"];	
				$cudate=substr($ncRow["Datetime"],0,10);
				
				$selectnumcon="select * From `number_config` WHERE `ncflag`='$cuid' and `ncstatus`='1'";
				$resultnumcon=mysqli_query($con, $selectnumcon);
				if(mysqli_num_rows($resultnumcon)>=1)
			{
				$numconRow=mysqli_fetch_array($resultnumcon);
				
				$numconUpdate="update `number_config` set `ncnumber`='$cunumber', `ncfor`='$cuname', `ncfromDate`='$cudate' where `ncflag`='$cuid' AND  `ncstatus`='1'";
				mysqli_query($con, $numconUpdate);
			}
			else
			{
				$numconInsert="insert into `number_config` (`ncid`, `ncnumber`, `ncfor`, `ncflag`, `ncfromDate`, `ncstatus`, `freshness`) values(NULL, '$cunumber', '$cuname', '$cuid', '$cudate', '1', '1')";
				mysqli_query($con, $numconInsert);
			}
					
			}
		}
		
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
if(isset($_POST["edt"]))
{
	$editId=$_POST["edit"];
	//echo "you are editting";
	$editSelect="SELECT * FROM `user` WHERE `Uid`='$editId'";
   // echo $editSelect;
	$result=mysqli_query($con, $editSelect);
	while($editRow=mysqli_fetch_array($result))
	{
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
                      <select name="ddlEdtUserCat" id="UserCat" class="form-control" >
                      
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
    
                   
                     <div class="form-group">
                      <label for="UserShift">Shift<span style="color:#FF0000">*</span></label>
                      <select name="ddlEdtUserShift" id="UserShift" class="form-control" >
                      
                      <!-- user added-->
      <?php 
	  $editIds=$editRow["shft"];
	 // echo $editDistId;
		  $selectShftQuery="select * from `user_shift` where `shft_id`='$editIds' and `shft_status`='1'";
	  $resultShft=mysqli_query($con, $selectShftQuery);
	  while($resultShftRow=mysqli_fetch_array($resultShft))
	  {
	  ?>
      <option selected="selected" value="<?php echo @$resultShftRow["shft_id"];?>"><?php echo @$resultShftRow["shft_name"];?> </option>    
      <?php
	  }
	  ?>
        <!--other dist into dropdown-->
      <?php 
	  $selectOtherShftQuery="select * from `user_shift` where `shft_id`!='$editIds' and `shft_status`='1'";
	  $resultShftQuery=mysqli_query($con, $selectOtherShftQuery);
	  while($rowShft=mysqli_fetch_array($resultShftQuery))
	  {
	 ?>
     <option value="<?php echo @$rowShft["shft_id"];?>"><?php echo $rowShft["shft_name"];?> </option>
     <?php
	  }
	  ?>
      </select>
</div>

	                       
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                  <input name="hid" type="hidden" value="<?php echo $editRow["Uid"]?>" />
                   <button type="submit" name="btnEdit"  class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                  </div>
                </form>
                
                 <div class="box-footer">
                <form method="post" action="cpassword.php">
                 <input name="ehid" type="hidden" value="<?php echo $editRow["Uid"]?>" />
                   <button type="submit" name="btnPass"  class="btn btn-info"><i class="fa fa-magic"></i> Change password</button>
                </form>
                </div>
      <?php
	}
}
else
{ 
	?>
                
                <!-- form start -->
                <!----------------------------------------------ADD NEW---------------------------------------------------->
                
                <form role="form" method="post" enctype="multipart/form-data" >
                  <div class="box-body">
                  
                    <div class="form-group">
                      <label for="Userid">User Id<span style="color:#FF0000">*</span></label>
                      <input name="txtUserid" id="Userid" type="text" value="<?php echo @$userid;?>"  class="form-control"  placeholder="Enter User Id" />
                    </div>
                    
                     <div class="form-group">
                      <label for="UserCat">User Category<span style="color:#FF0000">*</span></label>
                      <select name="ddlUserCat" id="UserCat" class="form-control" >
                      
                       <?php 
	  $editId=@$userCatg;
	 // echo $editDistId;
		  $selectCatQuery="select * from `user_category` where `cid`='$editId' and `Status`='1'";
	  $resultCat=mysqli_query($con, $selectCatQuery);
	  while($resultCatRow=mysqli_fetch_array($resultCat))
	  {
	  ?>
      <option value="<?php echo @$resultCatRow["cid"];?>"><?php echo @$resultCatRow["Category"];?> </option>
      <?php
	  }
	  ?>
                      
      <option value="">SELECT</option>
        <?php 
		
			$selectUserCat="select * from `user_category` where `Status`='1'order by `Category` ASC ";
			$resultUserCat=mysqli_query($con, $selectUserCat);
			while($rowUserCat=mysqli_fetch_array($resultUserCat))
			{
			?>
       <option value="<?php echo @$rowUserCat["cid"];?>" > <?php echo @$rowUserCat["Category"];?> </option>        
	   <?php 
			}
			?>
      </select>
</div>

					<div class="form-group">
                      <label for="Name">Name<span style="color:#FF0000">*</span></label>
                      <input name="txtName" type="text" value="<?php echo @$name?>" id="Name"   class="form-control"  placeholder="Enter Name" />
                    </div>
                    
                   <div class="form-group">
                      <label for="Gender">Gender<span style="color:#FF0000">*</span></label>
                      <select name="ddlGender" id="Gender"  class="form-control" >
                      <?php
					  $tg=@$gender;
					  if($tg=="male")
					  {
					  ?>
                      <option value="male">male</option>
                      <?php
					  }
					  elseif($tg=="female")
					  {
						?>
                      <option value="female">female</option>
                      <?php
					  }
					  ?>
                      
    					<option value="">SELECT</option>
    					<option value="male">male</option>
      					<option value="female">female</option>
    				</select>
   				</div>
                 
                 <div class="form-group">
                      <label for="address">Address<span style="color:#FF0000">*</span></label>
                      <textarea name="textareaAddress" id="address"  class="form-control"  placeholder="Enter Address" ><?php echo @$address?></textarea>
                
                    </div>   
                   
                   	<div class="form-group">
                      <label for="Email">Email</label>
                      <input name="txtEmail" id="Email" type="email" value="<?php echo @$email?>" placeholder="example@abc.com"  class="form-control" />
                    </div>
                    
                    <div class="form-group">
                      <label for="Phone">Phone<span style="color:#FF0000">*</span></label>
                      <input name="txtPhone" type="tel" value="<?php echo @$phone?>" id="Phone"   class="form-control"  placeholder="Enter Phone" />
                    </div>
                   
                   	<div class="form-group">
                      <label for="Password">Password<span style="color:#FF0000">*</span></label>
                      <input name="txtPassword" type="password" value="<?php echo @$rpassword?>" id="Password" class="form-control"  placeholder="Choose a Password" />
                    
                    </div>
                    
                    <div class="form-group">
                      <label for="ConfPassword">Confirmation Password<span style="color:#FF0000">*</span></label>
                      <input name="txtConfPassword" type="password" value="<?php echo @$confrmPassword?>" id="ConfPassword"   class="form-control"  placeholder="Confirm Password" />
                    
    </div>
    
    <div class="form-group">
                      <label for="Photo">Photo (160 X 160 px)</label>
                      <input type="file" name="txtPhoto" value="<?php echo @$photo?>" id="Photo"  placeholder="Profile Picture" />
    </div>
    
    <div class="form-group">
                      <label for="Name">Remarks</label>
                      <textarea name="txtareaRemark" rows="5" id="Name"   class="form-control"  placeholder="Enter Remarks (If Any)" ><?php echo @$remark?></textarea>
                    
    </div>
    
    
      <div class="form-group">
                      <label for="UserShift">Shift</label>
                      <select name="ddlShift" id="UserShift" class="form-control" >
                      
                       <?php 
	  $editIds=@$userShft;
	 // echo $editDistId;
		  $selectShftQuery="select * from `user_shift` where `shft_id`='$editIds' and `shft_status`='1'";
	  $resultShft=mysqli_query($con, $selectShftQuery);
	  while($resultShftRow=mysqli_fetch_array($resultShft))
	  {
	  ?>
      <option value="<?php echo @$resultShftRow["shft_id"];?>"><?php echo @$resultShftRow["shft_name"];?> </option>
      <?php
	  }
	  ?>
                      
     <!-- <option value="">SELECT</option>-->
        <?php 
		
			$selectUserShft="select * from `user_shift` where `shft_id`!='$editIds' and `shft_status`='1'order by `shft_id` ASC ";
			$resultUserShft=mysqli_query($con, $selectUserShft);
			while($rowUserShft=mysqli_fetch_array($resultUserShft))
			{
			?>
       <option value="<?php echo @$rowUserShft["shft_id"];?>" > <?php echo @$rowUserShft["shft_name"];?> </option>        
	   <?php 
			}
			?>
      </select>
</div>
 </div><!-- /.box-body -->

                  <div class="box-footer">
                   <button type="submit" name="btnSave"  class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                  </div>
                </form>
                
  <?php
}
?> </div><!-- /.box -->
</div>
<div class="col-md-6">
  <!-- TO DO List -->
   <?php
   	require_once("../class/pagination.php");
   	$page=new pagination();
   	$page->perpage=10;
	$page->show=3;
	$page->con=$con;
	$page->query="SELECT a.*, b.* FROM `user` a, `user_category` b Where a.Categoryid=b.cid AND a.status='1' order by a.Name ASC";
   ?>
              <div class="box box-success">
                <div class="box-header">
               
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Users </h3>
                  <div class="box-tools pull-right">
                   <?php
				   $page->pagenav(); 
				   $perpage=$page->perpage;
				   $pstart=$page->pstart;
					?>
                 
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="todo-list">
                    <?php
$select="SELECT a.*, b.* FROM `user` a, `user_category` b Where a.Categoryid=b.cid AND a.status='1' order by a.Name ASC LIMIT $pstart,$perpage";
  $result=mysqli_query($con, $select);
while($row=mysqli_fetch_array($result))
  {
  ?>
                    <li>
                      <span class="handle">
                        <i class="fa  fa-hand-o-right"></i>
                      </span>
                      <span class="text"><?php echo $row["Name"];?></span>
                      
                       <small class="label label-default"><i class="fa fa-briefcase"></i> <?php echo $row["Category"];?></small>
                      
                      <div class="tools">
          <form  action="" method="post">
         <input name="edit" type="hidden" value="<?php echo $row["Uid"];?>"/>
          
          <button type="submit" name="edt" style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-edit"></i></button>
          <button type="submit" name="delt" onClick="return confirm('Are you sure you want to delete this?');"  style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-trash-o"></i></button>
         
         </form>
         </div>
                    </li>
                    <?php 
}
?>
                  </ul>
                  <br/>
                  <?php echo  $page->trows ." Found"; ?>
                  
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

  </body>
</html>
<?php
}
?>