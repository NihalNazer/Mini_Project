<?php include("../config/conn.php"); ?>
<?php
//validation for admin page;
if(!isset($_SESSION['homsuser']) || !isset($_SESSION['homsutype']) ||($_SESSION['homsutype']!=4))
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
  
  <body class="skin-black">
    <div class="wrapper">

     	<?php top($con); ?>
		<?php system_nav($con); ?>
  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            System Admin
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <!--<li><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Your Page Content Here -->
  <!-- =========================================================== -->

          <div class="row">
          
          <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-green">
             
                <span class="info-box-icon"><i class="fa fa-phone"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Data Alloted</span>
                 
                  
                  <span class="info-box-number">
                   <?php
				   $selectEnq="SELECT count(a.eid) as Ecount FROM  `enquiry` a, `number_config` b, `user` c WHERE a.lnode= b.ncid AND a.`userid`!=0  AND a.userid=c.Uid  AND a.status=1 AND a.`adate`='$CurrentDate'";
	$resultEnq=mysqli_query($con, $selectEnq);
	while($rowEnq=mysqli_fetch_array($resultEnq))
	{
		echo $rowEnq["Ecount"];
	}
				?>
                  </span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                  </div>
                  <span class="progress-description"  style="cursor:pointer;" onClick="location.href='data-alloted.php'" >
                   Click here to go &raquo;
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-aqua">
             
                <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Orders</span>
                  <span class="info-box-number">
                   <?php
				 $selectOrdr="select count(a.oid) as Ocount from `order` a, `customer` b, `district` c,  `pin` e,  `order_status` g, `user` u where a.customerid=b.customerid and  b.districtid=c.Did and b.post=e.Pid and u.Uid=a.tme and g.OsId=a.oFlag and a.`status`='1' and a.tqty!=0 AND a.date='$CurrentDate' ";
	$resultOrdr=mysqli_query($con, $selectOrdr);
