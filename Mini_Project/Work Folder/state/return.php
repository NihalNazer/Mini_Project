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
            State Co-Ordinator
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <!--<li><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Your Page Content Here -->
          
          
           <!-- =========================================================== -->

       
          <div class="row">
            
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Agents Return</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      <th>#</th>
                        <th>District</th>
                        <th>Agent</th>
                        <th>Phone</th>
                       <th>Status</th>
                       <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					
					
					$n=1;
					//$select="SELECT a.*, b.* from district a, user b where a.bdm=b.Uid and a.Status=1 order by a.District ASC";
					$select="select user.Name, user.Status as Statuss, user.Uid, user.Email, user.Phone, district.*  from user left outer join district on district.Did = user.Dist where user.Categoryid='8' order by user.Name ASC ";
					//echo $select;
					$result=mysqli_query($con, $select);
					while($row=mysqli_fetch_array($result))
					{
					?>
                      <tr>
                      <td><?php echo $n; ?></td>
                        <td><?php echo $row["District"]; ?></td>
                        <td><?php if ($row["Name"]==NULL){ echo "Not Alloted";} else {echo $row["Name"];} ?></td>
                         <td><?php if ($row["Phone"]==NULL){ echo "N/A";} else {echo $row["Phone"];} ?></td>
                         
                          <td>
                          <span class="label label-<?php
						$lflag= $row["Statuss"];
						if($lflag==0){ echo "danger";}
						elseif($lflag==1){ echo "success";}
						//else{ echo "warning";}
						else{ echo "default";}
						?>">
                        <?php
						if($lflag==1)
						{
						?>						
						<i class="fa fa-thumbs-o-up"></i> Active
                        <?php
						}
						else
						{
						?>
                        <i class="fa fa-thumbs-o-down"></i> Not Active
                        <?php
						}
						?>
                        </span>
                           </td>
                           <td>
                            <?php if($lflag==1) { ?>
                            <form method="post" action="return_entry.php">
                            <input type="hidden" name="refid" value="<?php echo $row["Uid"]; ?>">
                   <button type="submit" name="btnRef"  class="btn btn-default"><i class="fa fa-shopping-cart"></i> Return Entry</button>
                   </form>
                   <?php
							}
							?>
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
                        <th>District</th>
                        <th>Agent</th>
                        <th>Phone</th>
                        <th>Status</th>
                         <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                  
                   <div class="box-footer">
                   
                  
                  </div> 
                  
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