<?php include("../config/conn.php"); ?>
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
<html xmlns="http://www.w3.org/1999/xhtml">

  
   <?php  head_part_home(); ?>
   
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <SCRIPT language="javascript">
$(function(){
 
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
});
</SCRIPT>

<SCRIPT language="javascript">
$(function(){
 
    // add multiple select / deselect functionality
    $("#selectallb").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectallb").attr("checked", "checked");
        } else {
            $("#selectallb").removeAttr("checked");
        }
 
    });
});
</SCRIPT>

 
  <body class="skin-black">
    <div class="wrapper">

     	<?php top($con); ?>
		<?php frm_nav($con); ?>
  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            State Co-ordinator
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <!--<li><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
            <li class="active"><i class="fa fa-edit"></i> Bulk Order Status Update</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-edit"></i> &nbsp; Bulk Order Status Update</h3>
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
                  <div class="col-xs-12">
                   <div class="form-group">
                     <div class="input-group input-group-sm">
                    
               
                    <input name="txtToDate" type="text" class="form-control"  value="<?php echo @$tdate?>"  id="searchTo"   placeholder="OrderIDs Separated by commas Eg: 1,2,3 (Maximum 20 Orders at a time)" autofocus onFocus="this.select();"/>
                   
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
if(isset($_POST['deliver']))
{
	$agent=$_POST["agent"];
	$amt = $_POST['total']; // Get the total rows
$d=0;
        for($i=1; $i<=$amt; $i++) {
      if(isset($_POST["ordr$i"]))
    {
      $Ordrid=$_POST["ordr$i"];
      
              $selectItem="select a.Orderid, a.Ccode, a.Qty, b.aprice, b.bprice, b.cprice, b.oprice, b.aperc, b.bperc, b.cperc, o.oallotment, u.Class FROM `order_split` a, `product` b, `customer` c, `order` o, `user` u where  u.Uid='$agent' and a.`Orderid`='$Ordrid' and b.pid=a.Ccode and o.oid=a.Orderid and o.customerid=c.customerid";
  
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
    
    
    $updateEntry="INSERT INTO `inventry` (`En_id`, `En_ref`, `En_type`, `En_wh`,  `En_pro`, `En_rcvbl`, `En_date`, `En_TDate`, `En_time`, `En_qty`, `En_stat`, `En_flag`) VALUES (NULL, '$refNo', '4', '$agent', '$item','$advance', '$CurrentDate', '$CurrentDate', '$CurrentTime', '$qty', '1', '1')";
    mysqli_query($con, $updateEntry);
    
    $selectInvo="select count(inv_id) as invc from `inventory` where `inv_wh`='$agent' and `inv_pro`='$item' and `inv_stat`='1'";
    $resultInvo=mysqli_query($con,$selectInvo);
    while($rowInvo=mysqli_fetch_array($resultInvo))
    {
      $invc=$rowInvo["invc"];
    }
    if($invc>=1)
    {   
    $updateInv="UPDATE `inventory` set inv_cS=inv_cS-$qty, `inv_cDT`='$cDTime', `luRid`='$refNo' where `inv_wh`='$agent' and `inv_pro`='$item' and `inv_stat`='1'";
    }
    else
    {
      $updateInv="INSERT INTO `inventory` (`inv_id`, `inv_wh`, `inv_pro`, `inv_oS`,  `inv_oDT`, `inv_cS`, `inv_cDT`, `inv_stat`, `inv_flag`, `luRid`) VALUES (NULL, '$agent', '$item','$qty',  '$cDTime','$qty', '$cDTime', '1', '1', '$refNo')";
    }

    mysqli_query($con, $updateInv);
    $updateAmt="UPDATE `user` set balance=balance+$advance, `ludate`='$CurrentDate', `lutime`='$CurrentTime', `luRid`='$refNo' where `Uid`='$agent'";
    mysqli_query($con, $updateAmt);
    
  }

  $updateStatus="Update `order` SET  `oallotment`='$agent', `oFlag`='11' WHERE `oid`='$Ordrid'";
  mysqli_query($con, $updateStatus);
  $insertOrdr="INSERT INTO `order_status_update` 
    (`OSUid`, `Oid`,`OSid`,`uid`,`OSUdate`,`OSUtime`,`OSUstatus`,`OSUflag`,`OSUremark`)
    VALUES (NULL, '$Ordrid', '11', '$user', '$CurrentDate', '$CurrentTime', '1', '1','')";
    mysqli_query($con, $insertOrdr);
  $d++;
            
    }
        }
  
    $msg="<h5>" .$d. " Order Delivery Entered Successfully "."</h5>";
   
  echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>  <i class=\"icon fa fa-check\"></i> Alert!</h4>
                    $msg
                  </div>";
 

}
?>

<?php
if(isset($_POST['cancel']))
{
  $agent=$_POST["agent"];
  $amt = $_POST['total']; // Get the total rows
  $d=0;
        for($i=1; $i<=$amt; $i++) {
      if(isset($_POST["ordr$i"]))
    {
      $Ordrid=$_POST["ordr$i"];
      
              $updateStatus="Update `order` SET  `oallotment`='$agent',`oFlag`='12' WHERE `oid`='$Ordrid'";
  mysqli_query($con, $updateStatus);
  $insertOrdr="INSERT INTO `order_status_update` 
    (`OSUid`, `Oid`,`OSid`,`uid`,`OSUdate`,`OSUtime`,`OSUstatus`,`OSUflag`,`OSUremark`)
    VALUES (NULL, '$Ordrid', '12', '$user', '$CurrentDate', '$CurrentTime', '1', '1','Direct Cancellation')";
    mysqli_query($con, $insertOrdr);
  $d++;
            
    }
        }
  
    $msg="<h5>" .$d. " Order Cancellation Entered Successfully "."</h5>";
   
  echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>  <i class=\"icon fa fa-check\"></i> Alert!</h4>
                    $msg
                  </div>";
}
?>

