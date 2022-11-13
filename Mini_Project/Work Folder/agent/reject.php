<?php include("../config/connfc.php"); ?>
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
           <li class="active"><i class="fa fa-shopping-cart"></i>Order</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
           <?php
 if(isset($_POST["reject"]))
 {
	 $refid=$_POST["ordr"];
 }
 elseif(isset($_POST["btnSave"]))
{ 
  $refid=$_POST["refid"];
}
else
{
	echo"<script type=\"text/javascript\">
 window.location.assign(\"index.php\")
</script>";	
}
 ?>
          <?php 
//if(isset($_POST["btnRef"]) || isset($_POST["btnSave"]) || isset($_POST["btnEdit"]))
if(isset($refid))
{
	$eId=$refid;

//	echo "you are editting";
	$editSelect="Select * from `order` where `oid`='$eId' AND Status=1";
	//echo $editSelect;
	$result=mysqli_query($con, $editSelect);
	if(mysqli_num_rows($result)>=1)
	{
	while($editRow=mysqli_fetch_array($result))
	{
		$order=$editRow["oid"];
		 $ordr=$editRow["oid"]; 
		 $oeid=$editRow["eid"];
		?>
        
        <div class="row">        

    <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-danger">
                <div class="box-header">
               <i class="fa fa-shopping-cart"></i>
                  <h3 class="box-title">Order Details</h3>
                </div><!-- /.box-header -->
                
          
 <div class="my-box">   
                 
             
<?php
if(isset($_POST["btnSave"]))
{		
/***************from session*****************/
$Ordrid=$ordr;
$rr=$_POST["reason"];
$remark=$_POST["remark"];
if($remark!='')
{
	$rrmark=$rr." - ".$remark;
}
else
{
	$rrmark=$rr;
}

if($rr!='')
{
$updateStatus="Update `order` SET  `oFlag`='10' WHERE `oid`='$Ordrid'";
	mysqli_query($con, $updateStatus);
	$insertOrdr="INSERT INTO `order_status_update` 
		(`OSUid`, `Oid`,`OSid`,`uid`,`OSUdate`,`OSUtime`,`OSUstatus`,`OSUflag`,`OSUremark`)
		VALUES (NULL, '$Ordrid', '10', '$user', '$CurrentDate', '$CurrentTime', '1', '1','$rrmark')";
		mysqli_query($con, $insertOrdr);
	
		
		echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                   Rejection Entered Successfully ...
                  </div>";
				  
				  echo"<script type=\"text/javascript\">
 window.location.assign(\"index.php\")
</script>";
}
else
{
	echo"<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>
                    Please select the reason...
                  </div>";
}


/***************from session*****************/

}//event
?>


</div>

                 <div class="box-body">
                 
                 <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tbody><tr>
                      <th>Order_Id</th>
                      <th>Contact Number</th>
                      <th>Customer</th>	
                      <th>Date</th>
                      <th>#Grand Total</th>
                      </tr>
                    <?php
					$selectLead="SELECT a.*, b.* FROM  `order` a, `customer` b WHERE a.customerid= b.customerid AND a.status=1  AND a.`oid`='$refid'";
					$resultLead=mysqli_query($con, $selectLead);
					while($rowLead=mysqli_fetch_array($resultLead))
					{
					?>
                    
                    <tr>
                      <td><?php echo $rowLead["oid"];?></td>
                      <td>
					  <?php echo $rowLead["contactNum1"]; ?>
                      
                      </td>
                      <td><?php echo $rowLead["name"]; ?></td>
                      <td><?php echo $rowLead["date"]; ?></td>
                      <td><i class="fa fa-fw fa-inr"></i> <?php echo $rowLead["gtotal"]; ?></td>
                      </tr>
                   <?php
					}
					?>
                  </tbody></table>
                </div>
                 
                 </div>
                </div>
        
             
        <?php
			}
	}
	
}
?>
          
    
<!----------------------------------------------------PAGE CONTENTS START HERE ------------------------------------------------->
<div class="row">             

    <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
               <i class="fa fa-shopping-cart"></i>
                  <h3 class="box-title">Reason for Rejection</h3>
                </div><!-- /.box-header -->
 <!----------------------------------------------ADD NEW---------------------------------------------------->
                <!-- form start -->
                
                <form role="form" method="post" >
                  <div class="box-body">
                  
        			 <div class="form-group">
                      <label for="reason">Reason<span style="color:#FF0000">*</span></label>
                      <select id="reason"  style="width:100%;"  name="reason"  class="form-control" autofocus >
    <option value="">SELECT</option>
    <!-----------------------------product addded---------------------------->
    <?php 
	$editId=@$rr;
	//$selectProduct="select * from `product` where `pid`='$editId' and `status`='1'  order by `Product` ASC";
	$selectProduct="select a.* from `reject_reason` a where  a.`RR_id`='$editId' and  a.RR_status='1' order by a.RR_name ASC";
	$resultQuery=mysqli_query($con, $selectProduct);
	while($resultRow=mysqli_fetch_array($resultQuery))
	{
	?>
    <option selected="selected" value="<?php echo $resultRow["RR_name"];?>"><?php echo $resultRow["RR_name"];?></option>
    <?php
	}
	?>
    <!-------------------------other products into drop down list-------------------------->
    <?php 
	//$selectOtherProducts="select * from `product` where `pid`!='$editId' and `status`='1'  order by `Product` ASC";
	$selectOtherProducts="select a.* from `reject_reason` a where  a.`RR_id`!='$editId' and  a.RR_status='1' order by a.RR_name ASC";
	$resultProducts=mysqli_query($con, $selectOtherProducts);
	while($row=mysqli_fetch_array($resultProducts))
	{
	?>
    <option value="<?php echo $row["RR_name"];?>"><?php echo $row["RR_name"];?></option>
    <?php
	}
	 ?>
     
      <option value="Others">Others</option>
      
    </select>
     </div> 
     
     <div class="form-group">
               <label for="remark">Remarks</label>
              <input id="remark" placeholder="Remarks(if any)" maxlength="50" class="form-control" name="remark" type="text" value="<?php echo @$remark?>"/>
               </div>    
                </div><!-- /.box-body -->

                  <div class="box-footer">
                   <input type="hidden" name="refid" value="<?php echo $refid;  ?>" /> 
                   <button type="submit" name="btnSave"  class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                  </div>
                </form>
                
 
 <div class="box-footer">
 <form method="post" action="invoice.php" target="_blank">
 <input type="hidden" name="refid" value="<?php echo $ordr;?>" /> 
 <button type="submit" name="btnShow"  class="btn btn-default"><i class="fa fa-file-text"></i> Show Invoice</button>
 </form>
 </div>
                
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
	$page->query="select b.OsName, d.Name, a.OSUdate, a.OSUtime from `order_status_update` a, `order_status` b, `order` c, `user` d, `user_category` e  where a.Oid=c.oid AND a.OSid=b.OsId AND a.uid=d.Uid AND d.Categoryid=e.cid AND  a.OSUstatus=1 AND a.`Oid`='$ordr' order by a.OSUid ASC ";
   ?>
              <div class="box box-success">
                <div class="box-header">
               
                  <i class="fa fa-tags"></i>
                  <h3 class="box-title"> Order Status Update</h3>
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
$select="select b.OsName, d.Name, a.OSUdate, a.OSUtime from `order_status_update` a, `order_status` b, `order` c, `user` d, `user_category` e  where a.Oid=c.oid AND a.OSid=b.OsId AND a.uid=d.Uid AND d.Categoryid=e.cid AND  a.OSUstatus=1 AND a.`Oid`='$ordr' order by a.OSUid ASC LIMIT $pstart,$perpage";
//echo $select;
  $result=mysqli_query($con, $select);
while($row=mysqli_fetch_array($result))
  {
  ?>
                    <li>
                      <span class="handle">
                      <i class="fa fa-tag"></i></span>
                      <span class="text"><?php echo $row["OsName"]." (".$row["Name"].")"?><span class="handle"><small class="label label-default"><i class="fa fa-inr"></i> <?php echo $row["OSUdate"]." ".$row["OSUtime"];?></small></span></span>
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