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
            <li class="active"><i class="fa fa-phone-square"></i> Campaigns</li>
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
                  <h3 class="box-title">Manage Numbers</h3>
                </div><!-- /.box-header -->


 <div class="my-box">   
 
    
   <?php 
if(isset($_POST["delt"]))
{
	$did=$_POST["edit"];
	 
	$delete="UPDATE `number_config` SET `ncstatus`='0' WHERE `ncid`='$did'";
	mysqli_query($con, $delete);
	echo "<div class=\"alert alert-info alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-info\"></i> Alert!</h4>
                   Number Deleted Successfully...
                  </div>";
}
?>
             
<?php
if(isset($_POST["btnSave"]))
{	
	$source=$_POST["txtSource"];
	$number=$_POST["txtNum"];
	$fromDate=$_POST["txtFromDate"];
	$toDate=$_POST["txtToDate"];
	$cfresh=$_POST["Cfresh"];
	
	if ($source!='' && $number!='' && $fromDate!='' && $toDate!='' && $cfresh!='' )
	{ 

$selectQuery="select `ncid` from `number_config` where `ncnumber` =  '$number' AND ((`ncfromDate` <=  '$fromDate' and `nctoDate` >=  '$fromDate' ) OR (`ncfromDate` <=  '$toDate' and `nctoDate` >=  '$toDate' ))";

	//echo $selectQuery;
	$resultQuery=mysqli_query($con, $selectQuery);  
	
	if($resultRow=mysqli_num_rows($resultQuery)>=1)
	{
	  echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    Already existing in database... Please contact your administrator ...
                  </div>";
  }
  else
  {
	 $insert="INSERT INTO `number_config` (`ncid`,	`ncnumber`,	`ncfor`,	`ncflag`,	`ncfromDate`,	`nctoDate`,	`ncstatus`, `freshness`) VALUES (NULL,'$number', '$source', '1', '$fromDate', '$toDate', '1', '$cfresh')";
	mysqli_query($con, $insert);
	//echo $insert;
	echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                    Inserted Successfully...
                  </div>";
				  $source=$number=$fromDate=$toDate=$cfresh=NULL;
  }
}
else
{
	echo"<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>
                    Please fill all fields...
                  </div>";
	}
}
?>

