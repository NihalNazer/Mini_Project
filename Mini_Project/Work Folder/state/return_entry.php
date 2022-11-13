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
           <li class="active"><i class="fa fa-shopping-cart"></i>Item Return</li>
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
 window.location.assign(\"return.php\")
</script>";	
}
 ?>
 <?php
 $selectClass="SELECT `Class` from `user` where `Uid`='$refid'";
 $resultClass=mysqli_query($con, $selectClass);
 while($rowClass=mysqli_fetch_array($resultClass))
 {
   $agclass=$rowClass["Class"];
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
$tdate=$_POST["txtTdate"];
$inv=$_POST["txtInv"];
if($inv!='')
{
$refNo='R-'.$inv;
}
else
{
	$refNo='';
}
if($item!='' && $qty!='' && $tdate!='')
	{ 
		$query="select `En_id` from `inventry` where `En_TDate`='$tdate' AND `En_ref` like '$refNo' and `En_type`=3 and `En_wh`='$refid' and `En_pro`='$item' and `En_stat`='1'";
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
			
			$joinQuery1="SELECT a.aperc, a.aprice, a.bperc, a.bprice, a.cperc, a.cprice FROM  `product` a WHERE a.pid =  '$item'";
			//echo $joinQuery1;
			$resultJoinQuery1=mysqli_query($con, $joinQuery1);
			$joinQryResultRow1=mysqli_fetch_array($resultJoinQuery1);
			if($agclass==1)
    {
      $oprice=$joinQryResultRow1["aprice"];   
      $advper=$joinQryResultRow1["aperc"];  
        }
        elseif($agclass==2)
    {
      $oprice=$joinQryResultRow1["bprice"];   
      $advper=$joinQryResultRow1["bperc"];  
        }
         elseif($agclass==3)
    {
      $oprice=$joinQryResultRow1["cprice"];   
      $advper=$joinQryResultRow1["cperc"];  
        }
        else
    {
      $oprice=$joinQryResultRow1["aprice"];   
      $advper=$joinQryResultRow1["aperc"];  
        }		
			/*************CALCULATIONS*************/
			$advance=$oprice*(($advper/100)*$qty);
			$cDTime=$CurrentDate.' '.$CurrentTime;
	
			$updateEntry="INSERT INTO `inventry` (`En_id`, `En_ref`, `En_type`, `En_wh`,  `En_pro`, `En_rcvbl`, `En_date`, `En_TDate`, `En_time`, `En_qty`, `En_stat`, `En_flag`) VALUES (NULL, '$refNo', '3', '$refid', '$item','$advance', '$CurrentDate', '$tdate', '$CurrentTime', '$qty', '1', '1')";
		mysqli_query($con, $updateEntry);
		
		$selectInvo="select count(inv_id) as invc from `inventory` where `inv_wh`='$refid' and `inv_pro`='$item' and `inv_stat`='1'";
		$resultInvo=mysqli_query($con,$selectInvo);
		while($rowInvo=mysqli_fetch_array($resultInvo))
		{
			$invc=$rowInvo["invc"];
		}
		if($invc>=1)
		{		
		$updateInv="UPDATE `inventory` set inv_cS=inv_cS-$qty, `inv_cDT`='$cDTime', `luRid`='$refNo' where `inv_wh`='$refid' and `inv_pro`='$item' and `inv_stat`='1'";
		}
		else
		{
			$updateInv="INSERT INTO `inventory` (`inv_id`, `inv_wh`, `inv_pro`, `inv_oS`,  `inv_oDT`, `inv_cS`, `inv_cDT`, `inv_stat`, `inv_flag`, `luRid`) VALUES (NULL, '$refid', '$item','$qty',  '$cDTime','$qty', '$cDTime', '1', '1', '$refNo')";
		}

		mysqli_query($con, $updateInv);
		$updateAmt="UPDATE `user` set balance=balance-$advance, `ludate`='$CurrentDate', `lutime`='$CurrentTime', `luRid`='$refNo' where `Uid`='$refid'";
		mysqli_query($con, $updateAmt);
			
		//echo $updateOrder;
		$item=$qty=$tdate=$inv=NULL;
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
			$advance=$joinQryResultRow2["En_rcvbl"];
			$item=$joinQryResultRow2["En_pro"];
			$qty=$joinQryResultRow2["En_qty"];	
			$refNo=$joinQryResultRow2["En_ref"];	
			$cDTime=$CurrentDate.' '.$CurrentTime;
/******************displaying calculated values*********************/
			
		$updateInv="UPDATE `inventory` set inv_cS=inv_cS+$qty, `inv_cDT`='$cDTime', `luRid`='$refNo' where `inv_wh`='$refid' and `inv_pro`='$item' and `inv_stat`='1'";
		mysqli_query($con, $updateInv);
		$updateAmt="UPDATE `user` set balance=balance+$advance, `ludate`='$CurrentDate', `lutime`='$CurrentTime', `luRid`='$refNo' where `Uid`='$refid'";
		mysqli_query($con, $updateAmt);
		
		$deleteInv="DELETE from `inventry` WHERE En_id =  '$hid'";
		mysqli_query($con, $deleteInv);
		
		/*****************update order_split******************/
	$item=$qty='';
			
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
                  <h3 class="box-title">Item Entry (Return)</h3>
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
               <label for="Inv">Credit Note Number<span style="color:#FF0000"></span></label>
              <input id="Inv" placeholder="Credit Note Number" class="form-control" name="txtInv" type="text" value="<?php echo @$inv?>" />
               </div> 
        			 <div class="form-group">
                      <label for="product">Product<span style="color:#FF0000">*</span></label>
                      <select id="product"  style="width:100%;"  name="ddlProduct">
    <option value="">SELECT</option>
    <!-----------------------------product addded---------------------------->
    <?php 
	$editId=@$item;
	//$selectProduct="select * from `product` where `pid`='$editId' and `status`='1'  order by `Product` ASC";
	$selectProduct="select a.pid, a.Product, a.aprice, a.bprice, a.cprice from `product` a,`product_category` b where a.`pid`='$editId' and  a.status='1' and a.catid=b.catid order by a.Product ASC";
	$resultQuery=mysqli_query($con, $selectProduct);
	while($resultRow=mysqli_fetch_array($resultQuery))
	{
	
  if($agclass==1)
    {
  ?> <option selected="selected" value="<?php echo $resultRow["pid"];?>"><?php echo $resultRow["Product"]." (Rs. ".$resultRow["aprice"].")";?></option>
    <?php
  }
  elseif($agclass==2)
    {
  ?> <option selected="selected" value="<?php echo $resultRow["pid"];?>"><?php echo $resultRow["Product"]." (Rs. ".$resultRow["bprice"].")";?></option>
    <?php
  }
  elseif($agclass==3)
    {
  ?> <option selected="selected" value="<?php echo $resultRow["pid"];?>"><?php echo $resultRow["Product"]." (Rs. ".$resultRow["cprice"].")";?></option>
    <?php
  }
  else
    {
  ?> <option selected="selected" value="<?php echo $resultRow["pid"];?>"><?php echo $resultRow["Product"]." (Rs. ".$resultRow["aprice"].")";?></option>
    <?php
  }
	}
	?>
    <!-------------------------other products into drop down list-------------------------->
    <?php 
	$selectOtherProducts="select a.pid, a.Product, a.aprice, a.bprice, a.cprice from `product` a,`product_category` b where a.`pid`!='$editId' and  a.status='1' and a.catid=b.catid order by a.Product ASC";
	$resultProducts=mysqli_query($con, $selectOtherProducts);
	while($row=mysqli_fetch_array($resultProducts))
	{
    if($agclass==1)
    {
  ?>
    <option value="<?php echo $row["pid"];?>"><?php echo $row["Product"]." (Rs. ".$row["aprice"].")";?></option>
    <?php
  }
  elseif($agclass==2)
    {
  ?>
    <option value="<?php echo $row["pid"];?>"><?php echo $row["Product"]." (Rs. ".$row["bprice"].")";?></option>
    <?php
  }
  elseif($agclass==3)
    {
  ?>
    <option value="<?php echo $row["pid"];?>"><?php echo $row["Product"]." (Rs. ".$row["cprice"].")";?></option>
    <?php
  }
  else
    {
  ?>
    <option value="<?php echo $row["pid"];?>"><?php echo $row["Product"]." (Rs. ".$row["aprice"].")";?></option>
    <?php
  }
	}
	 ?>
    </select>
     
     </div> 
     
     <div class="form-group">
               <label for="qty2">Quantity<span style="color:#FF0000">*</span></label>
              <input id="qty2" placeholder="Quantity" class="form-control" name="txtqty" type="text" value="<?php echo @$qty?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" />
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
	$page->query="select a.*, b.* from `inventry` a, `product` b where a.En_pro=b.pid and a.En_stat='1' and a.En_wh=$refid and `En_type`=3 order by a.En_id DESC LIMIT 0,20 ";
   ?>
              <div class="box box-success">
                <div class="box-header">
               
                  <i class="fa fa-tags"></i>
                  <h3 class="box-title">Recently Returned Items</h3>
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
$select="select a.*, b.* from `inventry` a, `product` b where a.En_pro=b.pid and a.En_stat='1' and a.En_wh=$refid and `En_type`=3 order by a.En_id DESC LIMIT $pstart,$perpage";
//echo $select;
  $result=mysqli_query($con, $select);
while($row=mysqli_fetch_array($result))
  {
  ?>
                    <li>
                      <span class="handle">
                      <i class="fa fa-tag"></i></span>
                      <span class="text"><?php echo $row["Product"]." (".$row["En_qty"].")"?><span class="handle"><small class="label label-default"><i class="fa fa-ticket"></i> <?php echo $row["En_ref"];?></small></span></span>
           
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