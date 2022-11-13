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
            <li class="active"><i class="fa fa-clock-o"></i> My Schedules</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         <div class="row">
            
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Scheduled Calls</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      <th>#</th>
                      <th>Ref_Id</th>
                      	 <th>Scheduled Date and Time</th>
                        <th> Number</th>
                        <th>Subject</th>
                        <th>Remarks</th>
                       <th>Make an Order</th>
                        <th>Follow</th>
                        <th>Drop</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
				$selectEnq="select a.*, b.* from `response` a, `enquiry` b where a.rstatus='1' AND b.userid='$user' and a.Enquiry_id=b.eid AND a.`FUDate`>='$CurrentDate' AND a.`FUDate`!='' and b.flag=1 and b.status=1 order by a.FUDate ASC, a.FUTime ASC";
					
	$resultEnq=mysqli_query($con, $selectEnq);
	while($rowEnq=mysqli_fetch_array($resultEnq))
					
					{
					?>
                      <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo $rowEnq["sid"]; ?></td>
                        <td><?php echo $rowEnq["FUDate"]." ".$rowEnq["FUTime"]; ?></td>
                        <td><?php
						if($rowEnq["fresh"]=='1')
						{
						?>
                        <small class="label bg-green">F</small>
                        <?php
						}
						else
						{
							?>
                        <small class="label bg-blue">S</small>
                        <?php
						}
						?>
                        <?php $agent_no=$rowEnq["vnum"]; $agent_mob=substr($agent_no,0,3)."-".substr($agent_no,3,3)."-".substr($agent_no,6,4) ?>
						<a style="color:#900; font-weight:bold;" href="tel:+91<?php echo $agent_mob; ?>" target="_blank">
                       
						<?php echo $agent_mob; ?>
                        </a>                        
                        </td>
                        <td><?php echo $rowEnq["FUTitle"]; ?></td>
                        <td>
                       <?php echo $rowEnq["remark"]; ?>
						</td>
                        
                         <td>
                         
                         <form action="customers.php" method="post">
                   <input type="hidden" name="refid" value="<?php echo $rowEnq["eid"]; ?>" /> 
                  <div class="input-group input-group">
                  <input type="number" name="pinc" size="6" class="form-control" placeholder="PIN" required min="670001" max="695615"/>
                  <span class="input-group-btn">
                  <button type="submit" name="btnRef"  class="btn btn-success"><i class="fa fa-shopping-cart"></i> Order </button>
                  </span>
                 </div>
                  </form>  
                  </td>
                        
                         <td>
						  <form action="manage_followups-new.php" method="post">
                  <input type="hidden" name="refid" value="<?php echo $rowEnq["eid"]; ?>" /> 
                  <button type="submit" name="btnRef"  class="btn btn-warning"><i class="fa fa-thumb-tack"></i> Follow</button></form>  
                  </td>
                  <td>
                  <form action="manage_followups-drop.php" method="post">
                  <input type="hidden" name="refid" value="<?php echo $rowEnq["eid"]; ?>" /> 
                  <button type="submit" name="btnRef"  class="btn btn-danger"><i class="fa fa-trash-o"></i> Drop</button></form>  
                         </td>
                      </tr>
                     <?php
					 $n++;
					}
					?>
                    </tbody>
                    <tfoot>
                      <tr>
                      <th>#</th>
                      <th>Ref_Id</th>
                      	 <th>Scheduled Date and Time</th>
                        <th>Number</th>
                        <th>Subject</th>
                        <th>Remarks</th>
                       <th>Make an Order</th>
                        <th>Follow</th>
                        <th>Drop</th>
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
          "bPaginate": true,
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