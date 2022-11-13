<?php include("../config/conn.php"); ?>
<?php
//validation for admin page;
if(!isset($_SESSION['homsuser']) || !isset($_SESSION['homsutype']) ||($_SESSION['homsutype']!=12))
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
    <?php mgmt_nav($con); ?>
  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Management
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <!--<li><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
            <li class="active"><i class="fa fa-tags"></i> Product Search</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
          <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Product Search</h3>
                </div><!-- /.box-header -->
               
            
            
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                     <th>#</th>
                     <th> ProductID</th>
                   	 <th> Product Name</th>
                     <th> Offer Price</th>
                     <th> Special Price</th>
                     <th> A Class Agent</th>
                     <th> B Class Agent</th>
                     <th> C Class Agent</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
	  $i = 0;
	$selectBase="select a.*, b.* from `product` a,`product_category` b where a.status='1' and a.catid=b.catid order by a.Product ASC";
 //echo $selectBase;

	
	$resultSearch=mysqli_query($con, $selectBase);
	//echo $resultSearch;
	if(mysqli_num_rows($resultSearch)>=1)
	{
		while($row=mysqli_fetch_array($resultSearch))
		{
		 $i = $i + 1;
	?>
					
                      <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo $row["pid"]; ?></td>
                        <td><?php echo $row["Product"]; ?></td>
                         <td><?php echo $row["oprice"]; ?></td>
                         <td><?php echo $row["rprice"]; ?></td>
                         <td><?php echo $row["aprice"]." (".$row["aperc"]."%)"; ?></td>
                         <td><?php echo $row["bprice"]." (".$row["bperc"]."%)"; ?></td>
                         <td><?php echo $row["cprice"]." (".$row["cperc"]."%)"; ?></td>
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
                     <th> ProductID</th>
                   	 <th> Product Name</th>
                     <th> Offer Price</th>
                     <th> Special Price</th>
                     <th> A Class Agent</th>
                     <th> B Class Agent</th>
                     <th> C Class Agent</th>
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