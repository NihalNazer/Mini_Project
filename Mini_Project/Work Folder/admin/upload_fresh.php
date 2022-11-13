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
            <li class="active"><i class="fa fa-upload"></i> Data Upload (Fresh)</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
<!----------------------------------------------------PAGE CONTENTS START HERE ------------------------------------------------->
<div class="row">             

 <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Upload Fresh Data (as .csv file)</h3>
                </div><!-- /.box-header -->
                                <?php
//$deleterecords = "TRUNCATE TABLE tablename"; //empty the table of its current records
//mysqli_query($con, $deleterecords);

//Upload File
if (isset($_POST['submit'])) {
	?>
                
                <div class="my-box">

	<?php
	$Number=$_POST["number"];
	$photo=$_FILES["filename"]["name"];
	if($Number!='' && $photo!='')
	{	
	$SelectNumber="Select `ncid` From `number_config` where `ncid`='$Number'";
	$ResultNumber=mysqli_query($con, $SelectNumber);
	$rowNumber=mysqli_fetch_array($ResultNumber);
	//$myNumber=$rowNumber["ncnumber"];
	$myNumber=$rowNumber["ncid"];
	
	//Import uploaded file to Database
	$handle = fopen($_FILES['filename']['tmp_name'], "r");
$firstRow = true;

while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

	if($firstRow) { $firstRow = false; }
	else {
		
		$tennumber=substr($data[1], -10);
		$selecta="select `eid` from `enquiry` where `sid`='$data[0]' and `vnum`='$tennumber' and `vctime`='$data[2]' AND `status`=1";
		$resulta=mysqli_query($con, $selecta);
		if(mysqli_num_rows($resulta)==0)
		{	
		//$selectb="select * from `enquiry` where `vnum`='$data[1]' and `userid`='0' AND `status`='1' AND `flag`='0' "; not alloted
		//$selectb="select * from `enquiry` where `vnum`='$tennumber' AND `status`='1' AND `flag`='0' ";
		$selectb="select `eid` from `enquiry` where `vnum`='$tennumber' AND `status`='1' AND `flag`='0' ";
		$resultb=mysqli_query($con, $selectb);
		if(mysqli_num_rows($resultb)==0)
		{	
		$selectCustomer="Select `customerid` from `customer` where  ((`contactNum1`='$tennumber') OR (`contactNum2`='$tennumber' and `contactNum2`!='0')) and `Status`=1 order by `customerid` DESC LIMIT 0,1";
					  $resultCustomer=mysqli_query($con, $selectCustomer);
					  if(mysqli_num_rows($resultCustomer)>=1)
					  {
						  $rowCustomer=mysqli_fetch_array($resultCustomer);
						  //echo " [".$rowCustomer["name"]."] ";
						  $cust=$rowCustomer["customerid"];
					  }
					  else
					  {
						  $cust='';
					  }
					   if($tennumber!='')
					  {
					  $import="INSERT into `enquiry`(eid,sid,vnum,lnode,vctime,ERemarks,status,customerid,fresh) values(NULL,'$data[0]','$tennumber','$myNumber','$data[2]','$data[3]','1','$cust','1')";
					  }
		
		mysqli_query($con, $import) or die(mysqli_error());
		
		}
		
		}
	}
}
if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
	
	 $msg="<h5>" . "File ". $_FILES['filename']['name'] ." Uploaded successfully." . "</h5>";
	 
	echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                    $msg
                  </div>";
//echo "<h2>Displaying contents:</h2>";
		//readfile($_FILES['filename']['tmp_name']);
	}
fclose($handle);

	//print "Import done";
	}
	else
	{
		echo"<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>
                    Fill all mandatory fields...
                  </div>";
	}

	?>
                </div>
                
                <?php
}
				?>
                
                <div class="box-body">
                <form enctype='multipart/form-data' action='' method='post'>
                  <div class="form-group">
                      <label for="leadSource"> Lead Source</label>
                     <select name="number" id="leadSource" class="form-control">
    
    <option value="">Select</option>
    <?php
	$selectNumbers="SELECT `ncid`, `ncfor` FROM  `number_config` WHERE `ncstatus`=1 AND `ncflag`=1 AND `freshness`=1  AND (ncfromDate<='$CurrentDate' AND nctoDate>='$CurrentDate') ORDER BY `ncfor` ASC";
	$resultNumbers=mysqli_query($con, $selectNumbers);
	while($rowNumbers=mysqli_fetch_array($resultNumbers))
	{
	?>
    <option value="<?php echo $rowNumbers["ncid"]; ?>"><?php echo $rowNumbers["ncfor"]; ?></option>
    <?php
	}
	?>
    </select>
                    </div>
                    
                    <div class="form-group">
                     <label for="file"> Choose .csv File [columns:ref_no|number|datetime|remarks]</label>
                     <input id="file" type='file' name='filename' class="form-control">
                    </div>
                   </div>
                     
                   <div class="box-footer">
                  <button type="submit" name="submit"  class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
                  </div> 
                    </form>
                    </div></div>
</div>

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