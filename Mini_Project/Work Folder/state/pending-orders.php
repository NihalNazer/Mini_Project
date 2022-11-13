<?php include("../config/conn.php"); ?>
<?php
//validation for admin page;
if(!isset($_SESSION['homsuser']) || !isset($_SESSION['homsutype']) ||($_SESSION['homsutype']!=9))
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
		<?php frm_nav($con); ?>
  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            State Co-ordinator
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <!--<li><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
            <li class="active"><i class="fa fa-question-circle"></i> Agent Wise Pending Orders</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Your Page Content Here -->
          
          
           <!-- =========================================================== -->

        

          <!-- =========================================================== -->
          
          
       
          <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Agent Wise Pending Orders</h3>
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
                              <form method="post" action="franchisee-orders-report.php">
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
                   	 <th> Agent</th>
                     
                     <th> District</th>
                     
                     	<th> Allotted</th>
                     	<th> Value</th>
                        
                        
                     	<th>Accepted</th>
                     	<th>Value</th>
                     	<th>Rejected</th>
                     	<th>Value</th>
                     	
                        <th> Total</th>
                     	<th> Value</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
$TAllo_Orders=$TAllo_Value=$TAcc_Orders=$TAcc_Value=$TRej_Orders=$TRej_Value=$TPen_Orders=$TPen_Value=0;
	  $i = 0;
	  
	  $ti="TI";
	
	$selectEnq="SELECT b.Name  As Franc, d.District  As Dist, 
	
	(Select count(a.oid) FROM  `order` a WHERE a.oallotment=b.Uid AND a.status=1 AND a.tqty!=0 AND (a.date>='$fdate' AND a.date<='$tdate') AND a.oFlag=8) AS Allo_Orders, 
	  
	  (Select SUM(a.gtotal) FROM  `order` a WHERE a.oallotment=b.Uid AND a.status=1  AND (a.date>='$fdate' AND a.date<='$tdate') AND a.oFlag=8) AS Allo_Value,
	  
	  	
	  (Select count(a.oid) FROM  `order` a WHERE a.oallotment=b.Uid AND a.status=1 AND a.tqty!=0 AND (a.date>='$fdate' AND a.date<='$tdate') AND a.oFlag=9) AS Acc_Orders, 
	  
	  (Select SUM(a.gtotal) FROM  `order` a WHERE a.oallotment=b.Uid AND a.status=1  AND (a.date>='$fdate' AND a.date<='$tdate') AND a.oFlag=9) AS Acc_Value,
	  
	  
	  (Select count(a.oid) FROM  `order` a WHERE a.oallotment=b.Uid AND a.status=1 AND a.tqty!=0 AND (a.date>='$fdate' AND a.date<='$tdate') AND a.oFlag=10) AS Rej_Orders, 
	  
	  (Select SUM(a.gtotal) FROM  `order` a WHERE a.oallotment=b.Uid AND a.status=1  AND (a.date>='$fdate' AND a.date<='$tdate') AND a.oFlag=10) AS Rej_Value,
	  
	  
	 
	  (Select count(a.oid) FROM  `order` a WHERE a.oallotment=b.Uid AND a.status=1 AND a.tqty!=0 AND (a.date>='$fdate' AND a.date<='$tdate') AND (a.oFlag!=11 && a.oFlag!=12)) AS Pen_Orders, 
	  
	  (Select SUM(a.gtotal) FROM  `order` a WHERE a.oallotment=b.Uid AND a.status=1  AND (a.date>='$fdate' AND a.date<='$tdate') AND (a.oFlag!=11 && a.oFlag!=12)) AS Pen_Value
	
	  From `user` b, `district` d WHERE d.Did=b.Dist GROUP BY b.Uid  HAVING (Pen_Orders>=1) ORDER BY Pen_Value DESC";
	
	$resultEnq=mysqli_query($con, $selectEnq);
	while($rowEnq=mysqli_fetch_array($resultEnq))
	{
		 $i = $i + 1;
	?>
					
                      <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo $rowEnq["Franc"]; ?></td>
                        <td><?php echo $rowEnq["Dist"]; ?></td>
                        
                        <td><?php echo $rowEnq["Allo_Orders"]; $TAllo_Orders=$TAllo_Orders+$rowEnq["Allo_Orders"]; ?></td>
                        
                         <td><?php echo $rowEnq["Allo_Value"]; $TAllo_Value=$TAllo_Value+$rowEnq["Allo_Value"]; ?></td>
                                                  
                         <td><?php echo $rowEnq["Acc_Orders"]; $TAcc_Orders=$TAcc_Orders+$rowEnq["Acc_Orders"]; ?></td>
                        
                         <td><?php echo $rowEnq["Acc_Value"]; $TAcc_Value=$TAcc_Value+$rowEnq["Acc_Value"]; ?></td>
                        
                         <td><?php echo $rowEnq["Rej_Orders"]; $TRej_Orders=$TRej_Orders+$rowEnq["Rej_Orders"]; ?></td>
                        
                         <td><?php echo $rowEnq["Rej_Value"]; $TRej_Value=$TRej_Value+$rowEnq["Rej_Value"]; ?></td>
                        
                         <td><?php echo $rowEnq["Pen_Orders"]; $TPen_Orders=$TPen_Orders+$rowEnq["Pen_Orders"]; ?></td>
                        
                         <td><?php echo $rowEnq["Pen_Value"]; $TPen_Value=$TPen_Value+$rowEnq["Pen_Value"]; ?></td>
                      </tr>
                     <?php
					 $n++;
					}
					?>
                    </tbody>
                    <tfoot>
      
					
                      <tr>
                        <td colspan="3"><center><span style="color:#F00; font-weight:bold;">TOTAL</span></center></td>
  
                        <td><span style="color:#F00; font-weight:bold;"><?php echo $TAllo_Orders; ?></span></td>
                       
                        <td><span style="color:#F00; font-weight:bold;"><?php $TAllo_Value; ?></span></td>
                        
                       <td><span style="color:#F00; font-weight:bold;"><?php echo $TAcc_Orders; ?></span></td>
                       
                        <td><span style="color:#F00; font-weight:bold;"><?php echo $TAcc_Value; ?></span></td>
                        
                         <td><span style="color:#F00; font-weight:bold;"><?php echo $TRej_Orders; ?></span></td>
                       
                        <td><span style="color:#F00; font-weight:bold;"><?php echo $TRej_Value; ?></span></td>
                        
                        <td><span style="color:#F00; font-weight:bold;"><?php echo $TPen_Orders; ?></span></td>
                       
                        <td><span style="color:#F00; font-weight:bold;"><?php echo $TPen_Value; ?></span></td>
                      </tr>
                     
                    
                      <tr>
                      <th>#</th>
                     <th> Agent</th>
                     <th> District</th>
                     
                     <th>Allotted</th>
                     	<th> Value</th>
                        
                     	<th>Accepted</th>
                     	<th>Value</th>
                     	<th>Rejected</th>
                     	<th>Value</th>
                     
                        <th>Total</th>
                     	<th> Value</th>
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