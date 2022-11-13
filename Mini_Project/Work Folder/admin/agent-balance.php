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
            <li class="active"><i class="fa fa-book"></i> Agent Account Balance</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         
          <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> Agent Account Balance (Current)</h3>
                </div><!-- /.box-header -->
               
                  <div class="box-body">
                 <div class="col-xs-12">
						 <div class="btn-group">
 
							<button class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars"></i> Export Table Data
                            </button>
                            
                            
							<ul class="dropdown-menu" role="menu">
                            
                            <li>
                                <a href="#" onclick="$('#example1').tableExport({type:'excel',escape:'false',tableName:'OrderTable'});"> 
                                <img src="../table_export/images/xls.png" width="24px"> XLS
                                </a>
                                </li>
                             </ul>
                            </div>
                          
                            
                         </div>   
<br/> <hr/> <br/>

                 
                 
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      <th>#</th>
                      <th>District</th>
                      <th>Agent</th>
                   	 <th> Updated Date</th>
                     	 <th> Updated Time</th>
                        <th>Last Update</th>
                     	<th> Receivables</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
	  $i = 0;
    $tmt=0;
    $color="#000";
	  
	  $ti="TI";
	  
	 
	 $selectEnq="select user.Name, user.balance, user.ludate, user.lutime, user.luRid, user.Status as Statuss, user.Uid, user.Email, user.Phone, district.*  from user left outer join district on district.Did = user.Dist where user.Categoryid='8' order by user.Name ASC";
	  
	  //$selectEnqGift="SELECT b.Ccode AS Item_Code, b.Citem AS Item, COUNT(b.Ccode) AS Orders, SUM(b.Gtotal) AS Value FROM  `order` a, `order_split`  b WHERE a.oid= b.Orderid  AND (a.date>='$fdate' AND a.date<='$tdate') AND b.Gtotal=0  AND b.Status=1 GROUP BY b.Ccode ORDER BY b.Ccode ASC";
	  
	$resultEnq=mysqli_query($con, $selectEnq);
	while($rowEnq=mysqli_fetch_array($resultEnq))
	{
		 $i = $i + 1;
$tmt=$tmt+$rowEnq["balance"];

if($rowEnq["balance"]>="0")
{
$color="#000";
}
else
{
$color="#4f7942";
}
 ?>
					
                      <tr style="color:<?php echo $color; ?>;">
                        <td><?php echo $n; ?></td>
                        <td><?php echo $rowEnq["District"]; ?></td>
                        <td><?php echo $rowEnq["Name"]; ?></td>
                        <td><?php echo $rowEnq["ludate"]; ?></td>
                        <td><?php echo $rowEnq["lutime"]; ?></td>
                        <td><?php echo $rowEnq["luRid"]; ?></td>
                        <td><?php echo $rowEnq["balance"]; ?></td>
                      </tr>
                     <?php
					 $n++;
					}
					?>
                    </tbody>
                    <tfoot>
                    
                      <tr>
                        <td colspan="6"><center><span style="color:#7F00FF; font-weight:bold;">TOTAL</span></center></td>
                        <td><span style="color:#7F00FF; font-weight:bold;"><?php echo $tmt; ?></span></td>
                      </tr>
                     
                      <tr>
                     <th>#</th>
                      <th>District</th>
                      <th>Agent</th>
                     <th> Updated Date</th>
                       <th> Updated Time</th>
                        <th>Last Update</th>
                      <th> Receivables</th>
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