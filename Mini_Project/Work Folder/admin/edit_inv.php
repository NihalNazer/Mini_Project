<?php include("../config/conntme.php"); ?>
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
           <li class="active"><i class="fa fa-shopping-cart"></i>Inventory</li>
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
 window.location.assign(\"inventory.php\")
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
$item=$_POST["ddlProduct"];
$qty=$_POST["txtqty"];
if($item!='' && $qty!='')
	{ 
		$query="select `inv_id` from `inventory` where `inv_wh`='$refid' and `inv_pro`='$item' and `inv_stat`='1'";
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
						
			/************join query for getting offerprice & rateoftax**********/
			
			$joinQuery1="SELECT a.rperc, a.oprice FROM  `product` a WHERE a.pid =  '$item'";
			//echo $joinQuery1;
			$resultJoinQuery1=mysqli_query($con, $joinQuery1);
			$joinQryResultRow1=mysqli_fetch_array($resultJoinQuery1);
			$oprice=$joinQryResultRow1["oprice"];		
			$advper=$joinQryResultRow1["rperc"];		
			/*************CALCULATIONS*************/
			$advance=$oprice*(($advper/100)*$qty);
			$cDTime=$CurrentDate.' '.$CurrentTime;
			
			$insertQuery="INSERT INTO `inventory` (`inv_id`, `inv_wh`, `inv_pro`, `inv_oS`,  `inv_oDT`, `inv_cS`, `inv_cDT`, `inv_stat`, `inv_flag`) VALUES (NULL, '$refid', '$item','$qty',  '$cDTime','$qty', '$cDTime', '1', '1')";
	//echo $insertQuery;
		mysqli_query($con, $insertQuery);
		
		$selectInv="select `inv_id` from `inventory` where `inv_wh`='$refid' and `inv_pro`='$item' and `inv_stat`='1' order by `inv_id` asc";
		$resultInv=mysqli_query($con, $selectInv);
		while($rowInv=mysqli_fetch_array($resultInv))
		{
			$refNo='I-'.$rowInv["inv_id"];
		}		
		
		$queryI="select `en_id` from `inventry` where `En_ref` like '$refNo' and `En_stat`='1'";
		$queryResultI=mysqli_query($con, $queryI);
		if(mysqli_num_rows($queryResultI)>=1)
			{
				//echo "something went wrong";
			}
			else
			{
		$updateEntry="INSERT INTO `inventry` (`En_id`, `En_ref`, `En_type`, `En_wh`,  `En_pro`, `En_rcvbl`, `En_date`, `En_TDate`, `En_time`, `En_qty`, `En_stat`, `En_flag`) VALUES (NULL, '$refNo', '1', '$refid', '$item','0', '$CurrentDate','$CurrentDate','$CurrentTime', '$qty', '1', '1')";
		mysqli_query($con, $updateEntry);
			}
		//echo $updateOrder;
		$item=$qty=NULL;
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
if(isset($_POST["btnEdit"]))
{

$hid=$_POST["hid"];
$edtCode=$_POST["ddlEdtProduct"];
$edtQty=$_POST["txtEdtQty"];
$joinQuery2="SELECT a.* FROM  `product` a WHERE a.pid =  '$edtCode'";
$resultJoinQuery2=mysqli_query($con, $joinQuery2);
$joinQryResultRow2=mysqli_fetch_array($resultJoinQuery2);		
			$offerPrice=$joinQryResultRow2["oprice"];
			$advper=$joinQryResultRow2["rperc"];		
			/*************CALCULATIONS*************/
			$advance=$offerPrice*(($advper/100)*$edtQty);
			$cDTime=$CurrentDate.' '.$CurrentTime;
/******************displaying calculated values*********************/
	
	if($edtCode!='' && $edtQty!='')
	{
		$querySelect="select `inv_id` from `inventory` where `inv_wh`='$refid' and `inv_pro`='$edtCode' and `inv_stat`='1' and `inv_id`!='$hid'";
		$resultQuery=mysqli_query($con, $querySelect);
		//echo $querySelect;
		if(mysqli_num_rows($resultQuery)>=1)
		{
			echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                   ALREADY EXISTING...
                  </div>";
		}		
		else
		{		
		
		/*****************update order_split******************/
		$updateQuery="UPDATE `inventory` SET `inv_pro` = '$edtCode',`inv_oS` =  '$edtQty', `inv_oDT` = '$cDTime',`inv_cS` =  '$edtQty',`inv_cDT` = '$cDTime' WHERE `inv_id` =$hid";
		mysqli_query($con, $updateQuery);
		//echo"<br/>". $updateQuery;
		
		
		$refNo='I'.$hid;
		$updateEntry="update `inventry` SET `En_pro`='$edtCode' , `En_rcvbl`='0', `En_date`='$CurrentDate',  `En_TDate`='$CurrentDate', `En_time`='$CurrentTime', `En_qty`='$edtQty' where `En_ref` like '$refNo' ";
		mysqli_query($con, $updateEntry);
					
			
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
                    Please fill mandatory fields...
                  </div>";
	}

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
					$selectLead="Select a.Uid, a.Name, a.Email, a.Phone, d.District from `user` a, `district` d where a.`Uid`='$refid' AND  a.Dist=d.`Did` AND a.Status=1";
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
                  <h3 class="box-title">Item Entry</h3>
                </div><!-- /.box-header -->

 
 <?php
  if(isset($refid) || $refid!='')
  {
	  $selectLead="SELECT * FROM `enquiry` WHERE `eid`=$refid";
	  //echo $selectLead;
	  $resultLead=mysqli_query($con, $selectLead);
	  $rowLead=mysqli_fetch_array($resultLead);
	  //$oldAmt=$rowLead["Total_amount"];
	  //echo  $oldAmt;
  }
 ?>
    
  


<?php
 if(isset($_POST["edt"]))
 {
	 
	 $editId=$_POST["edit"];

 //   echo "you are editting";
	$editSelect="SELECT * FROM `inventory` WHERE `inv_id`='$editId'";
   // echo $editSelect;
	$result=mysqli_query($con, $editSelect);
	while($editRow=mysqli_fetch_array($result))
	{
?>
<!----------------------------------EDIT WAREHOUSE---------------------------------->
<form role="form" method="post" >
                  <div class="box-body">
              
                           
                   <div class="form-group">
                      <label for="product">Product<span style="color:#FF0000">*</span></label>
                      <select id="product" style="width:100%;" name="ddlEdtProduct">
        <!--product added-->
      <?php 
	  $editProductId=$editRow["inv_pro"];
	  $productQuery="select a.pid, a.Product, a.rprice, a.dealerprice from `product` a,`product_category` b where a.status='1' and a.catid=b.catid and a.`pid`='$editProductId' order by a.Product ASC";
	 // echo $productQuery;
	  $resultProduct=mysqli_query($con, $productQuery);
	  while($resultProductRow=mysqli_fetch_array($resultProduct))
	  {
	  ?>
      <option value="<?php echo $resultProductRow["pid"];?>"><?php echo $resultProductRow["Product"]." (Rs. ".$resultProductRow["dealerprice"].")";?></option>    
      <?php
	  }
	  ?>
        <!--other product into dropdown list-->
      <?php 
	    $pdtSelectQuery="select a.pid, a.Product, a.rprice, a.dealerprice from `product` a,`product_category` b where a.`pid`!='$editProductId' and a.status='1' and a.catid=b.catid order by a.Product ASC";
	  $resultPdtQuery=mysqli_query($con, $pdtSelectQuery);
	  while($pdtRow=mysqli_fetch_array($resultPdtQuery))
	  {
	 ?>
     <option value="<?php echo $pdtRow["pid"];?>"><?php echo $pdtRow["Product"]." (Rs. ".$pdtRow["dealerprice"].")";?> </option>
     <?php
	  }
	  ?>
      </select>
                    </div> 
                 
               <div class="form-group">
               <label for="qty">Current Stock<span style="color:#FF0000">*</span></label>
               <input id="qty" placeholder="Quantity" class="form-control" name="txtEdtQty" type="text" value="<?php echo @$editRow["inv_cS"]?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" />
               </div>    
               
               </div><!-- /.box-body -->

                  <div class="box-footer">
                  <input type="hidden" name="hid" value="<?php echo $editRow["inv_id"]; ?>" />
                 <input type="hidden" name="refid" value="<?php echo $refid;?>" />
                  <button type="submit" name="btnEdit"  class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                  </div>
                </form>
                 
<!----------------------------------EDIT WAREHOUSE END---------------------------------->     
      <?php
	}
}
else
{
	?>
                <!----------------------------------------------ADD NEW---------------------------------------------------->
                <!-- form start -->
                
                <form role="form" method="post" >
                  <div class="box-body">
                  
        			 <div class="form-group">
                      <label for="product">Product<span style="color:#FF0000">*</span></label>
                      <select id="product"  style="width:100%;"  name="ddlProduct">
    <option value="">SELECT</option>
    <!-----------------------------product addded---------------------------->
    <?php 
	$editId=@$item;
	//$selectProduct="select * from `product` where `pid`='$editId' and `status`='1'  order by `Product` ASC";
	$selectProduct="select a.pid, a.Product, a.dealerprice from `product` a,`product_category` b where a.`pid`='$editId' and  a.status='1' and a.catid=b.catid order by a.Product ASC";
	$resultQuery=mysqli_query($con, $selectProduct);
	while($resultRow=mysqli_fetch_array($resultQuery))
	{
	?>
    <option selected="selected" value="<?php echo $resultRow["pid"];?>"><?php echo $resultRow["Product"]." (Rs. ".$resultRow["dealerprice"].")";?></option>
    <?php
	}
	?>
    <!-------------------------other products into drop down list-------------------------->
    <?php 
	$selectOtherProducts="select a.pid, a.Product, a.dealerprice from `product` a,`product_category` b where a.`pid`!='$editId' and  a.status='1' and a.catid=b.catid order by a.Product ASC";
	$resultProducts=mysqli_query($con, $selectOtherProducts);
	while($row=mysqli_fetch_array($resultProducts))
	{
	?>
    <option value="<?php echo $row["pid"];?>"><?php echo $row["Product"]." (Rs. ".$row["dealerprice"].")";?></option>
    <?php
	}
	 ?>
    </select>
     
     </div> 
     
     <div class="form-group">
               <label for="qty2">Current Stock<span style="color:#FF0000">*</span></label>
              <input id="qty2" placeholder="Quantity" class="form-control" name="txtqty" type="text" value="<?php echo @$qty?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" />
               </div>    
                </div><!-- /.box-body -->

                  <div class="box-footer">
                   <input type="hidden" name="refid" value="<?php echo $refid;  ?>" /> 
                   <button type="submit" name="btnSave"  class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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
  
    $showUserid=$_SESSION['homsuser'];
   	require_once("../class/pagination.php");
   	$page=new pagination();
   	$page->perpage=10;
	$page->show=3;
	$page->con=$con;
	$page->query="select a.*, b.* from `inventory` a, `product` b where a.inv_pro=b.pid and a.inv_stat='1' and a.inv_wh=$refid order by a.inv_id ASC";
   ?>
              <div class="box box-success">
                <div class="box-header">
               
                  <i class="fa fa-tags"></i>
                  <h3 class="box-title">Added Items</h3>
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
$select="select a.*, b.* from `inventory` a, `product` b where a.inv_pro=b.pid and a.inv_stat='1' and a.inv_wh=$refid order by a.inv_id ASC LIMIT $pstart,$perpage";
//echo $select;
  $result=mysqli_query($con, $select);
while($row=mysqli_fetch_array($result))
  {
  ?>
                    <li>
                      <span class="handle">
                      <i class="fa fa-tag"></i></span>
                      <span class="text"><?php echo $row["Product"]." (".$row["inv_oS"].")"?><span class="handle"><small class="label label-default"><i class="fa fa-shopping-cart"></i> <?php echo $row["inv_cS"];?></small></span></span>
           
                        <div class="tools">
          <form  action="" method="post">
          <input type="hidden" name="refid" value="<?php echo $row["inv_wh"];?>" /> 
         <input name="edit" type="hidden" value="<?php echo $row["inv_id"];?>"/>
          
          <button type="submit" name="edt" style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-edit"></i></button>
         <!--<button type="submit" name="delt" onClick="return confirm('Are you sure you want to delete this?');" style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-trash-o"></i></button>-->
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