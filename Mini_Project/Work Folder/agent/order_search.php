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
            <li class="active"><i class="fa fa-shopping-cart"></i> Order Search</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
           <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Order Search</h3>
                </div><!-- /.box-header -->
               <?php
			   if(isset($_POST['txtToDate']))
			   {
			   $tdate=$_POST['txtToDate'];
			   }
			   if(isset($_POST['txtSearch']))
			   {
			   $svalue=$_POST['txtSearch'];
			   }
			   ?> 
            
            <div class="box-body">
                <form method="POST" action="">
                 <div class="col-xs-12">
                 
                  <div class="col-xs-5">
                   <div class="form-group">
                   
                  <input  id="searchVal"  name="txtSearch" type="text" class="form-control"  value="<?php echo @$svalue?>"  placeholder="Search Here..."/>
                  </div>
                  </div>
                                    
                <div class="col-xs-3">
                	 <div class="form-group">
                     <div class="input-group input-group-sm">
                     <input name="txtToDate" type="date" class="form-control"  value="<?php echo @$tdate;?>"  id="searchTo"   placeholder="Order Date"/>
                   
                    <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" name="btnSearch" type="subit">Search</button>
                    </span>
                  
                  </div>
                  </div>
                  </div>		
       		  </form>
                        
 						
        </div>
        <br/> <hr/> <br/>
                
                <?php
if(isset($_POST["btnSearch"]))
{		
 $searchValue=$_POST["txtSearch"];
 $searchToDate=$_POST["txtToDate"];
?>
<hr/>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                     <th>#</th>
                   	 <th> Order</th>
                     <th> Date</th>
                     <th> Customer</th>
                     <th> Post Office with PIN</th>
                     <th> Qty</th>
                     <th> Value</th>
                     <th> Status</th>                   
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
	  $i = 0;
	$selectBase="select a.oid, a.date, b.name, a. tqty, a.gtotal, g.OsName, a.oallotment, g.OsId, e.Pincode, e.Officename from `order` a, `customer` b, `district` c, `pin` e, `order_status` g, `user` u where a.date='$searchToDate' AND (a.`oid`='$searchValue' or b.`contactNum1` LIKE '$searchValue' or b.`contactNum2` LIKE '$searchValue') AND a.customerid=b.customerid and  b.districtid=c.Did and b.post=e.Pid and u.Uid=a.tme and g.OsId=a.oFlag and a.`status`='1' ORDER BY a.oid DESC";
	
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
                        <td>
						<?php 
						if(($row["oallotment"]==$user) && (($row["OsId"]=='8') || ($row["OsId"]=='9') ||($row["OsId"]=='11'))) 
						{ 
						?>
                          <form action="invoice.php" method="post" target="_blank">
                  <input type="hidden" name="refid" value="<?php echo $row["oid"]; ?>" /> 
                  <button type="submit" name="btnShow"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> <?php echo $row["oid"]; ?>  </button>
                  </form> 
                   <?php
				  }
				  else
				  {
					?>
                    <?php echo $row["oid"]; ?>                     
                     <?php
				  }
				  ?>  
                         
						</td>
                         <td><?php echo $row["date"]; ?></td>
                         <td><?php echo $row["name"]; ?></td>
                         <td><?php echo $row["Pincode"]." - ".$row["Officename"]; ?></td>
                         <td><?php echo $row["tqty"]; ?></td>
                         <td><?php echo $row["gtotal"]; ?></td>
                         <td><?php echo $row["OsName"]; ?></td>
                         
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
                    <th> Post Office with PIN</th>
                     <th> Qty</th>
                     <th> Value</th>
                     <th> Status</th>
                      </tr>
                    </tfoot>
                  </table>
            <?php
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