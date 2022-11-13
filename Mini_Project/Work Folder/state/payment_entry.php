<?php include("../config/conntme.php"); ?>
<?php
//validation for admin page;
if(!isset($_SESSION['homsuser']) || !isset($_SESSION['homsutype']) ||($_SESSION['homsutype']!=9))
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
 <script>
$(document).ready(function(){
    $("#inputTextBox").keypress(function(event){
        var inputValue = event.which;
        // allow letters and whitespaces only.
        if((inputValue > 47 && inputValue < 58) && (inputValue != 32)){
            event.preventDefault();
        }
    });
});
</script>
  <body class="skin-black">
    <div class="wrapper">

      	<?php top($con); ?>
      <!-- Left side column. contains the logo and sidebar -->
   <?php  frm_nav($con); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h1>
           State Co-Ordinator
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
             <!-- <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
           <li class="active"><i class="fa fa-shopping-cart"></i>Agent Payments</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
           <?php
 if(isset($_POST["btnRef"]))
 {
	 $refid=$_POST["refid"];
 }
 elseif(isset($_POST["btnSave"]))
{	
 	$refid=$_POST["refid"];
}
elseif(isset($_POST["edt"]))
{	
 	$refid=$_POST["refid"];
}
elseif(isset($_POST["delt"]))
{	
 	$refid=$_POST["refid"];
}
elseif(isset($_POST["btnEdit"]))
{	
 	$refid=$_POST["refid"];
}


