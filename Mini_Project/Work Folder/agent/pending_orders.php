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
            <li class="active"><i class="fa fa-exclamation-triangle"></i> Pending Orders</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
        
          <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Pending Orders</h3>
                </div><!-- /.box-header -->
 
<hr/>
<div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                     <th>#</th>
                     <th>Action Time</th>
                   	 <th> Order</th>
                     <th> Order Date</th>
                     <th> Customer</th>
                     <th> Contact</th>
                     <th> Qty</th>
                     <th> Value</th>
                                       
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
	  $i = 0;
	$selectBase="select a.oid, ou.OSUremark, c.name, c.contactNum1, a.tqty, a.gtotal, a.oFlag, ou.OSUtime, a.date  from `order` a, `order_status` g, `order_status_update` ou, `customer` c, `district` d where a.oallotment=$user and (a.oFlag=8 OR a.oFlag=9) AND a.oFlag = ou.OSid AND ou.Oid=a.oid AND g.OsId=a.oFlag and c.customerid=a.customerid and d.Did=c.districtid and a.`status`='1' and a.tqty!=0 ORDER BY a.oid ASC";

	
	  
	//echo $selectBase.$stme.$selectFrom.$selectTo;
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
                        <td><?php echo $row["OSUtime"]; ?></td>
                       
                        <td>
						  
                  <form action="invoice.php" method="post" target="_blank">
                  <input type="hidden" name="refid" value="<?php echo $row["oid"]; ?>" /> 
                  <button type="submit" name="btnShow"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> <?php echo "#".$row["oid"]; ?></button>
                  </form> 
						</td>
                         <td><?php echo $row["date"]; ?></td>
                         <td><?php echo $row["name"]; ?></td>
                         <td><?php echo $row["contactNum1"]; ?></td>
                         <td><?php echo $row["tqty"]; ?></td>
                         <td><?php echo $row["gtotal"]; ?></td>
                         
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
                      <th> Action Time</th>
                   	 <th> Order</th>
                     <th> Order Date</th>
                     <th> Customer</th>
                     <th> Contact</th>
                     <th> Qty</th>
                     <th> Value</th>
                    
                      </tr>
                    </tfoot>
                  </table>
  
    </div><!-- /.box-body -->
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