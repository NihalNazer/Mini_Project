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
           <li class="active"><i class="fa fa-shopping-cart"></i>Order</li>
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
 window.location.assign(\"manage_bulk_orders.php\")
</script>";	
}
 ?>
          <?php 
//if(isset($_POST["btnRef"]) || isset($_POST["btnSave"]) || isset($_POST["btnEdit"]))
if(isset($refid))
{
	$eId=$refid;

//	echo "you are editting";
	$editSelect="Select * from `order` where `eid`='$eId' AND Status=1";
	//echo $editSelect;
	$result=mysqli_query($con, $editSelect);
	if(mysqli_num_rows($result)>=1)
	{
	while($editRow=mysqli_fetch_array($result))
	{
		$order=$editRow["oid"];
		 $ordr=$editRow["oid"]; 
		?>
        
        <div class="row">        

    <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-danger">
                <div class="box-header">
               <i class="fa fa-shopping-cart"></i>
                  <h3 class="box-title">Bulk Order Details</h3>
                </div><!-- /.box-header -->
                
          
 <div class="my-box">   
                 <?php 
   if(isset($_POST["delt"]))
{
	$did=$_POST["edit"];
	/***************select order split**************/
	$orderQry="select * from `order_split` where `Osid`='$did'";
	$resultQry=mysqli_query($con, $orderQry);
	$splitRow=mysqli_fetch_array($resultQry);
	
	$orderIdToDel=$splitRow["Orderid"];
	
	$delQty=$splitRow["Qty"];
	$delgrandTot=$splitRow["Gtotal"];
	
	/*****************select order to delete******************/
	
	$selectOrderToDel="select * from `order` where `oid`='$orderIdToDel'";
	$delOrderDel=mysqli_query($con, $selectOrderToDel);
	$OrderDelRow=mysqli_fetch_array($delOrderDel);
	 
	  $quantity1=$OrderDelRow["tqty"];;
	 $grandTot1=$OrderDelRow["gtotal"];
	 
	 /**************************calculation***************************/
	  $quantity2=$quantity1-$delQty;
	  $grandTot2=$grandTot1-$delgrandTot; 
	$deleteOrder="UPDATE `order` SET `tqty`='$quantity2',`gtotal`='$grandTot2' WHERE `oid`='$orderIdToDel'";
	//echo $deleteOrder;
	mysqli_query($con, $deleteOrder);
	
	$delete="DELETE FROM `order_split` WHERE `Osid`='$did'";
	//echo $delete;
	mysqli_query($con, $delete);  
	
	echo "<div class=\"alert alert-info alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-info\"></i> Alert!</h4>
                   Removed Successfully...
                  </div>";
}
?>
             
<?php
if(isset($_POST["btnSave"]))
{		
/***************from session*****************/
$orderId=$ordr;
/***************from session*****************/
$item=$_POST["ddlProduct"];

	$qty=$_POST["txtqty"];
	$prc=$_POST["txtprc"];
$remark=$_POST["txtareaRemark"];

if($item!='' && $qty!='' && $prc!='')
	{ 
		$query="select `Osid` from `order_split` where `Orderid`='$orderId' and `Ccode`='$item' and `Status`='1'";
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
			
			$joinQuery1="SELECT a.* FROM  `product` a WHERE a.pid =  '$item'";
			//echo $joinQuery1;
			$resultJoinQuery1=mysqli_query($con, $joinQuery1);
			$joinQryResultRow1=mysqli_fetch_array($resultJoinQuery1);
			$product1=$joinQryResultRow1["Product"];		
			/*************CALCULATIONS*************/
			$grandTotal=$prc*$qty;
			/***************************SELECT FROM ORDER****************************/
			$selectOrder="SELECT * FROM `order` WHERE `oid`='$orderId'";
			$resultOrder=mysqli_query($con, $selectOrder);
			$orderRow=mysqli_fetch_array($resultOrder);
	
			$ordQty1=$orderRow["tqty"];
			$ordGrandTot1=$orderRow["gtotal"];
	/***********************calculation************************/
			$ordQty2=$ordQty1+$qty;
			$ordGrandTot2=$ordGrandTot1+$grandTotal;
	
				$insertQuery="INSERT INTO `order_split` (`Osid`, `Orderid`, `Ccode`, `Citem`,  `Uprice`, `Qty`, `Gtotal`, `Remark`, `Status`) VALUES (NULL, '$orderId', '$item','$product1',  '$prc','$qty', '$grandTotal', '$remark', '1')";
	//echo $insertQuery;
		mysqli_query($con, $insertQuery);
		
		$updateOrder="update `order` set `tqty`='$ordQty2',	`gtotal`='$ordGrandTot2' where `oid`='$orderId'";
		mysqli_query($con, $updateOrder);
		//echo $updateOrder;
		$item=$qty=$remark=$prc=NULL;
		echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                   Item Added Successfully...
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
/***************from session*****************/
$edtOrderId=$ordr;
/***************from session*****************/

$hid=$_POST["hid"];

$edtCode=$_POST["ddlEdtProduct"];
//echo "Edit product id = ".$edtCode;
$edtQty=$_POST["txtEdtQty"];
$edtPrc=$_POST["txtEdtPrc"];
$edtRemark=$_POST["txtareaEdtRemark"];

$joinQuery2="SELECT a.* FROM  `product` a WHERE a.pid =  '$edtCode'";
$resultJoinQuery2=mysqli_query($con, $joinQuery2);
$joinQryResultRow2=mysqli_fetch_array($resultJoinQuery2);
$edtItem=$joinQryResultRow2["Product"];
			$edtGAmount=$edtPrc*$edtQty;
/******************displaying calculated values*********************/
	
	if($edtCode!='' && $edtQty!='' && $edtPrc!='')
	{
		$querySelect="SELECT `Osid` FROM  `order_split` WHERE `Orderid`='$edtOrderId' and `Ccode`='$edtCode' and `Status`='1' and `Osid`!='$hid'";
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
		
		/***************select values from corresponding order split**************/
	$orderSplitQry="select * from `order_split` where `Osid`='$hid'";
	//echo "editting ordersplit query = ".$orderSplitQry;
	$resultOrderSplit=mysqli_query($con, $orderSplitQry);
	$orderSplitRow=mysqli_fetch_array($resultOrderSplit);
	
	$orderIdToDel=$orderSplitRow["Orderid"];
	//echo "ORDER TO DELETE = ".$orderIdToDel;
	
	$edtQuantity=$orderSplitRow["Qty"];
	$edtgrandTotal=$orderSplitRow["Gtotal"];
	/*****************select values from corresponding order*******************/
		$selectFrmOrder="select * from `order` where `oid`='$orderIdToDel'";
		//echo"<br/> deleting order = ".$selectFrmOrder;
		$rsltOrder=mysqli_query($con, $selectFrmOrder);
		$rsltOrderRow=mysqli_fetch_array($rsltOrder);
		
		$CuQty=$rsltOrderRow["tqty"];
		$CuTotal=$rsltOrderRow["gtotal"];
	
		$newQty=($CuQty-$edtQuantity)+$edtQty;
		$NewTotal=($CuTotal-$edtgrandTotal)+$edtGAmount;
	
		/********************update order query******************/
		
		$updateOrderQry="update `order` set `tqty`='$newQty',`gtotal`='$NewTotal' where `oid`='$orderIdToDel'";
		mysqli_query($con, $updateOrderQry);
		//echo $updateOrderQry;
		
		/*****************update order_split******************/
		$updateQuery="UPDATE `order_split` SET `Ccode` =  '$edtCode',`Citem` =  '$edtItem',`Uprice` = '$edtPrc',`Qty` =  '$edtQty',`Gtotal` = '$edtGAmount',`Remark` =  '$edtRemark' WHERE `Osid` =$hid";
		mysqli_query($con, $updateQuery);
		//echo"<br/>". $updateQuery;
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
                      <th>Order_Id</th>
                      <th>Contact Number</th>
                      <th>Customer</th>	
                      <th>Date</th>
                      <th>#Grand Total</th>
                      </tr>
                    <?php
					$selectLead="SELECT a.*, b.* FROM  `order` a, `customer` b WHERE a.customerid= b.customerid AND a.status=1  AND a.`eid`='$refid'";
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
	else
	{
	$selectEnquiry="Select * from `enquiry` where `eid`='$eId'";
	$resultEnquiry=mysqli_query($con, $selectEnquiry);
	$rowEnquiry=mysqli_fetch_array($resultEnquiry);
	$custumer=$rowEnquiry["customerid"];
	date_default_timezone_set('Asia/Kolkata');
	$CurrentDate=date('Y-m-d');
	$CurrentTime=date("h:i:s A");
	$insertOrder="INSERT INTO `order` (`oid`,`date`,`oTime`,`customerid`,`eid`,`tme`,`status`,`oFlag`,`oallotment`,`invtype`) VALUES(NULL,'$CurrentDate','$CurrentTime','$custumer','$refid','$user','1','1','0','2')";
	mysqli_query($con, $insertOrder);
	
	$selectOrdr="SELECT a.*, b.* FROM  `order` a, `customer` b WHERE a.customerid= b.customerid AND a.status=1  AND a.`eid`='$refid'";
	$resultOrdr=mysqli_query($con, $selectOrdr);
	while($rowOrdr=mysqli_fetch_array($resultOrdr))
	{
		$Ordrid=$rowOrdr["oid"];
		$insertOrdr="INSERT INTO `order_status_update` 
		(`OSUid`, `Oid`,`OSid`,`uid`,`OSUdate`,`OSUtime`,`OSUstatus`,`OSUflag`,`OSUremark`)
		VALUES (NULL, '$Ordrid', '1', '$user', '$CurrentDate', '$CurrentTime', '1', '1','')";
		mysqli_query($con, $insertOrdr);
	}
	
	 $updateEFlag="UPDATE `enquiry` SET `flag`='2' WHERE `eid`='$refid'";
	mysqli_query($con, $updateEFlag);
	
	
	 echo '<script>parent.window.location.reload(true);</script>';
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
                  <h3 class="box-title">Bulk Order Details</h3>
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
	$editSelect="SELECT * FROM `order_split` WHERE `Osid`='$editId'";
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
	  $editProductId=$editRow["Ccode"];
	  $productQuery="select a.pid, a.Product, a.oprice from `product` a,`product_category` b where a.status='1' and a.catid=b.catid and a.`pid`='$editProductId' order by a.Product ASC";
	 // echo $productQuery;
	  $resultProduct=mysqli_query($con, $productQuery);
	  while($resultProductRow=mysqli_fetch_array($resultProduct))
	  {
	  ?>
      <option value="<?php echo $resultProductRow["pid"];?>"><?php echo $resultProductRow["Product"]." (Rs. ".$resultProductRow["oprice"].")";?></option>    
      <?php
	  }
	  ?>
        <!--other product into dropdown list-->
      <?php 
	    $pdtSelectQuery="select a.pid, a.Product, a.oprice from `product` a,`product_category` b where a.`pid`!='$editProductId' and a.status='1' and a.catid=b.catid order by a.Product ASC";
	  $resultPdtQuery=mysqli_query($con, $pdtSelectQuery);
	  while($pdtRow=mysqli_fetch_array($resultPdtQuery))
	  {
	 ?>
     <option value="<?php echo $pdtRow["pid"];?>"><?php echo $pdtRow["Product"]." (Rs. ".$pdtRow["oprice"].")";?> </option>
     <?php
	  }
	  ?>
      </select>
                    </div> 
                 
               <div class="form-group">
               <label for="qty">Bulk Order Quantity<span style="color:#FF0000">*</span></label>
               <input id="qty" placeholder="Quantity" class="form-control" name="txtEdtQty" type="text" value="<?php echo @$editRow["Qty"]?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" />
               </div>   
                <div class="form-group">
               <label for="prc">Bulk Order Price<span style="color:#FF0000">*</span></label>
               <input id="prc" placeholder="Price" class="form-control" name="txtEdtPrc" type="text" value="<?php echo @$editRow["Uprice"]?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" />
               </div> 
               
               <div class="form-group">
               <label for="remark">Remark</label>
               <textarea id="remark" class="form-control" placeholder="Remark" name="txtareaEdtRemark"><?php echo $editRow["Remark"]?></textarea>
               </div>   
               </div><!-- /.box-body -->

                  <div class="box-footer">
                  <input type="hidden" name="hid" value="<?php echo $editRow["Osid"]; ?>" />
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
	$selectProduct="select a.pid, a.Product, a.oprice from `product` a,`product_category` b where a.`pid`='$editId' and  a.status='1' and a.catid=b.catid order by a.Product ASC";
	$resultQuery=mysqli_query($con, $selectProduct);
	while($resultRow=mysqli_fetch_array($resultQuery))
	{
	?>
    <option selected="selected" value="<?php echo $resultRow["pid"];?>"><?php echo $resultRow["Product"]." (Rs. ".$resultRow["oprice"].")";?></option>
    <?php
	}
	?>
    <!-------------------------other products into drop down list-------------------------->
    <?php 
	$selectOtherProducts="select a.pid, a.Product, a.oprice from `product` a,`product_category` b where a.`pid`!='$editId' and  a.status='1' and a.catid=b.catid order by a.Product ASC";
	$resultProducts=mysqli_query($con, $selectOtherProducts);
	while($row=mysqli_fetch_array($resultProducts))
	{
	?>
    <option value="<?php echo $row["pid"];?>"><?php echo $row["Product"]." (Rs. ".$row["oprice"].")";?></option>
    <?php
	}
	 ?>
    </select>
     
     </div> 
     
     <div class="form-group">
               <label for="qty2">Bulk Order Quantity<span style="color:#FF0000">*</span></label>
              <input id="qty2" placeholder="Quantity" class="form-control" name="txtqty" type="text" value="<?php echo @$qty?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" />
               </div>    

               <div class="form-group">
               <label for="prc2">Bulk Order Price<span style="color:#FF0000">*</span></label>
              <input id="prc2" placeholder="Price" class="form-control" name="txtprc" type="text" value="<?php echo @$prc?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" />
               </div>  
                
               
               <div class="form-group">
               <label for="remark">Remark</label>
               <textarea id="remark" placeholder="Remark" class="form-control" name="txtareaRemark" cols="45" rows="3"><?php echo @$remark;?></textarea>
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

<div class="box-footer">
 <form method="post" action="invoice.php">
 <input type="hidden" name="refid" value="<?php echo $refid;?>" /> 
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
	$page->query="select a.*, b.* from `order_split` a, `order` b where a.Orderid=b.oid and a.Status='1' and a.Orderid='$ordr' order by a.Osid ASC";
   ?>
              <div class="box box-success">
                <div class="box-header">
               
                  <i class="fa fa-tags"></i>
                  <h3 class="box-title">Ordered Items</h3>
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
$select="select a.*, b.* from `order_split` a, `order` b where a.Orderid=b.oid and a.Status='1' and a.Orderid=$ordr order by a.Osid ASC LIMIT $pstart,$perpage";
//echo $select;
  $result=mysqli_query($con, $select);
while($row=mysqli_fetch_array($result))
  {
  ?>
                    <li>
                      <span class="handle">
                      <i class="fa fa-tag"></i></span>
                      <span class="text"><?php echo $row["Citem"]." (".$row["Qty"].")"?><span class="handle"><small class="label label-default"><i class="fa fa-inr"></i> <?php echo $row["Gtotal"];?></small></span></span>
                     
                      
                      
                      <div class="tools">
          <form  action="" method="post">
          <input type="hidden" name="refid" value="<?php echo $row["eid"];?>" /> 
         <input name="edit" type="hidden" value="<?php echo $row["Osid"];?>"/>
          
          <button type="submit" name="edt" style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-edit"></i></button>
         <button type="submit" name="delt" onClick="return confirm('Are you sure you want to delete this?');" style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-trash-o"></i></button>
          <!--<button type="submit" name="view" style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-eye"></i></button>-->
         
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