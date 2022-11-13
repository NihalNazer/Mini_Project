<?php include("../config/conntme.php"); ?>
<?php
//validation for admin page;
if(!isset($_SESSION['homsuser']) || !isset($_SESSION['homsutype']) ||($_SESSION['homsutype']!=2))
{
	echo"<script type=\"text/javascript\">
 window.location.assign(\"../login\")
</script>";	
}
else
{
	/*require_once("../class/user.php");
   	$userclass=new users();
   	$userclass->user=$_SESSION['homsuser'];
	$userclass->userinfo();*/
	$user=$_SESSION['homsuser'];
?>
<?php include("../template.inc.php"); ?>

 <?php
 if(isset($_GET["ref"]))
 {
	 $ref=$_GET["ref"];
 $selectPermission="SELECT * FROM `enquiry` WHERE `eid`='$ref' AND `userid`='$user'";
// echo $selectPermission;
 $resultPermission=mysqli_query($con, $selectPermission);
if(mysqli_num_rows($resultPermission)==0)
 {
	 echo"<script type=\"text/javascript\">
 window.location.assign(\"followups.php\")
</script>";	      	 
 }
  }
 ?>
 
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
   <?php  tme_nav($con); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            BPE
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
             <!-- <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
           <li class="active"><i class="fa fa-comments-o"></i> Lead Entry</li>
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
               <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Lead Entry</h3>
                </div><!-- /.box-header -->


 <div class="my-box">   
 
     
      
<?php
if(isset($_POST["btnSave"]))
{
		
if(strlen(intval($_POST["txtCustNum"]))==10)
{
$number=$_POST["txtCustNum"];
} 
else
{
	$number='';
}

	 $tennumber=substr($number, -10);
//$number=$_POST["txtCustNum"];
	//$dateTimer=$_POST["txtDateAndTime"];
	
	//$dateTime=strftime('%Y-%m-%dT%H:%M:%S', strtotime($dateTimer));
	//$dateTimeo=strftime('%Y-%m-%d %H:%M:%S', strtotime($dateTimer));
	
	$remarks=$_POST["txtAreaRemarks"];
	 date_default_timezone_set('Asia/Kolkata');
					$CurrentDate=date('Y-m-d');
					$CurrentTime=date("h:i:s A");
					
					$eCurrentDate=date('d-m-Y');
					$eCurrentTime=date("H:i:s");
					
$dateTime=$eCurrentDate." ".$eCurrentTime;

	

					  //$selectCustomer="Select * from `customer` where (`contactNum1`='$tennumber' OR `contactNum2`='$tennumber') and `Status`=1";
					  $selectCustomer="Select * from `customer` where  ((`contactNum1`='$tennumber') OR (`contactNum2`='$tennumber' and `contactNum2`!='0')) and `Status`=1 order by `customerid` DESC LIMIT 0,1";
					  $resultCustomer=mysqli_query($con, $selectCustomer);
					  if(mysqli_num_rows($resultCustomer)>=1)
					  {
						  $rowCustomer=mysqli_fetch_array($resultCustomer);
						  $customer=$rowCustomer["customerid"];
					  }
					  else
					  {
						  $customer=0;
					  }

	/****************FROM SESSION**************/	
	$userId=$user;
	/**************************session*****************************/
	$selectsou="SELECT * FROM  `number_config` where `ncflag`='$userId' AND `ncstatus`='1'";
	$resultsou=mysqli_query($con, $selectsou);
	$rownum=mysqli_num_rows($resultsou);
	if($rownum>=1)
	{
		while($rowsou=mysqli_fetch_array($resultsou))
		{
		$source=$rowsou["ncid"];	
		}
	}
	else
	{	
	$source=0;
	}
	
	if($number!='' && $dateTime!='' && $remarks!='')
	{
		
		$selectb="select * from `enquiry` where `vnum`='$tennumber' AND `status`='1' AND `flag`='1' AND `userid`='$user'";
		$resultb=mysqli_query($con, $selectb);
		if(mysqli_num_rows($resultb)>=1)
		{	
		echo"<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>
                    Already Following by You, Check This Number in your Follow Up...
                  </div>";
		}
		else
		{
		
		$insertQuery="insert into `enquiry` (`eid`,`vnum`,`lnode`,`vctime`,`status`,`flag`,`customerid`,`userid`,`ERemarks`,`adate`,`atime`) values (NULL,'$tennumber','$source','$dateTime','1','1','$customer','$userId','$remarks','$CurrentDate','$CurrentTime')";
		mysqli_query($con, $insertQuery);
	
	
	echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                    Feedback Added Successfully...
                  </div>";
				  
				  $newSelect="Select * From `enquiry` where `vnum`='$number' AND `vctime`='$dateTime' AND `ERemarks`='$remarks' AND `lnode`='$source' AND `userid`='$userId' AND `status`='1'";
				 $newResult=mysqli_query($con, $newSelect);
				 
				 if(mysqli_num_rows($newResult)==1)
				 {
				 $newRow=mysqli_fetch_array($newResult);
				 $newId=$newRow["eid"];				 
				 echo"<script type=\"text/javascript\">
 window.location.assign(\"manage_followups.php?fref=$newId\")
</script>";
				 }
$number=$dateTime=$remarks=NULL;
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


</div>




                <!----------------------------------------------ADD NEW---------------------------------------------------->
                <!-- form start -->
                
                <form role="form" method="post" >
                  <div class="box-body">
                  
                  
                          
                   <div class="form-group">
                     <label for="number1">Phone Number<span style="color:#FF0000">*</span></label>
                     <input id="number" class="form-control" placeholder="Customer Number" name="txtCustNum" value="<?php echo @$number;?>" type="text"   data-inputmask="&quot;mask&quot;: &quot;9999999999&quot;" data-mask=""   onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"  /> 
                     
                    </div>
                  <!--  
                    <div class="form-group">
                     <label for="dateTime">Date and Time<span style="color:#FF0000">*</span></label>
                     <input name="txtDateAndTime" id="dateTime" placeholder="Date and Time" class="form-control" type="datetime-local" value="<?php echo @$dateTime;?>" />
                     
                    </div>
  -->
  <div class="form-group">
       <label for="remarks">Remarks<span style="color:#FF0000">*</span></label>
       <textarea id="remarks" placeholder="Remarks" name="txtAreaRemarks" rows="5"  class="form-control" ><?php echo @$remarks;?></textarea></td>             
     </div>
            
      

 </div><!-- /.box-body -->

                  <div class="box-footer">
                   <button type="submit" name="btnSave"  class="btn btn-primary"><i class="fa fa-save"></i> Save Lead</button>
                  </div>
                </form>
                
  

                
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
     
     <!-- Page script -->
    <script type="text/javascript">
      $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                  ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                  },
                  startDate: moment().subtract('days', 29),
                  endDate: moment()
                },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>

   
  </body>
</html>
<?php
}
?>