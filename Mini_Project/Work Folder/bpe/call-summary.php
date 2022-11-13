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
            <li class="active"><i class="fa fa-phone"></i> Call Summary</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
       <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Call Summary</h3>
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
                              	</li>
							</ul>
                            </div>
                            
                            <div class="btn-group">
                             <form method="post" action="call-summary-report.php">
                   <input type="hidden" value="<?php echo @$fdate; ?>" name="fdate">
                   <input type="hidden" value="<?php echo @$tdate; ?>" name="tdate">

                  <button type="submit" name="download"  class="btn btn-warning"><i class="fa  fa-download"></i> Download</button>
                   </form>
                   </div>
                            
                         </div>   
<br/> <hr/> <br/>

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      <th>#</th>
                   	 <th> Response Type</th>
                        <th> No of Calls</th>
                    
                      </tr>
					 </thead>
                     <tbody>
                    <?php
					$n=1;
	  $i = 0;
	$selectEnq="SELECT b.name AS Response, COUNT(a.rtype) AS Calls FROM  `response` a, `response_category`  b WHERE (a.rdate>='$fdate' AND a.rdate<='$tdate') AND a.`uid`='$user' AND  a.rtype= b.rtid  AND a.rstatus=1 GROUP BY a.rtype ORDER BY COUNT(a.rtype) DESC";
	
	$resultEnq=mysqli_query($con, $selectEnq);
	while($rowEnq=mysqli_fetch_array($resultEnq))
	{
		 $i = $i + 1;
	?>
					
                      <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo $rowEnq["Response"]; ?></td>
                        <td><?php echo $rowEnq["Calls"]; ?></td>
                      </tr>
                     <?php
					 $n++;
					}
					?>
                    
                     </tbody>
                    <tfoot>
                            
                        <?php
					
	$selectEnqT="SELECT COUNT(a.rtype) AS Calls FROM  `response` a, `response_category`  b WHERE a.`uid`='$user' AND  a.rtype= b.rtid  AND (a.rdate>='$fdate' AND a.rdate<='$tdate')  AND a.rstatus=1 ORDER BY b.rtid ASC";
	$resultEnqT=mysqli_query($con, $selectEnqT);
	while($rowEnqT=mysqli_fetch_array($resultEnqT))
	{
		
	?>
    
     
                     <tr>
                        <td colspan="2"><center><span style="color:#F00; font-weight:bold;">TOTAL</span></center></td>
                        <td><span style="color:#F00; font-weight:bold;"><?php echo $rowEnqT["Calls"]; ?></span></td>
                      </tr>
         <?php
	}
	?>            

                      <tr>
                      <th>#</th>
                      <th> Response Type</th>
                        <th> No of Calls</th>
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
          "bAutoWidth": false,
        });
      });
    </script>
  </body>
</html>
<?php
}
?>