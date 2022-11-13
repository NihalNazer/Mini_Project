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
            <li class="active"><i class="fa fa-question"></i> Follow-Up Search</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Your Page Content Here -->
         
          <div class="row">
            
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Follow-up Search</h3>
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
$selectTme="SELECT * FROM  `response_category` WHERE `rtid`='$tme' and `rtstatus`=1  and `rflag`=1 ORDER BY name ASC";
$resultTme=mysqli_query($con, $selectTme);
while($rowTme=mysqli_fetch_array($resultTme))
{
?>
<option selected value="<?php echo $rowTme["rtid"]; ?>"><?php echo $rowTme["name"]; ?></option>
<?php
}
}
?>

<?php 
$selectTme="SELECT * FROM  `response_category` WHERE `rtstatus`=1 and `rflag`=1 ORDER BY name ASC";
$resultTme=mysqli_query($con, $selectTme);
while($rowTme=mysqli_fetch_array($resultTme))
{
?>
<option value="<?php echo $rowTme["rtid"]; ?>"><?php echo $rowTme["name"]; ?></option>
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
if(isset($_POST['search']))
{
	if(($fdate=$_POST['txtfDate'])!='')
	{
		$fromDate=" AND (select r.rdate from  response r  where r.`Enquiry_id`=a. `eid`  and r.rstatus=1 order by r.`rid` DESC limit 0,1)>='$fdate' ";
	}
	else
	{
		$fromDate=" ";
	}
	if(($tdate=$_POST['txttDate'])!='')
	{
		$toDate=" AND (select r.rdate from  response r  where r.`Enquiry_id`=a. `eid`  and r.rstatus=1 order by r.`rid` DESC limit 0,1)<='$tdate' ";
	}
	else
	{
		$toDate=" ";
	}
	if(($tme=$_POST['tme'])!='')
	{
		$ResCat=" AND (select r.rtype from  response r  where r.`Enquiry_id`=a. `eid`  and r.rstatus=1 order by r.`rid` DESC limit 0,1)='$tme' ";
	}
	else
	{
		$ResCat=" ";
	}
	
	?>
                
                
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      <th>#</th>
                      <th>Ref_Id</th>
                      	 <th> Date</th>
                        <th> Number</th>
                        <th>Source</th>
                        <th>Remarks</th>
                        <th>Make an Order</th>
                        <th>Follow</th>
                        <th>Drop</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
					
					$selectEnq="SELECT a.*, b.*, c.Name, (select r.rtype from  response r  where r.`Enquiry_id`=a. `eid`  and r.rstatus=1 order by r.`rid` DESC limit 0,1) AS last_response FROM  `enquiry` a, `number_config` b, `user` c WHERE a.lnode= b.ncid AND a.`userid`!=0 AND a.userid=c.Uid  AND a.status=1  AND a.flag=1  AND a.userid='$user'".$ResCat.$fromDate.$toDate." ORDER BY a.eid  DESC ";
	$resultEnq=mysqli_query($con, $selectEnq);
	while($rowEnq=mysqli_fetch_array($resultEnq))
					
					{
					?>
                      <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo $rowEnq["sid"]; ?></td>
                        <td><?php echo $rowEnq["adate"]; ?></td>
                        <td><span style="color:#900; font-weight:bold;"><?php echo $rowEnq["vnum"]; ?></span></td>
                        
                        <td><?php echo $rowEnq["ncfor"]; ?></td>
                        <td>
                       <?php echo $rowEnq["ERemarks"]; ?>
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
                      	 <th> Date</th>
                        <th>Number</th>
                        <th>Source</th>
                        <th>Remarks</th>
                        <th>Make an Order</th>
                        <th>Follow</th>
                        <th>Drop</th>
                      </tr>
                    </tfoot>
                  </table>
    </div><!-- /.box-body -->
    <?php
}
?>
    
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