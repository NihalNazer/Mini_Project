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
            <li class="active"><i class="fa fa-tag"></i> Stock Report</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         
          <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> Stock Report</h3>
                </div><!-- /.box-header -->
               <?php
			   if(isset($_POST['tme']))
			   {
			   $tme=$_POST['tme'];
			   }
         if(isset($_POST['tra']))
         {
         $tra=$_POST['tra'];
         }
			   ?> 
            
            <div class="box-body">
                <form method="POST" action="">
                 <div class="col-xs-12">
                 
                  <div class="col-xs-3">
                   <div class="form-group">
                    <label>Select District to Filter</label>
          <select name="tme"  class="form-control" >
                   <option value="">All Districts</option>
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
                    <label>Select Product to Filter</label>
                     <div class="input-group input-group-sm">
                    
                   <select name="tra"  class="form-control" >
                   <option value="">All Products</option>
                   <?php
if(isset($tra))
{ 
$selectTme="SELECT Product, pid FROM  `product` WHERE `pid`='$tra' ORDER BY Product ASC";
$resultTme=mysqli_query($con, $selectTme);
while($rowTme=mysqli_fetch_array($resultTme))
{
?>
<option selected value="<?php echo $rowTme["pid"]; ?>"><?php echo $rowTme["Product"]; ?></option>
<?php
}
}
?>

<?php 
$selectTme="SELECT Product, pid FROM  `product` ORDER BY Product ASC";
$resultTme=mysqli_query($con, $selectTme);
while($rowTme=mysqli_fetch_array($resultTme))
{
?>
<option value="<?php echo $rowTme["pid"]; ?>"><?php echo $rowTme["Product"]; ?></option>
<?php
}
?>
                   </select>
                    
                   
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
if(isset($_POST['search']))
{
	$tme=$_POST['tme'];
  $tra=$_POST['tra'];
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
                      <th>District</th>
                      <th>Agent</th>
                      <th>Product</th>
                      <th> Opening Date</th>
                   	 <th> Opening</th>
                     <th>Last Update</th>
                     	 <th> Closing Date</th>
                        <th> Stock</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
	  $i = 0;
    $tq=0;
    $color="#000";
	  
	  $ti="TI";
	  
	  if($tme!='')
	{
	$stme=" d.`Did`='$tme' AND ";
	}
	else
	{
	$stme=" ";
	}
  if($tra!='')
  {
  $stra=" a.`inv_pro`='$tra' AND ";
  }
  else
  {
  $stra=" ";
  }
	 $selectEnq="SELECT d.District, a.inv_oS, a.inv_oDT, a.inv_cS, a.inv_cDT, a.luRid, b.Product, u.Name FROM  `inventory` a, `product` b,  `user` u,  `district` d WHERE".$stme.$stra." a.inv_wh = u.Uid and a.inv_pro=b.pid
AND u.Uid = d.agent AND a.inv_stat=1 ORDER BY inv_wh ASC";
	  
	  //$selectEnqGift="SELECT b.Ccode AS Item_Code, b.Citem AS Item, COUNT(b.Ccode) AS Orders, SUM(b.Gtotal) AS Value FROM  `order` a, `order_split`  b WHERE a.oid= b.Orderid  AND (a.date>='$fdate' AND a.date<='$tdate') AND b.Gtotal=0  AND b.Status=1 GROUP BY b.Ccode ORDER BY b.Ccode ASC";
	  
	$resultEnq=mysqli_query($con, $selectEnq);
	while($rowEnq=mysqli_fetch_array($resultEnq))
	{
		 $i = $i + 1;
     $tq=$tq+$rowEnq["inv_cS"];

if($rowEnq["inv_cS"]>="0")
{
$color="#000";
}
else
{
$color="#f00";
}
 ?>
					
                      <tr style="color:<?php echo $color; ?>;">
                        <td><?php echo $n; ?></td>
                        <td><?php echo $rowEnq["District"]; ?></td>
                        <td><?php echo $rowEnq["Name"]; ?></td>
                        <td><?php echo $rowEnq["Product"]; ?></td>
                        <td><?php echo $rowEnq["inv_oDT"]; ?></td>
                        <td><?php echo $rowEnq["inv_oS"]; ?></td>
                        <td><?php echo $rowEnq["luRid"]; ?></td>
                        <td><?php echo $rowEnq["inv_cDT"]; ?></td>
                        <td><?php echo $rowEnq["inv_cS"]; ?></td>
                      </tr>
                     <?php
					 $n++;
					}
					?>
                    </tbody>
                    <tfoot>
                    
                      <tr>
                        <td colspan="8"><center><span style="color:#7F00FF; font-weight:bold;">TOTAL</span></center></td>
						<td><span style="color:#7F00FF; font-weight:bold;"><?php echo $tq; ?></span></td>
                      </tr>
                     
                      <tr>
                    <th>#</th>
                      <th>District</th>
                      <th>Agent</th>
                      <th>Product</th>
                      <th> Opening Date</th>
                     <th> Opening</th>
                     <th>Last Update</th>
                       <th> Closing Date</th>
                        <th> Stock</th>
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