<?php
if(isset($_POST['pending']))
{
  $agent=$_POST["agent"];
  $amt = $_POST['total']; // Get the total rows
  $d=0;
        for($i=1; $i<=$amt; $i++) {
      if(isset($_POST["ordr$i"]))
    {
      $Ordrid=$_POST["ordr$i"];
      
              $updateStatus="Update `order` SET  `oallotment`='$agent',`oFlag`='8' WHERE `oid`='$Ordrid'";
  mysqli_query($con, $updateStatus);
  $insertOrdr="INSERT INTO `order_status_update` 
    (`OSUid`, `Oid`,`OSid`,`uid`,`OSUdate`,`OSUtime`,`OSUstatus`,`OSUflag`,`OSUremark`)
    VALUES (NULL, '$Ordrid', '8', '$user', '$CurrentDate', '$CurrentTime', '1', '1','Direct Allotment')";
    mysqli_query($con, $insertOrdr);
  $d++;
            
    }
        }
  
    $msg="<h5>" .$d. " Order Pending Entered Successfully "."</h5>";
   
  echo"<div class=\"alert alert-info alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>  <i class=\"icon fa fa-check\"></i> Alert!</h4>
                    $msg
                  </div>";
}
?>
  </div>       
   <form method="POST" action="">  
     
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      <th>#</th>
                      <th><input type="checkbox" id="selectall"/></th>
                      <th>Order</th>
                      	 <th> Name</th>
                        <th>Dist</th>
                        <th>Contact Number</th>
                        <th>Qty</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
if(isset($_POST["btnSearch"]))
{
  if($tdate!='')
{
					$n=1;
	  $i = 0;
	$selectEnq="SELECT a.*, b.*, c.Officename, c.Pincode, e.*, u.Name FROM  `order` a, `customer` b, `pin` c,  `district` e, `user` u  WHERE a.`oid` IN ($tdate) AND  u.Uid=a.tme AND a.customerid= b.customerid AND b.post=c.Pid AND b.districtid=e.Did AND  a.status=1 AND a.tqty!=0  AND a.oallotment=0 AND (a.oFlag='2' OR a.oFlag='8' OR a.oFlag='9') AND  (a.invtype=1 OR a.invtype=2)";
	$resultEnq=mysqli_query($con, $selectEnq);
	while($rowEnq=mysqli_fetch_array($resultEnq))
	{
		 $i = $i + 1;
	?>

					
                      <tr>
                        <td><?php echo $n; ?></td>
                        <td><input type="checkbox" class="case" name="ordr<?php echo $i; ?>" value="<?php echo $rowEnq["oid"]; ?>"/></td>
                        <td><?php echo $rowEnq["oid"]; ?></td>
                        <td><?php echo $rowEnq["name"]; ?></td>
                        <td><?php echo $rowEnq["District"]; ?></td>
                        <td><?php echo $rowEnq["contactNum1"]; ?></td>
                        <td><?php echo $rowEnq["tqty"]; ?></td>
                      </tr>
                     <?php
					 $n++;
					}
        }
      }
					?>
                    </tbody>
                    <tfoot>
                      <tr>
                      <th>#</th>
                      <th><input type="checkbox" id="selectallb"/></th>
                      <th>Order</th>
                         <th> Name</th>
                        <th>Dist</th>
                        <th>Contact Number</th>
                        <th>Qty</th>
                      </tr>
                    </tfoot>
                  </table>
                 
                  

<div class="form-group">
  
    <input type="hidden" name="total" value="<?php echo $i; ?>" /> <?php // Post the total rows count value ?>
<select name="agent"  class="form-control" required>
<option value="" >Select Agent</option>

<?php 
$selectTme="SELECT Uid, Name FROM  `user` WHERE  `Status`=1 AND `Categoryid`='8' ORDER BY Name ASC";
$resultTme=mysqli_query($con, $selectTme);
while($rowTme=mysqli_fetch_array($resultTme))
{
?>
<option value="<?php echo $rowTme["Uid"]; ?>"><?php echo $rowTme["Name"]; ?></option>
<?php
}
?>
</select>
</div>


    </div><!-- /.box-body -->
    
    <div class="box-footer">
                  <button type="submit" name="deliver"  class="btn btn-success" accesskey="l" title="Alt+l"><i class="fa fa-check-square"></i> Delivered</button>
                  <button type="submit" name="cancel" onClick="return confirm('Are you sure you want to cancel thes orders?');"  class="btn btn-danger" accesskey="c" title="Alt+c"><i class="fa fa-ban"></i> Canceled</button>
                   <button type="submit" name="pending"  class="btn btn-info" accesskey="E" title="Alt+E"><i class="fa fa-spinner"></i> Pending</button>
                  </div> 
              </div><!-- /.box -->
              
              
</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
</form>
    <?php footer($con); ?>

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    
  <?php jss(); ?>
  
   <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>
  </body>
</html>
<?php
}
?>