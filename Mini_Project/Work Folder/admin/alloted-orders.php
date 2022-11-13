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
            <li class="active"><i class="fa fa-paperclip"></i> Alloted Orders</li>
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
                  <h3 class="box-title">Alloted Orders</h3>
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
                     <th> Status</th>
                     
                     <th> Orders</th>
                     
                      <th> Value</th>
                     
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($tme!='')
  {
  $stme=" d.`Did`='$tme' AND ";
  }
  else
  {
  $stme=" ";
  }
          $n=1;
$ono=$ovalues=0;
    $i = 0;
    
    $ti="TI";
  
  $selectEnq="Select count(a.oid) as 'Nos',  SUM(a.gtotal) as 'values', os.OsName FROM  `order` a, `user` b, `order_status` os, `district` d WHERE a.oallotment=b.Uid and ".$stme." d.agent=b.Uid and os.OsId=a.oFlag and a.status=1 AND a.tqty!=0 AND (a.date>='$fdate' AND a.date<='$tdate') GROUP BY a.oFlag  HAVING (Nos>=1) ORDER BY 'values' DESC ";
  
  $resultEnq=mysqli_query($con, $selectEnq);
  while($rowEnq=mysqli_fetch_array($resultEnq))
  {
     $i = $i + 1;
  ?>
          
                      <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo $rowEnq["OsName"]; ?></td>
                        <td><?php echo $rowEnq["Nos"]; $ono=$ono+$rowEnq["Nos"]; ?></td>
                        <td><?php echo $rowEnq["values"]; $ovalues=$ovalues+$rowEnq["values"]; ?></td>
                      </tr>
                     <?php
           $n++;
          }
          ?>
                    </tbody>
                    <tfoot>
      
          
                      <tr>
                        <td colspan="2"><center><span style="color:#F00; font-weight:bold;">TOTAL</span></center></td>
                        <td><center><span style="color:#F00; font-weight:bold;"><?php echo $ono; ?></span></center></td>
                        <td><center><span style="color:#F00; font-weight:bold;"><?php echo $ovalues; ?></span></center></td>
  
  
                       <td><?php echo $rowEnq["Nos"]; ?></td>
                        <td><?php echo $rowEnq["values"]; ?></td>
                      </tr>
                     
                    
                      <tr>
                      <th>#</th>
                     <th> Status</th>
                     
                     <th> Orders</th>
                     
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