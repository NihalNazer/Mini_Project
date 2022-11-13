<?php include("../config/connfc.php"); ?>
<?php
//validation for admin page;
if(!isset($_SESSION['homsuser']) || !isset($_SESSION['homsutype']) ||($_SESSION['homsutype']!=2))
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
		<?php tme_nav($con); ?>
  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           BPE
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <!--<li><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
            <li class="active"><i class="fa fa-flag-o"></i> Track Order </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Track Orders</h3>
                </div><!-- /.box-header -->
               <?php
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
                   
                  <input  id="searchVal"  name="txtSearch" type="text" class="form-control"  value="<?php echo @$svalue?>"  placeholder="Enter Order Id Here..."/>
                  </div>
                  </div>
                  <div class="col-xs-3">
                  <div class="form-group">
                     <input name="txtDate"  id="searchDate" type="date" class="form-control"  value="<?php echo @$odate?>"  placeholder="Order Date"/>
                   </div>
                   </div>
                   
                  <div class="col-xs-3">
                	 <div class="form-group">
                     <div class="input-group input-group-sm">
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
 $odate=$_POST["txtDate"];
?>
<hr/>

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                     <th>#</th>
                   	 <th> Order</th>
                     <th> Activity</th>
                     <th> Remark</th>
                     <th> Date</th>
                     <th> Time</th>
                     <th> User</th>
                     <th> Permission</th>
                     <th> Shift</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
	  $i = 0;
	$selectBase="select a.Oid, b.OsName, a.OSUremark, a.OSUdate, a.OSUtime, d.Name, e.Category, f.shft_name from `order_status_update` a, `order_status` b, `order` c, `user` d, `user_category` e, `user_shift` f  where a.`Oid`='$searchValue' AND c.date='$odate' AND a.Oid=c.oid AND a.OSid=b.OsId AND a.uid=d.Uid AND d.Categoryid=e.cid AND d.shft=f.shft_id	AND a.OSUstatus=1 order by a.OSUid ASC";

	
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
                        <td><?php echo $row["Oid"]; ?></td>
                         <td><?php echo $row["OsName"]; ?></td>
                         <td><?php echo $row["OSUremark"]; ?></td>
                         <td><?php echo $row["OSUdate"]; ?></td>
                         <td><?php echo $row["OSUtime"]; ?></td>
                         <td><?php echo $row["Name"]; ?></td>
                         <td><?php echo $row["Category"]; ?></td>
                         <td><?php echo $row["shft_name"]; ?></td>
                         
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
                     <th> Activity</th>
                     <th> Remark</th>
                     <th> Date</th>
                     <th> Time</th>
                     <th> User</th>
                     <th> Permission</th>
                     <th> Shift</th>
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