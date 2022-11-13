<?php include("../config/connbdm.php"); ?>
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

  
   <?php  head_part_home(); ?>
  
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
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Your Page Content Here -->
          
          
           <!-- =========================================================== -->
<div class="row">
         <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-green">
              
                <span class="info-box-icon"><i class="fa fa-check-square-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Delivered</span>
                  <span class="info-box-number">
                  <?php
				  $fday=date('Y-m-01');
				 $selectOrdr="select count(DISTINCT(a.oid)) as Ocount from `order` a, `order_status` g, `order_status_update` ou where ou.OSUdate>='$CurrentDate'  AND  a.oallotment=$user and  a.oFlag=11 AND a.oallotment!=0 AND ou.Oid=a.oid AND g.OsId=a.oFlag and a.`status`='1' and a.tqty!=0";

	$resultOrdr=mysqli_query($con, $selectOrdr);
while($rowOrdr=mysqli_fetch_array($resultOrdr))
{
	echo $rowOrdr["Ocount"];
}?>
         
                  </span>
                  <div class="progress">
                    <div class="progress-bar" style="width:100%"></div>
                  </div>
                  <span class="progress-description"  style="cursor:pointer;" onClick="location.href='delivered_orders.php'" >
                   Click here to go &raquo;
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-ban"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Canceled</span>
                  <span class="info-box-number">
                   <?php
				  $selectOrdr="select count(DISTINCT(a.oid)) as Ocount from `order` a, `order_status` g, `order_status_update` ou where ou.OSUdate>='$CurrentDate'  AND  a.oallotment=$user and  a.oFlag=12 AND a.oallotment!=0 AND ou.Oid=a.oid AND g.OsId=a.oFlag and a.`status`='1' and a.tqty!=0";
	$resultOrdr=mysqli_query($con, $selectOrdr);
while($rowOrdr=mysqli_fetch_array($resultOrdr))
{
	echo $rowOrdr["Ocount"];
}?>
                  </span>
                  <div class="progress">
                    <div class="progress-bar" style="width:100%"></div>
                  </div>
                  <span class="progress-description" style="cursor:pointer;" onClick="location.href='canceled_orders.php'" >
                   Click here to go &raquo;
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <div class="col-md-3 col-sm-6 col-xs-12">
            
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-spinner"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Pending</span>
                  <span class="info-box-number">
                   <?php
            $selectOrdr="select count(DISTINCT(a.oid)) as Ocount from `order` a, `order_status_update` ou where a.oallotment=$user and (a.oFlag=8 OR a.oFlag=9) AND ou.Oid=a.oid AND a.`status`='1' AND a.oallotment!=0 and a.tqty!=0";
				 
	$resultOrdr=mysqli_query($con, $selectOrdr);
while($rowOrdr=mysqli_fetch_array($resultOrdr))
{
	echo $rowOrdr["Ocount"];
}?>
                  </span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description"  style="cursor:pointer;" onClick="location.href='pending_orders.php'" >
                    Click here to go &raquo;
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-blue">
              
                <span class="info-box-icon"><i class="fa fa-reply-all"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Rejected</span>
                  <span class="info-box-number">
                   <?php
				  $selectOrdr="select count(DISTINCT(a.oid)) as Ocount from `order` a, `order_status` g, `order_status_update` ou where ou.OSUdate>='$CurrentDate'  AND  a.oallotment=$user and  a.oFlag=10 AND a.oallotment!=0 AND ou.Oid=a.oid AND g.OsId=a.oFlag and a.`status`='1' and a.tqty!=0";
				 
	$resultOrdr=mysqli_query($con, $selectOrdr);