while($rowOrdr=mysqli_fetch_array($resultOrdr))
{
	echo $rowOrdr["Ocount"];
}?>
                  </span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                  </div>
                  <span class="progress-description" style="cursor:pointer;" onClick="location.href='order_search.php'" >
                    Click here to go &raquo;
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <div class="col-md-3 col-sm-6 col-xs-12">
             
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-smile-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Customers</span>
                  <span class="info-box-number">
                  <?php
				 $selectCst="select  count(b.customerid) as  Ccount from  `customer` b, `district` c,  `pin` e where  b.districtid=c.Did and b.post=e.Pid and  b.`status`='1' AND b.CuDate='$CurrentDate' ";
	$resultCst=mysqli_query($con, $selectCst);
	while($rowCst=mysqli_fetch_array($resultCst))
	{
 echo $rowCst["Ccount"];
}
				?>
                  </span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                  </div>
                  <span class="progress-description"  style="cursor:pointer;" onClick="location.href='customer_search.php'" >
                     Click here to go &raquo;
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
              
                <span class="info-box-icon"><i class="fa fa-tags"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Products</span>
                  <span class="info-box-number">
                    <?php
	 $selectEnqT="SELECT SUM(b.Qty) AS Value FROM  `order` a, `order_split`  b WHERE a.oid= b.Orderid  AND b.Gtotal!=0  AND b.Status=1 AND a.date='$CurrentDate' ";
	 
	$resultEnqT=mysqli_query($con, $selectEnqT);
	while($rowEnqT=mysqli_fetch_array($resultEnqT))
	{
 echo $rowEnqT["Value"];
}
					?>
                     
                  </span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                  </div>
                  <span class="progress-description" style="cursor:pointer;" onClick="location.href='order-summary.php'" >
                    Click here to go &raquo;
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- =========================================================== -->
          <div class="row">
            <div class="col-xs-12">  
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Order for Confirmation</h3>
                  
                  <?php

    $showUserid=$_SESSION['homsuser'];
   	require_once("../class/ipagination.php");
   	$page=new ipagination();
   	$page->perpage=10;
	$page->show=3;
	$page->con=$con;
	
	if(isset($_GET["q"]))
	{
		$q=$_GET["q"];
		$qquery=" AND (a.oid='$q' OR b.contactNum1 like '%$q%' OR b.name like '%$q%') ";
	}
	else
	{
		$qquery='';
	}
	
	$page->query="select a.oid, a.date, b.name, b.contactNum1, a.tqty, a.gtotal, u.Name, g.OsName, a.eid, a.oTime, a.oFlag from `order` a, `customer` b, `district` c, `pin` e,  `order_status` g, `user` u where a.customerid=b.customerid and b.districtid=c.Did and b.post=e.Pid and  u.Uid=a.tme and g.OsId=a.oFlag and a.`status`='1' and a.`oFlag`='1' ".$qquery;
   ?>
   
    <?php
				   $page->pageinfo(); 
	?>
    <small class="label bg-green"><?php echo  $page->trows ; ?></small>
    
    <form method="get" action="">
  <div class="box-tools">
                    <div class="input-group">
                   
                    <input type="text" name="q" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" value="<?php echo @$_GET["q"]; ?>" autofocus/>
                      <div class="input-group-btn">
                        <button type="submit" name="search" value="yes" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                        
                    </div>
                  </div>
                  
                  </form>
                </div><!-- /.box-header -->
              
            
            <div class="box-body">
               
                        <div class="my-box"> 
                         <?php 
   if(isset($_POST["confirm"]))
{
	$Ordrid=$_POST["ordr"];
	$updateStatus="Update `order` SET `oFlag`='2' WHERE `oid`='$Ordrid'";
	mysqli_query($con, $updateStatus);
	
	$selectUpdate="SELECT `OSUid` FROM `order_status_update` WHERE `Oid`='$Ordrid' AND `OSid`='2' AND `uid`='$user' AND `OSUstatus`='1' AND `OSUflag`='1'";
	$resultUpdate=mysqli_query($con, $selectUpdate);
	if(mysqli_num_rows($resultUpdate)==0)
	{
	$insertOrdr="INSERT INTO `order_status_update` 
		(`OSUid`, `Oid`,`OSid`,`uid`,`OSUdate`,`OSUtime`,`OSUstatus`,`OSUflag`,`OSUremark`)
		VALUES (NULL, '$Ordrid', '2', '$user', '$CurrentDate', '$CurrentTime', '1', '1','')";
		mysqli_query($con, $insertOrdr);
		
	}
		
		echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                   Confirmed Successfully...
                  </div>";
}
?>


 <?php 
   if(isset($_POST["contradict"]))
{
	$Ordrid=$_POST["ordr"];
	$updateStatus="Update `order` SET `oFlag`='3' WHERE `oid`='$Ordrid'";
	mysqli_query($con, $updateStatus);	
	$selectUpdate="SELECT `OSUid` FROM `order_status_update` WHERE `Oid`='$Ordrid' AND `OSid`='3' AND `uid`='$user' AND `OSUstatus`='1' AND `OSUflag`='1'";
	$resultUpdate=mysqli_query($con, $selectUpdate);
	if(mysqli_num_rows($resultUpdate)==0)
	{
		$insertOrdr="INSERT INTO `order_status_update` 
		(`OSUid`, `Oid`,`OSid`,`uid`,`OSUdate`,`OSUtime`,`OSUstatus`,`OSUflag`,`OSUremark`)
		VALUES (NULL, '$Ordrid', '3', '$user', '$CurrentDate', '$CurrentTime', '1', '1','')";
		mysqli_query($con, $insertOrdr);
	}
	
	
		
		echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                   Confirmed Failed...
                  </div>";		  
				  
}
?>


 <?php 
   if(isset($_POST["move"]))
{
	$Ordrid=$_POST["ordr"];
	$updateStatus="Update `order` SET `oFlag`='16' WHERE `oid`='$Ordrid'";
	mysqli_query($con, $updateStatus);
	
	$selectUpdate="SELECT `OSUid` FROM `order_status_update` WHERE `Oid`='$Ordrid' AND `OSid`='16' AND `uid`='$user' AND `OSUstatus`='1' AND `OSUflag`='1'";
	$resultUpdate=mysqli_query($con, $selectUpdate);
	if(mysqli_num_rows($resultUpdate)==0)
	{
		$insertOrdr="INSERT INTO `order_status_update` 
		(`OSUid`, `Oid`,`OSid`,`uid`,`OSUdate`,`OSUtime`,`OSUstatus`,`OSUflag`,`OSUremark`)
		VALUES (NULL, '$Ordrid', '16', '$user', '$CurrentDate', '$CurrentTime', '1', '1','')";
		mysqli_query($con, $insertOrdr);
	}
	
	
		
		echo"<div class=\"alert alert-info alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                   Moved to Direct Sale Department...
                  </div>";		  
				  
}
?>
 						</div>
        

                  <table class="table table-hover">
                    <thead>
                      <tr>
                     <th>#</th>
                   	 <th> Order</th>
                     
                     <th> Date &amp; Time</th>
                     <th> Customer</th>
                     <th> Contact</th>
                     <th> Qty</th>
                     <th> Value</th>
                     <th>BPE</th>
                     <th> Confirm</th>
                     <th> Action</th>                    
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
	  $i = 0;
	
	$perpage=$page->perpage;
				   $pstart=$page->pstart;

					$selectBase=$page->query." ORDER BY a.oid ASC LIMIT $pstart,$perpage";
	

	
	//echo $selectBase;
	$resultSearch=mysqli_query($con, $selectBase);
	//echo $selectBase.$selectSearch.$selectFrom.$selectTo;
	//$resultSearch=($resultBase;
	
	//echo $resultSearch;
	if(mysqli_num_rows($resultSearch)>=1)
	{
		while($row=mysqli_fetch_array($resultSearch))
		{
		 $i = $i + 1;
	?>
					
                      <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo "#".$row["oid"]; ?></td>
                         
                         <td><?php echo $row["date"]." ".$Otime=$row["oTime"]; ?></td>
                         <td><?php echo $row["name"]; ?></td>
                         <td><?php echo $row["contactNum1"]; ?></td>
                         <td><?php echo $row["tqty"]; ?></td>
                         <td><?php echo $row["gtotal"]; ?></td>
                         <td><?php echo $row["Name"]; ?></td>
                         <td>
                         <?php if($row["oFlag"]==1){ ?>
                         <?php
						 $from_time=strtotime($Otime);
						 $to_time=strtotime($CurrentTime);
						 $min=round(abs($to_time-$from_time)/60);
						 if($min>=60)
						 {
						 ?>
                  <form action="" method="post">
                  <input type="hidden" value="<?php echo $row["oid"]; ?>" name="ordr">

                  <button type="submit" name="confirm"  class="btn btn-success btn-xs"><i class="fa fa-thumbs-up"></i> Confirm</button>                  
                  </form>    
                     
                     <?php
						 }
						 else
						 {
							 $wait=60-$min;
						 ?>
                         <i class="fa fa-clock-o"></i> <?php echo $wait."M Left" ?>
                   <?php
						 }
				  }
				 
					?>
                         </td>
                         <td>
                         <?php if($row["oFlag"]==1){ ?>
                           
                  <form action="confirm.php" method="post">
                  <input type="hidden" name="refid" value="<?php echo $row["eid"]; ?>" /> 
                  <button type="submit" name="btnShow"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> View</button>
                  </form>    
                     
                   <?php
				  }
				 
					?>
                    </td>
                      </tr>
                     <?php
					 $n++;
					}
	}
					?>
                    </tbody>
                    <tfoot>
                      <tr>
                      <th>#</th>
                   	 <th> Order</th>
                     
                     <th> Date &amp; Time</th>
                     <th> Customer</th>
                     <th> Contact</th>
                     <th> Qty</th>
                     <th> Value</th>
                     <th> BPE</th>
                     <th> Confirm</th>
                     <th> Action</th> 
                      </tr>
                    </tfoot>
                  </table>
    </div><!-- /.box-body -->
    
    <div class="box-footer clearfix">
                                <?php echo $page -> pinfo; ?>
                                <?php  $page->pagenav(); ?>
     </div>
    
 </div><!-- /.box -->             
</div>
  </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

    <?php footer($con); ?>

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    
  <?php jss(); ?>
  
   <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
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