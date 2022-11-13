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
<html xmlns="http://www.w3.org/1999/xhtml">

  
   <?php  head_part(); ?>
    <style>
  table.order-slip{margin:37px auto; text-transform:uppercase; width:800px; background:url(img/watermark.png) repeat; height:300px; font-size:15px;}
   table.order-slip tr{}
   table.order-slip tr td{ padding:7px 10px;}
   table.order-slip tr td.acc{padding:0; border-collapse:collapse;}
   table.order-slip tr.firstrow{height:25px;}
   table.order-slip tr.contentsrow{vertical-align:text-top;}
   table.order-slip tr td.acc table{border:none;}
   table.order-slip tr td.acc table,  table.order-slip tr td table tr,  table.order-slip tr td table tr td{border-collapse:collapse;}
   
   .page{size:8.5in 11in; margin: 2cm; page-break-after:always;}
   @page { size:8.5in 11in; margin: 2cm;  page-break-after:always;}
  </style>
   
   
  <body class="skin-black">
    <div class="wrapper">

     	<?php top($con); ?>
		<?php bdm_nav($con); ?>
  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Agent
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <!--<li><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
            <li class="active"><i class="fa fa-thumb-tack"></i> Status Management </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
         <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Order Staus Management</h3>
                </div><!-- /.box-header -->
               <?php
			   	if(isset($_POST['txtToDate']))
			   {
			   $tdate=$_POST['txtToDate'];
			   }
			   
			   ?> 
            
            <div class="box-body">
                <form method="POST" action="">
                 <div class="col-xs-12">
                  <div class="col-xs-3">
                	 <div class="form-group">
                     <div class="input-group input-group-sm">
                    
              
                    <input name="txtToDate" type="text" class="form-control"  value="<?php echo @$tdate?>"  id="searchTo"   placeholder="OrderID" autofocus onFocus="this.select();"/>
                   
                    <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" name="btnSearch" type="subit" >Search</button>
                    </span>
                  
                  </div>
                  </div>
                  </div>		
       		  </form>
                        
 						
        </div>
        <hr/>
        
         <div class="my-box"> 
                         <?php 
   if(isset($_POST["deliver"]))
{
	
	$Ordrid=$_POST["ordr"];
	
	$selectItem="select a.Orderid, a.Ccode, a.Qty, b.aprice, b.bprice, b.cprice, b.oprice, b.aperc, b.bperc, b.cperc, o.oallotment, u.Class FROM `order_split` a, `product` b, `customer` c, `order` o, `district` d, `user` u where u.Uid=o.oallotment and a.`Orderid`='$Ordrid' and b.pid=a.Ccode and o.oid=a.Orderid and o.customerid=c.customerid and c.districtid=d.Did";
	
	$resultItem=mysqli_query($con, $selectItem);
	while($rowItem=mysqli_fetch_array($resultItem))
	{
		$Order=$rowItem["Orderid"];
		$item=$rowItem["Ccode"];
		$qty=$rowItem["Qty"];
		$price=$rowItem["oprice"];
    $agclass=$rowItem["Class"];
    if($agclass==1)
    {
		$dprice=$rowItem["aprice"];
		$percent=$rowItem["aperc"];
    }
    else if($agclass==2)
    {
    $dprice=$rowItem["bprice"];
    $percent=$rowItem["bperc"];
    }
    else if($agclass==3)
    {
    $dprice=$rowItem["cprice"];
    $percent=$rowItem["cperc"];
    }
    else
    {
    $dprice=$rowItem["aprice"];
    $percent=$rowItem["aperc"];
    }

		//$adv=round(($percent/100)*$price);
		//$advance=($dprice-$adv)*$qty;		
		$advance=$dprice*(((100-$percent)/100)*$qty);
		
		$refNo='D-'.$Order;
		$cDTime=$CurrentDate.' '.$CurrentTime;
		$refid=$rowItem["oallotment"];
		
		$updateEntry="INSERT INTO `inventry` (`En_id`, `En_ref`, `En_type`, `En_wh`,  `En_pro`, `En_rcvbl`, `En_date`, `En_TDate`, `En_time`, `En_qty`, `En_stat`, `En_flag`) VALUES (NULL, '$refNo', '4', '$refid', '$item','$advance', '$CurrentDate', '$CurrentDate', '$CurrentTime', '$qty', '1', '1')";
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
		$updateAmt="UPDATE `user` set balance=balance+$advance, `ludate`='$CurrentDate', `lutime`='$CurrentTime', `luRid`='$refNo' where `Uid`='$refid'";
		mysqli_query($con, $updateAmt);
		
	}

	$updateStatus="Update `order` SET  `oFlag`='11' WHERE `oid`='$Ordrid'";
	mysqli_query($con, $updateStatus);
	$insertOrdr="INSERT INTO `order_status_update` 
		(`OSUid`, `Oid`,`OSid`,`uid`,`OSUdate`,`OSUtime`,`OSUstatus`,`OSUflag`,`OSUremark`)
		VALUES (NULL, '$Ordrid', '11', '$user', '$CurrentDate', '$CurrentTime', '1', '1','')";
		mysqli_query($con, $insertOrdr);

echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                   Delivery Entered Successfully...
                  </div>";

}
?>

		</div>
        
                
                <?php