while($rowOrdr=mysqli_fetch_array($resultOrdr))
{
	echo $rowOrdr["Ocount"];
}?>
                  </span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description" style="cursor:pointer;" onClick="location.href='rejected_orders.php'" >
                   Click here to go &raquo;
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <!-- =========================================================== -->
          
          
        <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Recent Orders</h3>
                  <?php

    $showUserid=$_SESSION['homsuser'];
   	require_once("../class/ipagination.php");
   	$page=new ipagination();
   	$page->perpage=20;
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
	
	$page->query="select a.oid, a.date, b.name, b.contactNum1, a.tqty, a.gtotal, a.oFlag, g.OsName, a.eid, e.Officename, e.Pincode, a.oFlag from `order` a, `customer` b, `district` c, `pin` e,  `order_status` g where  a.`oFlag`='8' and a.oallotment=$user and a.customerid=b.customerid and b.districtid=c.Did and b.post=e.Pid and g.OsId=a.oFlag and a.`status`='1' and a.invtype=1 ".$qquery;

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
   if(isset($_POST["accept"]))
{
	$Ordrid=$_POST["ordr"];
	$updateStatus="Update `order` SET `oFlag`='9' WHERE `oid`='$Ordrid'";
	mysqli_query($con, $updateStatus);
	
	$selectUpdate="SELECT `OSUid` FROM `order_status_update` WHERE `Oid`='$Ordrid' AND `OSid`='9' AND `uid`='$user' AND `OSUstatus`='1' AND `OSUflag`='1'";
	$resultUpdate=mysqli_query($con, $selectUpdate);
	if(mysqli_num_rows($resultUpdate)==0)
	{
	$insertOrdr="INSERT INTO `order_status_update` 
		(`OSUid`, `Oid`,`OSid`,`uid`,`OSUdate`,`OSUtime`,`OSUstatus`,`OSUflag`,`OSUremark`)
		VALUES (NULL, '$Ordrid', '9', '$user', '$CurrentDate', '$CurrentTime', '1', '1','')";
		mysqli_query($con, $insertOrdr);
		
	}
		
		echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                   Order Accepted
                  </div>";
}
?>


 <?php 
   if(isset($_POST["reject"]))
{
	$Ordrid=$_POST["ordr"];
	$updateStatus="Update `order` SET `oFlag`='10' WHERE `oid`='$Ordrid'";
	mysqli_query($con, $updateStatus);	
	$selectUpdate="SELECT `OSUid` FROM `order_status_update` WHERE `Oid`='$Ordrid' AND `OSid`='10' AND `uid`='$user' AND `OSUstatus`='1' AND `OSUflag`='1'";
	$resultUpdate=mysqli_query($con, $selectUpdate);
	if(mysqli_num_rows($resultUpdate)==0)
	{
		$insertOrdr="INSERT INTO `order_status_update` 
		(`OSUid`, `Oid`,`OSid`,`uid`,`OSUdate`,`OSUtime`,`OSUstatus`,`OSUflag`,`OSUremark`)
		VALUES (NULL, '$Ordrid', '10', '$user', '$CurrentDate', '$CurrentTime', '1', '1','')";
		mysqli_query($con, $insertOrdr);
	}
	
	
		
		echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                   Order Rejected
                  </div>";		  
				  
}
?>

 						</div>
        <div class="col-xs-12">
						 <div class="btn-group">
 
							<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars"></i> Export Table Data
                            </button>
                          <ul class="dropdown-menu" role="menu">
                            
                            <li>
                                <a href="#" onclick="$('#example1').tableExport({type:'excel',escape:'false',ignoreColumn: [ 10],tableName:'OrderTable'});"> 
                                <img src="../table_export/images/xls.png" width="24px"> XLS
                                </a>
                                </li>
                                
								</ul>
                                </div>
                         </div>   
<br/> <hr/> <br/>

                  
                  <table id="#example1" class="table table-hover">
                    <thead>
                      <tr>
                     <th>#</th>
                   	 <th> Order</th>
                     <th> Date</th>
                     <th> Customer</th>
                     <th> Contact</th>
                     <th> Qty</th>
                     <th> Value</th>
                     <th> Post Office with PIN</th>                   
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
                        <td>
						<?php if($row["oFlag"]==8){ ?>
                        
                  <form action="accept.php" method="post">
                  <input type="hidden" value="<?php echo $row["oid"]; ?>" name="refid">
                  <button type="submit" name="btnShow"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> <?php echo "#".$row["oid"]; ?></button>                  
                  </form>    
                   <?php
				  }
				  ?>
					</td>
                         
                         <td><?php $odate=$row["date"]; echo date("d-m-Y", strtotime($odate)); ?></td>
                         <td><?php echo $row["name"]; ?></td>
                         <td><?php echo $row["contactNum1"]; ?></td>
                         <td><?php echo $row["tqty"]; ?></td>
                         <td><?php echo $row["gtotal"]; ?></td>
                         <td><?php echo $row["Pincode"]." - ".$row["Officename"]; ?></td>
                        
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
                     <th> Post Office with PIN</th>
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