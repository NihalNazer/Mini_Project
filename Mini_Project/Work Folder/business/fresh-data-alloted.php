<?php include("../config/conn.php"); ?>
<?php
//validation for admin page;
if(!isset($_SESSION['homsuser']) || !isset($_SESSION['homsutype']) ||($_SESSION['homsutype']!=5))
{
	echo"<script type=\"text/javascript\">
 window.location.assign(\"../login\")
</script>";	
}
else
{
	/*require_once("../class/user.php");
   	$userclass=new users();
   	$userclass->user=$_SESSION['homsuser'];
	$userclass->userinfo();*/
	$user=$_SESSION['homsuser'];
?>
<?php include("../template.inc.php"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

  
   <?php  head_part_home(); ?>
   
   
  <body class="skin-black">
    <div class="wrapper">

     	<?php top($con); ?>
		<?php biz_nav($con); ?>
  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Asst. Business Dev. Head
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <!--<li><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
            <li class="active"><i class="fa fa-sitemap"></i> Alloted Data</li>
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
                  <h3 class="box-title">Alloted Data (Fresh)</h3>
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
			   if(isset($_POST['types']))
			   {
			   $types=$_POST['types'];
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
                   <input name="txttDate" type="date" class="form-control"  value="<?php echo @$tdate?>"/>
                  </div>
                  </div>
                    
                <div class="col-xs-3">
                	 <div class="form-group">
                     <div class="input-group input-group-sm">
                    
                   <select name="types" class="form-control" >
                   <?php if(@$types!=''){?>
                   <option value="<?php echo $types; ?>"><?php echo $types; ?></option>
                   <?php
				   }
				   ?>
                   
                   	<option value="">All</option>
                    <option value="Open">Open</option>
                     <option value="Just">Just</option>
                     <option value="Closed">Closed</option>
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
if(isset($_POST['search']) && ($_POST['txtfDate']!='')&& ($_POST['txttDate']!=''))
{
	$fdate=$_POST['txtfDate'];
	$tdate=$_POST['txttDate'];
	$types=$_POST['types'];
	?>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      <th>#</th>
                      <th>Ref_Id</th>
                      	 <th> Contact Number</th>
                        <th>Date & Time</th>
                        <th>Data Source</th>
                        <th>Alloted On</th>
                        <th>BPE</th>
                        <th>Last Response</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
	  $i = 0;
	  if($types=="Open")
	  {
		  $filter=" AND a.flag=1 ";
	  }
	  elseif($types=="Just")
	  {
		   $filter=" AND a.flag=0 ";
	  }
	  elseif($types=="Closed")
	  {
		   $filter=" AND a.flag=2 ";
	  }
	  else
	  {
		   $filter=" ";
	  }
	  
	$selectEnq="SELECT a.*, b.*, c.Name FROM  `enquiry` a, `number_config` b, `user` c WHERE a.lnode= b.ncid AND a.`userid`!=0  AND (a.adate>='$fdate' AND a.adate<='$tdate') AND a.userid=c.Uid AND a.fresh=1 AND a.status=1".$filter;
	$resultEnq=mysqli_query($con, $selectEnq);
	while($rowEnq=mysqli_fetch_array($resultEnq))
	{
		 $i = $i + 1;
	?>
					
                      <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo $rowEnq["sid"]; ?></td>
                        <td><?php echo $rowEnq["vnum"]; ?></td>
                        <td><?php echo $rowEnq["vctime"]; ?></td>
                        <td><?php echo $rowEnq["ncfor"]; ?></td>
                        <td><?php echo $rowEnq["adate"]." ".$rowEnq["atime"]; ?></td>
                        <td>
                        <?php echo $rowEnq["Name"]; ?>
						</td>
                        <td>
                         <?php
						 	$enq=$rowEnq["eid"];
						 $selectResponse="select b.name from  `response` a, `response_category` b where a.`Enquiry_id`='$enq' and b.rtid=a.rtype and a.rstatus=1 order by a.`rid` DESC limit 0,1";
						  $resultResponse=mysqli_query($con, $selectResponse);
						  $rowResponse=mysqli_fetch_array($resultResponse);
						  echo $rowResponse["name"];
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
                      <th>Ref_Id</th>
                      	 <th> Contact Number</th>
                        <th>Date & Time</th>
                        <th>Data Source</th>
                        <th>Alloted On</th>
                        <th>BPE</th>
                        <th>Last Response</th>
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