<?php
if(isset($_POST["btnEdit"]))
{
	$edtSource=$_POST["txtEdtSource"];
	$edtNumber=$_POST["txtEdtNum"];
	$edtFromDate=$_POST["txtEdtFromDate"];
	$edtToDate=$_POST["txtEdtToDate"];
	$ecfresh=$_POST["ECfresh"];
	
	$hid=$_POST["hid"];
	if($edtSource!='' && $edtNumber!='' && $edtFromDate!='' && $edtToDate!='' && $ecfresh!='')
	{
		$selectQry="select `ncid` from `number_config` where `ncnumber` =  '$edtNumber' AND ((`ncfromDate` <=  '$edtFromDate' and `nctoDate` >=  '$edtFromDate' ) OR (`ncfromDate` <=  '$edtToDate' and `nctoDate` >=  '$edtToDate' )) AND `ncid`!='$hid'";

	//echo $selectQuery;
	$rsltQry=mysqli_query($con, $selectQry);  
	
		if($rsltRow=mysqli_num_rows($rsltQry)>=1)
		{
	   echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    Already existing in database... Please contact your Administrator...
                  </div>";
   }
  else
  {
	$update="update `number_config` set 
`ncnumber`='$edtNumber', `ncfor`='$edtSource', `ncfromDate`='$edtFromDate', `nctoDate`='$edtToDate' , `freshness`='$ecfresh' where `ncid`='$hid'";
		mysqli_query($con, $update);
		//echo $update;
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
                    Please fill all fields...
                  </div>";
}

}
	
?>
</div>


<?php 
if(isset($_POST["edt"]))
{
	$editId=$_POST["edit"];
//	echo "you are editting";
	$editSelect="SELECT * FROM `number_config` WHERE `ncid`='$editId'";
	$result=mysqli_query($con, $editSelect);
	while($editRow=mysqli_fetch_array($result))
	{
?>
<form role="form" method="post" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="src">Source<span style="color:#FF0000">*</span></label>
                     <input name="txtEdtSource" class="form-control" id="src"  type="text" value="<?php echo $editRow["ncfor"];?>" placeholder="Source"/>
                     
                    </div>
                    
                    <div class="form-group">
                    <label for="number">Number<span style="color:#FF0000">*</span></label>
                    <input name="txtEdtNum" type="text" class="form-control"  value="<?php echo $editRow["ncnumber"];?>" id="number" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" placeholder="Number"/>
                    </div>
                    
                     <div class="form-group">
                     <label for="from">From Date<span style="color:#FF0000">*</span></label>
                     <input name="txtEdtFromDate" type="date" class="form-control"  value="<?php echo  $editRow["ncfromDate"];?>" id="from" placeholder="From Date"/>
                    </div>
                    
                     <div class="form-group">
                     <label for="to">To Date<span style="color:#FF0000">*</span></label>
                     <input name="txtEdtToDate" type="date" class="form-control"  value="<?php echo  $editRow["nctoDate"];?>" id="to" placeholder="To Date"/>
                    </div>
                    
                  <div class="form-group">
                     <label for="efresh">Lead Status <span style="color:#FF0000">*</span></label>
                     <select id="efresh" name="ECfresh" class="form-control">
                     <option value="1">Fresh Data</option>
                     <option value="2" <?php if($editRow["freshness"]==2){echo "Selected";} ?>>Secondary Data</option>
                     </select>
                     </div>                      
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                  <input type="hidden" name="hid" value="<?php echo $editRow["ncid"];?>" /> 
                   <button type="submit" name="btnEdit"  class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                  </div>
                </form>
      <?php
	}
}
else
{
	?>
                
                <!-- form start -->
                
                <form role="form" method="post" >
                  <div class="box-body">
                    
                        <div class="form-group">
                      <label for="src">Source<span style="color:#FF0000">*</span></label>
                     <input name="txtSource" class="form-control" id="src"  type="text" value="<?php echo @$source;?>" placeholder="Source"/>
                     
                    </div>
                    
                    <div class="form-group">
                    <label for="number">Number<span style="color:#FF0000">*</span></label>
                    <input name="txtNum" type="text" class="form-control" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" value="<?php echo @$number ?>" id="number"  placeholder="Number"/>
                    </div>
                    
                     <div class="form-group">
                     <label for="from">From Date<span style="color:#FF0000">*</span></label>
                     <input name="txtFromDate" type="date" class="form-control"  value="<?php echo @$fromDate ?>" id="from" placeholder="From Date"/>
                    </div>
                    
                     <div class="form-group">
                     <label for="to">To Date<span style="color:#FF0000">*</span></label>
                     <input name="txtToDate" type="date" class="form-control"  value="<?php echo @$toDate ?>" id="to" placeholder="To Date"/>
                    </div>
                  <div class="form-group">
                     <label for="fresh">Lead Status <span style="color:#FF0000">*</span></label>
                     <select id="fresh" name="Cfresh" class="form-control">
                     <option value="1">Fresh Data</option>
                     <option value="2" <?php if(@$fresh==2){echo "Selected";} ?>>Secondary Data</option>
                     </select>
                     </div>                
                    
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                   <button type="submit" name="btnSave"  class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                  </div>
                </form>
                
  <?php
}
?>

                
              </div><!-- /.box -->
</div>



 <div class="col-md-6">
  <!-- TO DO List -->
   <?php
   	require_once("../class/pagination.php");
   	$page=new pagination();
   	$page->perpage=7;
	$page->show=3;
	$page->con=$con;
	$page->query="select * from `number_config` where `ncstatus`='1' AND `ncflag`='1' order by `ncid` DESC";
   ?>
              <div class="box box-success">
                <div class="box-header">
               
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title"> Numbers</h3>
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
$select="select * from `number_config` where `ncstatus`='1' AND `ncflag`='1' order by `ncnumber` ASC LIMIT $pstart,$perpage";
  $result=mysqli_query($con, $select);
while($row=mysqli_fetch_array($result))
  {
  ?>
                    <li>
                      <span class="handle">
                        <i class="fa  fa-hand-o-right"></i>
                      </span>
                      <span class="text"><?php echo $row["ncfor"]." (".$row["ncnumber"].")";?></span>
                      <?php
					  $usercategory=$row["ncid"];
					  $selectusers="SELECT count(eid) as ecount FROM `enquiry` WHERE `lnode`='$usercategory'";
					  $resultusers=mysqli_query($con, $selectusers);
					  while($rowcount=mysqli_fetch_array($resultusers))
					  {
						  $EngCount=$rowcount["ecount"];
					  }
					  
						  if($EngCount==1)
					  {
					  ?>
                       <small class="label label-default"><i class="fa fa-phone"></i> Only 1 Enquiry</small>
                      <?php
					  }
					  elseif($EngCount>1)
					  {
					  ?>
                      
                      <small class="label label-default"><i class="fa  fa-phone"></i> <?php echo mysqli_num_rows($resultusers); ?> Enquiries</small>
                      
                      <?php
					   }
					  ?>
                      <div class="tools">
          <form  action="" method="post">
         <input name="edit" type="hidden" value="<?php echo $row["ncid"];?>"/>
          
          <button type="submit" name="edt" style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-edit"></i></button>
          <button type="submit" name="delt"  onclick="return confirm('Are you sure you want to delete this?');" style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-trash-o"></i></button>
         
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

    <!-- REQUIRED JS SCRIPTS -->
    
     <?php jss(); ?>

</html>
<?php
}
?>