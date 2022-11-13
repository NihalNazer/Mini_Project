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
            <li class="active"><i class="fa fa-tags"></i> Product Wise Order Allotment</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         
          <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Product Wise Order Allotment</h3>
                </div><!-- /.box-header -->
               <?php
			   if(isset($_POST['txtfDate']))
			   {
			   $fdate=$_POST['txtfDate'];
			   }
			   if(isset($_POST['txttDate']))
			   {
			   $tdate=$_POST['txttDate'];
			   }
			   if(isset($_POST['tme']))
			   {
			   $tme=$_POST['tme'];
			   }
			   ?> 
            
            <div class="box-body">
                <form method="POST" action="">
                 <div class="col-xs-12">
                 
                  <div class="col-xs-3">
                   <div class="form-group">
					<select name="tme"  class="form-control" >
                   <option value="">All</option>
                   <?php
if(isset($tme))
{ 
$selectTme="SELECT * FROM  `district` WHERE `Did`='$tme' AND  `Status`=1 ORDER BY District ASC";
$resultTme=mysqli_query($con, $selectTme);
while($rowTme=mysqli_fetch_array($resultTme))
{
?>
<option selected value="<?php echo $rowTme["Did"]; ?>"><?php echo $rowTme["District"]; ?></option>
<?php
}
}
?>

<?php 
$selectTme="SELECT * FROM  `district` WHERE `Status`=1 ORDER BY District ASC";
$resultTme=mysqli_query($con, $selectTme);
while($rowTme=mysqli_fetch_array($resultTme))
{
?>
<option value="<?php echo $rowTme["Did"]; ?>"><?php echo $rowTme["District"]; ?></option>
<?php
}
?>
                   </select>
                  </div>
                  </div>
                 
                  <div class="col-xs-3">
                   <div class="form-group">
                  <input name="txtfDate" type="date" class="form-control"  value="<?php echo @$fdate?>"/>
                  </div>
                  </div>
                   <div class="col-xs-1">
                    <div class="form-group">
                    To 
                    </div>
                   </div>
                    
                <div class="col-xs-3">
                	 <div class="form-group">
                     <div class="input-group input-group-sm">
                    
                   
                    <input name="txttDate" type="date" class="form-control"  value="<?php echo @$tdate?>"/>
                   
                    <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" name="search" type="subit">Search</button>
                    </span>
                  
                  </div>
                  </div>
                  </div>		
       		  </form>
                        
 						
        </div>
        <br/> <hr/> <br/>
                
                <?php
if(isset($_POST['search']) && ($_POST['txtfDate']!='')&& ($_POST['txttDate']!=''))
{
	$fdate=$_POST['txtfDate'];
	$tdate=$_POST['txttDate'];
	$tme=$_POST['tme'];
	?>
                 
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
                   	 <th> Item Code</th>
                     	 <th> Item(s)</th>
                        <th> No of Orders</th>
                     	<th> Order Value</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
	  $i = 0;
	  
	  $ti="TI";
	  
	  if($tme!='')
	{
	$stme=" d.`Did`='$tme' AND ";
	}
	else
	{
	$stme=" ";
	}
	 $selectEnq="SELECT b.Ccode AS Item_Code, b.Citem AS Item, SUM(b.Qty) AS Orders, SUM(b.Gtotal) AS Value FROM  `order` a, `order_split` b,  `user` f,  `district` d WHERE".$stme." a.oid= b.Orderid AND a.oallotment = f.Uid
AND f.Uid = d.agent AND (a.date>='$fdate' AND a.date<='$tdate') AND b.Gtotal!=0  AND b.Status=1 GROUP BY b.Ccode ORDER BY `Value` DESC";
	  
	  //$selectEnqGift="SELECT b.Ccode AS Item_Code, b.Citem AS Item, COUNT(b.Ccode) AS Orders, SUM(b.Gtotal) AS Value FROM  `order` a, `order_split`  b WHERE a.oid= b.Orderid  AND (a.date>='$fdate' AND a.date<='$tdate') AND b.Gtotal=0  AND b.Status=1 GROUP BY b.Ccode ORDER BY b.Ccode ASC";
	  
	$resultEnq=mysqli_query($con, $selectEnq);
	while($rowEnq=mysqli_fetch_array($resultEnq))
	{
		 $i = $i + 1;
	?>
					
                      <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo $rowEnq["Item_Code"]; ?></td>
                        <td><?php echo $rowEnq["Item"]; ?></td>
                        <td><?php echo $rowEnq["Orders"]; ?></td>
                        <td><?php echo $rowEnq["Value"]; ?></td>
                      </tr>
                     <?php
					 $n++;
					}
					?>
                    </tbody>
                    <tfoot>
                    
                    <?php
				
	 $selectEnqT="SELECT b.Ccode AS Item_Code, b.Citem AS Item, SUM(b.Qty) AS Orders, SUM(b.Gtotal) AS Value FROM  `order` a, `order_split`  b,  `user` f,  `district` d  WHERE".$stme." a.oid= b.Orderid  AND a.oallotment = f.Uid
AND f.Uid = d.agent  AND (a.date>='$fdate' AND a.date<='$tdate') AND b.Gtotal!=0  AND b.Status=1";
	  
	 
	$resultEnqT=mysqli_query($con, $selectEnqT);
	while($rowEnqT=mysqli_fetch_array($resultEnqT))
	{
	
	?>
					
                      <tr>
                        <td colspan="3"><center><span style="color:#F00; font-weight:bold;">TOTAL</span></center></td>
						<td><span style="color:#F00; font-weight:bold;"><?php echo $rowEnqT["Orders"]; ?></span></td>
                        <td><span style="color:#F00; font-weight:bold;"><?php echo $rowEnqT["Value"]; ?></span></td>
                      </tr>
                     <?php
					}
					?>
                     
                    
                      <tr>
                      <th>#</th>
                      <th> Item Code</th>
                     	 <th> Item(s)</th>
                        <th> No of Orders</th>
                     	<th> Order Value</th>
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