if(isset($_POST["btnSearch"]))
{
	if($tdate!='')
{

					$n=1;
	  $i = 0;
$selectLead="SELECT a.*, b.*, c.Officename, c.Pincode, e.*, u.Name FROM  `order` a, `customer` b, `pin` c,  `district` e, `user` u  WHERE a.`oid`='$tdate' AND a.oallotment='$user' AND u.Uid=a.tme AND a.customerid= b.customerid AND b.post=c.Pid AND b.districtid=e.Did AND  a.status=1 AND a.tqty!=0 AND (a.oFlag='8' OR a.oFlag='9') AND  a.invtype=1";
					$resultLead=mysqli_query($con, $selectLead);
					$countLead=mysqli_num_rows($resultLead);
	?>
         <?php
			while($rowLead=mysqli_fetch_array($resultLead))
					{
						$ordr=$rowLead["oid"];
						$refid=$rowLead["eid"];
		?>
        
        <table border="1" align="center" class="order-slip">
    	<tr class="firstrow">
        	<td width="50%">Invoice No: <b><?php echo $rowLead["oid"]."/".date("Y", strtotime($rowLead["date"])); ?> </b></td>
            <td align="right"><b><?php echo $rowLead["Name"]; ?><?php echo " (".date("d/m/Y", strtotime($rowLead["date"]))." ".$rowLead["oTime"].")"; ?></b></td>
        </tr>
        <tr class="contentsrow">
        	<td>
             <address>
             
               <strong> 
                <?php echo $rowLead["District"]." District"?>   
               </strong>                      
               <br/> <br/>
             
                <strong><?php echo $rowLead["name"]; ?></strong><br>
                <?php echo $rowLead["housename"].", ".$rowLead["place"]; ?><br>
               <?php if($rowLead["landmark"]!=''){?><?php echo $rowLead["landmark"]; ?><br><?php } ?>
               
               <?php echo $rowLead["Officename"]." (POST) ".$rowLead["Pincode"]; ?><br>               
                <b>Phone: <?php echo $rowLead["contactNum1"]; ?> <?php if($rowLead["contactNum2"]!='0'){?>,  <?php echo $rowLead["contactNum2"]; ?><?php } ?></b><br>
                <?php if($rowLead["Email"]!=''){?>Email:  <?php echo $rowLead["Email"]; ?><br><?php } ?>
                <?php if($rowLead["Remark"]!=''){?>Remarks:  <?php echo $rowLead["Remark"]; ?><br><?php } ?>
                
                <?php if(($rowLead["PDDate"]!=  '' && $rowLead["PDDate"]!=  '1970-01-01' )){?>Prefered Delivery on  <b><?php echo $rowLead["PDDate"]." ".$rowLead["PDTime"]; ?></b><?php } ?>
              </address>
            </td>
        	<td class="acc">
            <table width="100%" border="1">
  <tr>
    <td><b>#</b></td>
    <td><b>Product</b></td>
    <td><b>Qty</b></td>
    <td><b>Amount</b></td>
  </tr>
  
   <?php
				  $n=1;
$select="select a.* from `order_split` a, `order` b where a.Orderid=b.oid and a.Status='1' and a.Orderid=$ordr order by a.Osid ASC";
//echo $select;
  $result=mysqli_query($con, $select);
while($row=mysqli_fetch_array($result))
  {
  ?>
  <tr>
    <td><?php echo $n; ?></td>
    <td><?php echo $row["Citem"]; if($row["Remark"]!=''){echo "(".$row["Remark"].")";}?></td>
    <td><?php echo $row["Qty"];?></td>
    <td><?php echo $row["Gtotal"];?></td>
  </tr>
  <?php
  $n++;
  }
  ?>
  

<tr>
    <td colspan="2"><b><center>Total</center></b></td>
    <td><b><?php echo $rowLead["tqty"]; ?></td>
    <td><b><?php echo $pay=$rowLead["gtotal"]; ?></b></td>
  </tr>
</table>

            </td>
        </tr>    
    </table>

            </td>
        </tr>   
        
        <tr>
        <td>&nbsp;<br></td>
        <td>
        <div class="btn-group">
                            <form method="post" action="">
                   
                   <input type="hidden" value="<?php echo $ordr; ?>" name="ordr">
                  <button type="submit" name="deliver"  class="btn btn-success" accesskey="l" title="Alt+l"><i class="fa fa-check-square"></i> Delivered</button>
                   </form>
                   </div>
                   
             <div class="btn-group">
                            <form method="post" action="cancel.php">
                   
                   <input type="hidden" value="<?php echo $ordr; ?>" name="refid">
                    <button type="submit" name="btnRef" onClick="return confirm('Are you sure you want to cancel this order?');"  class="btn btn-danger" accesskey="c" title="Alt+c"><i class="fa fa-ban"></i> Canceled</button>
                   </form>
                   </div>
            
          <!--  <div class="btn-group">
            <form action="invoice-print.php" method="post" target="_blank">
            <input type="hidden" name="refid" value="<?php echo $refid;  ?>" /> 
                   <button type="submit" name="btnPrint"  class="btn btn-default" accesskey="i" title="Alt+i"><i class="fa fa-print"></i>  Print Invoice</button>
 </form>
 </div>-->
        </td>
        </tr> 
    </table>
    
    <?php
					}
          if($countLead<=0){echo "Please Check your Order ID";}
					?>
         
    
    <?php
					}
}
	?>


    
     </div><!-- /.box-body -->
 </div><!-- /.box -->
              
              
</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

    <?php footer($con); ?>

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    
  <?php jss(); ?>
  
  
  </body>
</html>
<?php
}
?>