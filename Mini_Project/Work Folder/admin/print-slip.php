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
<style>
  table.order-slip{margin:7px auto; text-transform:uppercase; width:800px; background:url(img/watermark.png) repeat; height:360px; font-size:15px;}
   table.order-slip tr{}
   table.order-slip tr td{ padding:7px 10px;}
   table.order-slip tr td.acc{padding:0; border-collapse:collapse;}
   table.order-slip tr.firstrow{height:25px;}
   table.order-slip tr.contentsrow{vertical-align:text-top;}
   table.order-slip tr td.acc table{border:none;}
   table.order-slip tr td.acc table,  table.order-slip tr td table tr,  table.order-slip tr td table tr td{border-collapse:collapse;}
   
   .page{size:8.5in 11in; margin: 2cm; page-break-after:always;}
 
   
   @media print
   {
	    table.order-slip{margin:19px auto; text-transform:uppercase; width:700px; background:url(img/watermark.png) repeat; height:313px; font-size:15px; position:relative;}
   table.order-slip tr{}
   table.order-slip tr td{ padding:7px 10px;}
   table.order-slip tr td.acc{padding:0; border-collapse:collapse;}
   table.order-slip tr.firstrow{height:25px;}
   table.order-slip tr.contentsrow{vertical-align:text-top;}
   table.order-slip tr td.acc table{border:none; font-size:13px;}
   table.order-slip tr td.acc table,  table.order-slip tr td table tr,  table.order-slip tr td table tr td{border-collapse:collapse;}
   
   .page{size:8.5in 11in; page-break-after:always; margin:0;}
   }
  </style>
<body onload="window.print();">

<?php 
if(isset($_POST["download"]))
{
$fdate=$_POST["fdate"];
$tdate=$_POST["tdate"];	
$tme=$_POST["tme"];
?>
<?php
					$n=1;
	  $i = 0;
		
	if($tme!='')
	{
	$stme=" e.`Did`='$tme' AND ";
	}
	else
	{
	$stme=" ";
	}
	
 $selectLead="SELECT a.*, b.*, c.Officename, c.Pincode, e.*, u.Name FROM  `order` a, `customer` b, `pin` c,  `district` e, `user` u  WHERE  (a.oid>='$fdate' AND a.oid<='$tdate') AND  ".$stme." u.Uid=a.tme AND a.customerid= b.customerid AND b.post=c.Pid AND b.districtid=e.Did AND  a.status=1 AND a.tqty!=0 AND a.oFlag='2' AND  a.invtype=1";
					$resultLead=mysqli_query($con, $selectLead);
					
					$countLead=mysqli_num_rows($resultLead);
					
					if($countLead!=0)
					{
						$pageCount=ceil($countLead/3);
						
						//echo "<b>"." Number of Orders: ".$countLead."<br/>"." Number of Sheets: ".$pageCount."</b>"."<hr/>";					
	?>
    
    <?php
	for ($x = 0; $x <= $pageCount; $x++) 
	{
		?>
        
        <div class="page">
        <?php
		$y=$x*3;
		//echo $selectLead." LIMIT $y, 3";
		$res=mysqli_query($con, $selectLead." LIMIT $y, 3");
		while($rowLead=mysqli_fetch_array($res))
					{
						$i = $i + 1;
						$ordr=$rowLead["oid"];
		
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
$select="select a.*, b.* from `order_split` a, `order` b where a.Orderid=b.oid and a.Status='1' and a.Orderid=$ordr order by a.Osid ASC";
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
     
    <?php
	}
	?>
        
        </div>
        
        <?php
	} 

	?>
    
    
    <?php
					}
					else
					{
					echo "<b>"." No confirmed orders found for your search "."</b>"."<hr/>";	
					}
	?>


<?php
}
?>

<?php
}
?>
</body>


