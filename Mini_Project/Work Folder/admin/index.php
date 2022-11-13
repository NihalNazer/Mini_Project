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
<html xmlns="http://www.w3.org/1999/xhtml">

  
   <?php  head_part_home(); ?>
  
  <body class="skin-black">
    <div class="wrapper">

     	<?php top($con); ?>
		<?php admin_nav($con); ?>
  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin
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
					$fday=date('Y-m-01');
				  $selectEnq="SELECT count(a.eid) as Ecount FROM  `enquiry` a, `number_config` b, `user` c WHERE a.lnode= b.ncid AND a.`userid`!=0  AND a.userid=c.Uid  AND a.status=1 AND a.`adate`>='$fday'";
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
                  <span class="progress-description"  style="cursor:pointer;" onClick="location.href='campaign-summary.php'" >
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
				  $fday=date('Y-m-01');
				  $selectOrdr="select count(a.oid) as Ocount from `order` a, `customer` b, `district` c,  `pin` e,  `order_status` g, `user` u where a.customerid=b.customerid and  b.districtid=c.Did and b.post=e.Pid and u.Uid=a.tme and g.OsId=a.oFlag and a.`status`='1' and a.tqty!=0 AND a.date>='$fday' ";
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
				 $fday=date('Y-m-01');
				$selectCst="select  count(b.customerid) as  Ccount from  `customer` b, `district` c,  `pin` e where  b.districtid=c.Did and b.post=e.Pid and  b.`status`='1' AND b.CuDate>='$fday' ";
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
	
	 $fday=date('Y-m-01'); 
	  $selectEnqT="SELECT SUM(b.Qty) AS Value FROM  `order` a, `order_split`  b WHERE a.oid= b.Orderid  AND b.Gtotal!=0  AND b.Status=1 AND a.date>='$fday' ";
	 
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
                  <span class="progress-description" style="cursor:pointer;" onClick="location.href='product-orders.php'" >
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
                  <h3 class="box-title">Todays Order</h3>
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
	$page->query="select a.oid, a.date, b.name, b.contactNum1, a.tqty, a.gtotal, u.Name, g.OsName, a.eid from `order` a, `customer` b, `district` c, `pin` e, `order_status` g, `user` u where a.customerid=b.customerid and b.districtid=c.Did  and b.post=e.Pid and u.Uid=a.tme and g.OsId=a.oFlag and a.`status`='1' AND (a.`date`='$CurrentDate') ".$qquery;
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
<div class="col-xs-12">
						 <div class="btn-group">
 
							<button class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars"></i> Export Table Data
                            </button>
                            
                            
							<ul class="dropdown-menu" role="menu">
                            
                            <li>
                                <a href="#" onclick="$('#example1').tableExport({type:'excel',escape:'false',ignoreColumn: [9, 10],tableName:'OrderTable'});"> 
                                <img src="../table_export/images/xls.png" width="24px"> XLS
                                </a>
                                </li>
                               </ul>
                            </div>
                                                        
                         </div>   
<br/> <hr/> <br/>
					
                  <table class="table table-hover">
                    <thead>
                      <tr>
                     <th>#</th>
                   	 <th> Order</th>
                     
                     <th> Date</th>
                     <th> Customer</th>
                     <th> Contact</th>
                     <th> Qty</th>
                     <th> Value</th>
                     <th> BPE</th>
                     <th> Status</th>
                     <th> Action</th>                    
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					
					$n=1;
	  $i = 0;
	
	$perpage=$page->perpage;
				   $pstart=$page->pstart;

					$selectBase=$page->query." ORDER BY a.oid DESC LIMIT $pstart,$perpage";
	
	//echo $selectBase.$selectSearch.$selectFrom.$selectTo;
	$resultSearch=mysqli_query($con, $selectBase);
	//echo $selectBase.$selectSearch.$selectFrom.$selectTo;
	//$resultSearch=($resultBase.$queryResult1.$queryResult2.$queryResult3);
	
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
                        
                         <td><?php echo $row["date"]; ?></td>
                         <td><?php echo $row["name"]; ?></td>
                         <td><?php echo $row["contactNum1"]; ?></td>
                         <td><?php echo $row["tqty"]; ?></td>
                         <td><?php echo $row["gtotal"]; ?></td>
                         <td><?php echo $row["Name"]; ?></td>
                         <td><?php echo $row["OsName"]; ?></td>
                         <td>
                        
                    
                  <form action="invoice.php" method="post" target="_blank">
                  <input type="hidden" name="refid" value="<?php echo $row["eid"]; ?>" /> 
                  <button type="submit" name="btnShow"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> View</button>
                  </form>    
                    
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
                     
                     <th> Date</th>
                     <th> Customer</th>
                     <th> Contact</th>
                     <th> Qty</th>
                     <th> Value</th>
                     <th> BPE</th>
                     <th> Status</th>
                     <th> Action</th> 
                      </tr>
                    </tfoot>
                  </table>
                  

    </div><!-- /.box-body -->
     <div class="box-footer clearfix">
                                <?php echo $page -> pinfo; ?>
                                <?php  $page->pagenav(); ?>
    
 </div><!-- /.box --></div> </section><!-- /.content -->
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