else
{
	echo"<script type=\"text/javascript\">
 window.location.assign(\"payments.php\")
</script>";	
}
 ?>
 
        
        <div class="row">        

    <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-danger">
                <div class="box-header">
               <i class="fa fa-user"></i>
                  <h3 class="box-title">Agent Details</h3>
                </div><!-- /.box-header -->
                
          
 <div class="my-box">   
                 
<?php
if(isset($_POST["btnSave"]))
{		
$amt=$_POST["txtAmt"];
$tdate=$_POST["txtTdate"];
$inv=$_POST["txtInv"];
if($inv!='')
{
$refNo='P-'.$inv;
}
else
{
	$refNo='';
}
if($amt!='' && $tdate!='')
	{ 
		$query="select `En_id` from `inventry` where `En_TDate`='$tdate' AND `En_ref` like '$refNo' and `En_type`=99 and `En_wh`='$refid' and `En_stat`='1'";
		$queryResult=mysqli_query($con, $query);
		if(mysqli_num_rows($queryResult)>=1)
			{
				echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    ALREADY EXISTING...
                  </div>";
			}
		else 
			{
						
			
			$cDTime=$CurrentDate.' '.$CurrentTime;
	
			$updateEntry="INSERT INTO `inventry` (`En_id`, `En_ref`, `En_type`, `En_wh`,  `En_pro`, `En_rcvbl`, `En_date`, `En_TDate`, `En_time`, `En_qty`, `En_stat`, `En_flag`) VALUES (NULL, '$refNo', '99', '$refid', '0','$amt', '$CurrentDate', '$tdate', '$CurrentTime', '0', '1', '1')";
		mysqli_query($con, $updateEntry);

		$updateAmt="UPDATE `user` set balance=balance-$amt, `ludate`='$CurrentDate', `lutime`='$CurrentTime', `luRid`='$refNo' where `Uid`='$refid'";
		mysqli_query($con, $updateAmt);
			
		//echo $updateOrder;
		$amt=$tdate=$inv=NULL;
		echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                   Added Successfully...
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
}//event
?>

<?php
if(isset($_POST["delt"]))
{

$hid=$_POST["editid"];

$joinQuery2="SELECT a.* FROM  `inventry` a WHERE a.En_id =  '$hid'";
$resultJoinQuery2=mysqli_query($con, $joinQuery2);
$joinQryResultRow2=mysqli_fetch_array($resultJoinQuery2);		
			$amt=$joinQryResultRow2["En_rcvbl"];
			$refNo=$joinQryResultRow2["En_ref"];	
			$cDTime=$CurrentDate.' '.$CurrentTime;
/******************displaying calculated values*********************/
		
		$updateAmt="UPDATE `user` set balance=balance+$amt, `ludate`='$CurrentDate', `lutime`='$CurrentTime', `luRid`='$refNo' where `Uid`='$refid'";
		mysqli_query($con, $updateAmt);
		
		$deleteInv="DELETE from `inventry` WHERE En_id =  '$hid'";
		mysqli_query($con, $deleteInv);
		
		/*****************update order_split******************/
	$amt='';
			
		echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                  Deleted Successfully...
                  </div>";	
				  }

?>
</div>
  <div class="box-body">
                 
                 <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tbody><tr>
                     <th>District</th>
                      <th>Name</th>
                      <th>Contact Number</th>
                      <th>Email</th>
                      </tr>
                    <?php
					$selectLead="select a.Uid, a.Name, a.Email, a.Phone, d.District from `user` a, `district` d where a.`Uid`='$refid' AND  a.Dist=d.`Did` AND a.Status=1";
					$resultLead=mysqli_query($con, $selectLead);
					while($rowLead=mysqli_fetch_array($resultLead))
					{
					?>
                    
                    <tr>
                      <td><?php echo $rowLead["District"];?></td>
                      <td>
					  <?php echo $rowLead["Name"]; ?>
                      
                      </td>
                      <td><?php echo $rowLead["Phone"]; ?></td>
                      <td><?php echo $rowLead["Email"]; ?></td>
                      </tr>
                   <?php
					}
					?>
                  </tbody></table>
                </div>
                 
                 </div>
                </div>
<!----------------------------------------------------PAGE CONTENTS START HERE ------------------------------------------------->
<div class="row">             

    <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
               <i class="fa fa-shopping-cart"></i>
                  <h3 class="box-title">Payment Entry (Agent)</h3>
                </div><!-- /.box-header -->

                <!----------------------------------------------ADD NEW---------------------------------------------------->
                <!-- form start -->
                
                <form role="form" method="post" >
                  <div class="box-body">
                  
                   <div class="form-group">
               <label for="Tdate">Date of Transaction<span style="color:#FF0000">*</span></label>
              <input id="Tdate" placeholder="Date of Tranasction" class="form-control" name="txtTdate" type="date" value="<?php echo @$tdate?>" />
               </div> 
               <div class="form-group">
               <label for="Inv">Receipt Number<span style="color:#FF0000"></span></label>
              <input id="Inv" placeholder="Receipt Number" class="form-control" name="txtInv" type="text" value="<?php echo @$inv?>" />
               </div> 
        			
     
     <div class="form-group">
               <label for="qty2">Amount<span style="color:#FF0000">*</span></label>
              <input id="qty2" placeholder="Quantity" class="form-control" name="txtAmt" type="text" value="<?php echo @$qty?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" />
               </div>    
                </div><!-- /.box-body -->

                  <div class="box-footer">
                   <input type="hidden" name="refid" value="<?php echo $refid;  ?>" /> 
                   <button type="submit" name="btnSave"  class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                  </div>
                </form>
 
      
              </div><!-- /.box -->
</div>

 <div class="col-md-6">
  <!-- TO DO List -->
   <?php
  
    $showUserid=$_SESSION['homsuser'];
   	require_once("../class/pagination.php");
   	$page=new pagination();
   	$page->perpage=10;
	$page->show=3;
	$page->con=$con;
	$page->query="select a.* from `inventry` a where a.En_stat='1' and a.En_wh=$refid and `En_type`=99 order by a.En_id DESC LIMIT 0,20 ";
   ?>
              <div class="box box-success">
                <div class="box-header">
               
                  <i class="fa fa-tags"></i>
                  <h3 class="box-title">Recent Payments</h3>
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
$select="select a.* from `inventry` a where a.En_stat='1' and a.En_wh=$refid and `En_type`=99 order by a.En_id DESC LIMIT $pstart,$perpage";
//echo $select;
  $result=mysqli_query($con, $select);
while($row=mysqli_fetch_array($result))
  {
  ?>
                    <li>
                      <span class="handle">
                      <i class="fa fa-tag"></i></span>
                      <span class="text"><?php echo $row["En_TDate"]." (".$row["En_ref"].")"?><span class="handle"><small class="label label-default"><i class="fa fa-inr"></i> <?php echo $row["En_rcvbl"];?></small></span></span>
           
                        <div class="tools">
          <form  action="" method="post">
          <input type="hidden" name="refid" value="<?php echo $row["En_wh"];?>" /> 
         <input name="editid" type="hidden" value="<?php echo $row["En_id"];?>"/>
          
         <!-- <button type="submit" name="edt" style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-edit"></i></button>-->
         <button type="submit" name="delt" onClick="return confirm('Are you sure you want to delete this?');" style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-trash-o"></i></button>
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