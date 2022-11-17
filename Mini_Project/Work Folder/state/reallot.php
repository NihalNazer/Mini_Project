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

<?php
if(isset($_POST["btnShow"]))
{	
 	$refid=$_POST["refid"];
}
else
{
	echo"<script type=\"text/javascript\">
 window.location.assign(\"rejected.php\")
</script>";	
}
 ?>
<!DOCTYPE html>
<html>
 
 <?php  head_part(); ?>
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
            State Co-ordinator
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
             <!-- <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
            <li class="active"><i class="fa fa-file-text"></i> Re Allotment</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content"  style="font-size:12px;">
          
    
<!----------------------------------------------------PAGE CONTENTS START HERE ------------------------------------------------->
<div class="row">             

 <?php
					$selectLead="SELECT a.*, b.*, c.*, e.*, u.Name, u.Uid FROM  `order` a, `customer` b, `pin` c, `district` e, `user` u WHERE a.customerid= b.customerid AND b.post=c.Pid AND b.districtid=e.Did and a.oallotment=u.Uid AND a.status=1 AND a.`eid`='$refid'";
					$resultLead=mysqli_query($con, $selectLead);
					while($rowLead=mysqli_fetch_array($resultLead))
					{
						$ordr=$rowLead["oid"];
					?>

 <?php
					$iallot=$rowLead["oallotment"];
					$iflag=$rowLead["oFlag"];
					$dist=$rowLead["Did"];
          $agent=$rowLead["Name"];
          $agentid=$rowLead["Uid"];
         $selectReason="select * from `order_status_update` where `Oid`='$ordr' and `OSid`='$iflag' and `uid`='$agentid'";
          $resultReason=mysqli_query($con, $selectReason);
          while($rowReason=mysqli_fetch_array($resultReason))
          {
            $reason=$rowReason["OSUremark"];
          }
					?>
                    
                    
<section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-shopping-cart"></i> Invoice | 
                TEST <i><small style="color: #f00;">Rejected by <?php echo $agent.' (Reason:'.($reason).")"; ?> </small></i> 
                
                <small class="pull-right">Date: <?php echo date("d/m/Y", strtotime($rowLead["date"])); ?></small>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              From
              <address>                 
              <strong>TEST</strong><br>
                PALAKKAD DISTRICT - KERALA<br/>
                GOVERNMENT INDUSTRY CENTRE<br>
               	INDIA 679551<br>
                <strong>Tel: +91 8086 80000</strong><br>
                E-mail: info@test.com<br>
                
              </address>
            </div><!-- /.col -->
            <div class="col-sm-6 invoice-col">
              To
              <address>
                <strong><?php echo $rowLead["name"]; ?></strong><br>
                <?php echo $rowLead["housename"].", ".$rowLead["place"]; ?><br>
               <?php if($rowLead["landmark"]!=''){?><?php echo $rowLead["landmark"]; ?><br><?php } ?>
               
               <?php echo $rowLead["Officename"]." - ".$rowLead["Pincode"]; ?><br>
               <?php echo $rowLead["District"]." Dist."?>       
               <br>
                <b>Phone: <?php echo $rowLead["contactNum1"]; ?> <?php if($rowLead["contactNum2"]!='0'){?>,  <?php echo $rowLead["contactNum2"]; ?><?php } ?></b><br>
                <?php if($rowLead["Email"]!=''){?>Email:  <?php echo $rowLead["Email"]; ?><br><?php } ?>
                <?php if($rowLead["Remark"]!=''){?>Remarks:  <?php echo $rowLead["Remark"]; ?><br><?php } ?>
              </address>
            </div><!-- /.col -->
            <div class="col-sm-2 invoice-col">
              <!--<b>Invoice No. #<?php if($rowLead["ref"]!=''){ echo $rowLead["ref"];} ?></b><br>-->
              
              <b>Invoice No: <?php if($rowLead["oid"]!=''){ echo $rowLead["oid"]."/".date("Y", strtotime($rowLead["date"]));} ?></b><br>
              <br>
              <b>Order Time:</b> <?php echo $rowLead["oTime"]; ?><br>
             	<?php if($rowLead["tme"]!='0'){?><b>BPE CODE:</b> <?php echo "BPE00".$rowLead["tme"]; ?><br><?php } ?>
              <?php if($rowLead["Barcode"]!=''){?><b>Barcode:</b> <?php echo $rowLead["Barcode"]; ?><br><?php } ?>
              <?php if(($rowLead["PDDate"]!='') && ($rowLead["PDDate"]!='1970-01-01')){?><br>Prefered Delivery on <br><b><?php echo $rowLead["PDDate"]." ".$rowLead["PDTime"]; ?></b><br><?php } ?>
              
              
            </div><!-- /.col -->
          </div><!-- /.row -->

<!--invoice with tax and discount start here-->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead> 
                  <tr>
                    <th>Sl. No</th>
                    
                    <th>Item Description</th>
                    <th>Unit Price</th>
                    <th>Qty</th>
                    <th>Grand Total</th>
                  </tr>
                </thead>
                <tbody>
                 
                  
                  
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
                    <td><?php echo $row["Uprice"];?></td>
                    <td><?php echo $row["Qty"]." no";?></td>
                    <td><?php echo $row["Gtotal"];?></td>
                  </tr>
                  <?php
				  $n++;
  }
  ?>
  
 
  
   <tr>
   					
                    <td colspan="3" align="center"><b>TOTAL</b></td>
                    <td><b><?php echo $rowLead["tqty"]." no"; ?></b></td>
                    <td><b><?php echo $pay=$rowLead["gtotal"]; ?></b></td>
                  
                  </tr>
  </tbody>
              </table>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-12">
              
              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-transform:capitalize;">
              <b>TOTAL AMOUNT PAYABLE</b><br/>
              <i class="fa fa-inr"></i> <b><?php echo $rowLead["gtotal"]; ?></b>
              <?php 
require_once("../login/functions.php");
echo "(".no_to_words($pay)." Rupees Only)";

?>
                
              </p>
            </div><!-- /.col -->
            
            
<!--invoice with tax and discount end here-->            
    
            
             <div class="row">
            <div class="col-xs-12">
              
                
                 
                <center><small>
                If you have any questions, feel free mail to <b>info@hanbaz.com </b> 
                </small></center>
             
            </div><!-- /.col -->
          </div>


            <?php
					}
					?>
            
          </div><!-- /.row -->

           <div class="row no-print">
          
         <hr/>
                   
            <div class="col-xs-12">
            
            <div class="col-xs-9">
           <form method="post" action="rejected.php">
             <div class="form-group">
             
              
              <select style="width:100%;" id="states" name="area" required>
           
               <option value="">Select Agent </option>
               
               <?php
        $selectothr="select user.Name, user.Uid from user where Categoryid='8' and Dist='$dist' order by user.Name ASC";
         $resultothr=mysqli_query($con,$selectothr);
         while($rowothr=mysqli_fetch_array($resultothr))
         {
           ?>
                   
                    <option value="<?php echo $rowothr["Uid"];?>"> <?php echo $rowothr["Name"];?></option>
                   
                   <?php
         }
         
         ?>
               
               
              </select>
              </div>
              </div>
              
              
             <div class="col-xs-3">
             <input type="hidden" value="<?php echo $ordr; ?>" name="ordr">
                  <button type="submit" name="allot"  class="btn btn-success btn-sm"><i class="fa fa-check-circle"></i> Allot to Agent</button>
                                           
             <button type="submit" name="withheld" onClick="return confirm('Are you sure you want to withheld this?');"  class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Withheld</button>
                  
                  
                   </form>
            </div>
            <!--<div class="btn-group">
            <form action="invoice-print.php" method="post" target="_blank">
            <input type="hidden" name="refid" value="<?php echo $refid;  ?>" /> 
                   <button type="submit" name="btnPrint"  class="btn btn-default btn-sm"><i class="fa fa-print"></i>  Print </button>-->
 
 </div>
 
            
            <!--  <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
              <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
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

  </body>
</html>
<?php
}
?>