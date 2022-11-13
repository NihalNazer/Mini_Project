<?php include("../config/conntme.php"); ?>
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
            <li class="active"><i class="fa fa-star-half-o"></i> My Performance</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
          <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">My Performance</h3>
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
			   ?> 
            
            <div class="box-body">
                <form method="POST" action="">
                 <div class="col-xs-12">
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
                            
                           <!-- <div class="btn-group">
                              <form method="post" action="tme-performance-report.php">
                   <input type="hidden" value="<?php echo @$fdate; ?>" name="fdate">
                   <input type="hidden" value="<?php echo @$tdate; ?>" name="tdate">
                  <button type="submit" name="download"  class="btn btn-warning"><i class="fa  fa-download"></i> Download</button>
                   </form>
                   </div>-->
                            
                         </div>   
<br/> <hr/> <br/>

                 
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      <th>#</th>
                   	 <th> Name of BPE</th>
                     	 <th> Total Calls</th>
                        <th> Total Orders</th>
                     	<th> Conversion Rate</th>
                      <th> Products</th>
                        <th> Value of Order</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
	  $i = 0;
	  
	  $ti="TI";
	
	
	//$selectEnq="SELECT b.Name As BPE, b.Uid , (Select COUNT(m.uid) FROM `response` m WHERE(m.rdate>='$fdate' AND m.rdate<='$tdate') AND m.rstatus=1 GROUP BY b.Uid) As Total_Calls, (select count(a.tme) FROM `order` a WHERE (a.date>='$fdate' AND a.date<='$tdate')) AS Total_Orders, SUM(a.gtotal) as Order_Value FROM `order` a  , `user` b WHERE (a.date>='$fdate' AND a.date<='$tdate') AND a.tme=b.Uid AND a.status=1 AND a.tqty!=0 GROUP BY b.Uid  HAVING (Total_Calls>=1 OR Total_Orders>=1) ORDER BY Order_Value DESC";
	$selectEnq="SELECT b.Uid, b.Name  As BPE, 
	  (Select COUNT(m.uid) FROM `response` m WHERE m.rstatus=1 AND m.uid=b.Uid  AND (m.rdate>='$fdate' AND m.rdate<='$tdate') GROUP BY b.Uid) As  Total_Calls,
	  (Select count(a.tme) FROM  `order` a WHERE a.tme=b.Uid AND a.status=1 AND a.tqty!=0 AND (a.date>='$fdate' AND a.date<='$tdate') ) AS Total_Orders, 
	  round((((Select Total_Orders)/((Select Total_Calls)))*100),2) AS Conversion_Rate,
    (Select SUM(a.tqty) FROM  `order` a WHERE a.tme=b.Uid AND a.status=1  AND (a.date>='$fdate' AND a.date<='$tdate')) AS Order_Pro,
	  (Select SUM(a.gtotal) FROM  `order` a WHERE a.tme=b.Uid AND a.status=1  AND (a.date>='$fdate' AND a.date<='$tdate')) AS Order_Value From `user` b WHERE b.Status=1 and b.Uid=$user GROUP BY b.Uid  HAVING (Total_Calls>=1 OR Total_Orders>=1) ORDER BY Order_Value DESC";
	
	$resultEnq=mysqli_query($con, $selectEnq);
	while($rowEnq=mysqli_fetch_array($resultEnq))
	{
		 $i = $i + 1;
		 if($rowEnq["Uid"]==$user)
		 {
	?>
     <tr style="background:#9FC;">
                        <th><?php echo $n; ?></th>
                        <th><?php echo $rowEnq["BPE"]; ?></th>
                        <th><?php echo $TC=$rowEnq["Total_Calls"]; ?></th>
                        <th><?php echo $TO=$rowEnq["Total_Orders"]; ?></th>
                        <th><?php echo $rowEnq["Conversion_Rate"]; ?></th>
                         <th><?php echo $rowEnq["Order_Pro"]; ?></th>
                        <th><?php echo $rowEnq["Order_Value"]; ?></th>
                      </tr>
					
                    
                    <?php
		 }
		 else
		 {
			 ?>
                            
                 <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo $rowEnq["BPE"]; ?></td>
                        <td><?php echo $rowEnq["Total_Calls"]; ?></td>
                        <td><?php echo $rowEnq["Total_Orders"]; ?></td>
                        <td><?php echo $rowEnq["Conversion_Rate"]; ?></td>
                        <td><?php echo $rowEnq["Order_Pro"]; ?></td>
                         <td><?php echo $rowEnq["Order_Value"]; ?></td>
                      </tr>     
                      <?php
		 }
		 ?>
                      
                     <?php
					 $n++;
					}
					?>
                    </tbody>
                    <tfoot>
                    
                    <?php
				
	  $selectEnqT="SELECT b.Name  As TME, 
	  (Select COUNT(m.uid) FROM `response` m WHERE m.rstatus=1 AND (m.rdate>='$fdate' AND m.rdate<='$tdate')) As  Total_Calls,
	  count(a.tme) AS Total_Orders, 
	  round(((count(a.tme)/(Select COUNT(m.uid) FROM `response` m WHERE m.rstatus=1  AND (m.rdate>='$fdate' AND m.rdate<='$tdate')))*100),2) AS Conversion_Rate,
	  SUM(a.gtotal) AS Order_Value, SUM(a.tqty) AS Order_Pro FROM `order` a, `user` b WHERE a.tme=b.Uid AND a.status=1 AND (a.date>='$fdate' AND a.date<='$tdate') AND a.tqty!=0";
  
	$resultEnqT=mysqli_query($con, $selectEnqT);
	while($rowEnqT=mysqli_fetch_array($resultEnqT))
	{
		
	?>
					
                      <tr>
                        <td colspan="2"><center><span style="color:#F00; font-weight:bold;">TOTAL</span></center></td>
  
                        <td><span style="color:#F00; font-weight:bold;"><?php echo $TTC=$rowEnqT["Total_Calls"]; ?></span></td>
                        <td><span style="color:#F00; font-weight:bold;"><?php echo $TTO=$rowEnqT["Total_Orders"]; ?></span></td>
                        <td><span style="color:#F00; font-weight:bold;"><?php echo $TCR=$rowEnqT["Conversion_Rate"]; ?></span></td>
                        <td><span style="color:#F00; font-weight:bold;"><?php echo $rowEnqT["Order_Pro"]; ?></span></td>
                        <td><span style="color:#F00; font-weight:bold;"><?php echo $rowEnqT["Order_Value"]; ?></span></td>
                      </tr>
                     <?php
					}
					?>
                    
                      <tr>
                      <th>#</th>
                     <th> Name of BPE</th>
                     	 <th> Total Calls</th>
                        <th> Total Orders</th>
                     	<th> Conversion Rate</th>
                      <th> Products</th>
                        <th> Value of Order</th>
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