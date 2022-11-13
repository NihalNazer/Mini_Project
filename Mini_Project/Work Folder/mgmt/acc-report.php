<?php include("../config/conn.php"); ?>
<?php
//validation for admin page;
if(!isset($_SESSION['homsuser']) || !isset($_SESSION['homsutype']) ||($_SESSION['homsutype']!=12))
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
    <?php mgmt_nav($con); ?>
  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Management
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <!--<li><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
            <li class="active"><i class="fa fa-inr"></i> Trasactions Report</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         
          <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> Account Trasactions Report</h3>
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
                    <label>Starting Date</label>
          <input name="txtfDate" type="date" class="form-control"  value="<?php echo @$fdate?>"/>

                  </div>
                  </div>
                                  
                  <div class="col-xs-3">
                   <div class="form-group">
                    <label>Ending Date</label>
                  <input name="txttDate" type="date" class="form-control"  value="<?php echo @$tdate?>"/>
                  </div>
                  </div>


                  <div class="col-xs-3">
                   <div class="form-group">
                     <label>Select Agent to Filter</label>
          <select name="tme"  class="form-control" >
                   <option value="">All Agents</option>
                   <?php
if(isset($tme))
{ 
$selectTme="SELECT Uid, Name FROM  `user` WHERE `Uid`='$tme' AND  `Status`=1 AND `Categoryid`='8' ORDER BY Name ASC";
$resultTme=mysqli_query($con, $selectTme);
while($rowTme=mysqli_fetch_array($resultTme))
{
?>
<option selected value="<?php echo $rowTme["Uid"]; ?>"><?php echo $rowTme["Name"]; ?></option>
<?php
}
}
?>

<?php 
$selectTme="SELECT Uid, Name FROM  `user` WHERE  `Status`=1 AND `Categoryid`='8' ORDER BY Name ASC";
$resultTme=mysqli_query($con, $selectTme);
while($rowTme=mysqli_fetch_array($resultTme))
{
?>
<option value="<?php echo $rowTme["Uid"]; ?>"><?php echo $rowTme["Name"]; ?></option>
<?php
}
?>
                   </select>
                  </div>
                  </div>

                   
                    
                <div class="col-xs-3">
                	 <div class="form-group">
                    <label>Select Transaction Type to Filter</label>
                     <div class="input-group input-group-sm">
                    
                   <select name="tra"  class="form-control" >
                   <option value="">All</option>
                   <?php
if(isset($tra))
{ 
$selectTme="SELECT * FROM  `inventype` WHERE `IT_id`='$tra' AND `IT_id`='99' AND  `IT_Flag`=1 ORDER BY IT_id ASC";
$resultTme=mysqli_query($con, $selectTme);
while($rowTme=mysqli_fetch_array($resultTme))
{
?>
<option selected value="<?php echo $rowTme["IT_id"]; ?>"><?php echo $rowTme["IT_name"]; ?></option>
<?php
}
}
?>

<?php 
$selectTme="SELECT * FROM  `inventype` WHERE `IT_Flag`=1 AND `IT_id`='99' ORDER BY IT_id ASC";
$resultTme=mysqli_query($con, $selectTme);
while($rowTme=mysqli_fetch_array($resultTme))
{
?>
<option value="<?php echo $rowTme["IT_id"]; ?>"><?php echo $rowTme["IT_name"]; ?></option>
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
if(isset($_POST['search']) && ($_POST['txtfDate']!='')&& ($_POST['txttDate']!=''))
{
	$fdate=$_POST['txtfDate'];
	$tdate=$_POST['txttDate'];
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
                      <th>Date</th>
                      <th>Reference</th>
                   	 <th> Transaction</th>
                     	 <th> Agent</th>
                        <th> Date of Entry</th>
                        <th> Time of Entry</th>
                     	<th> Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
	  $i = 0;
    $tq=0;
    $tmt=0;
    $color="#000";
	  
	  $ti="TI";
	  
	  if($tme!='')
	{
	$stme=" u.`Uid`='$tme' AND ";
	}
	else
	{
	$stme=" ";
	}
  if($tra!='')
  {
  $stra=" i.`IT_id`='$tra' AND ";
  }
  else
  {
  $stra=" ";
  }
	 $selectEnq="SELECT a.En_ref, a.En_rcvbl, a.En_TDate, a.En_date, a.En_time, u.Name, i.IT_name , i.IT_id FROM  `inventry` a, `inventype` i, `user` u WHERE".$stme.$stra." a.En_type= i.IT_id  AND i.`IT_id`='99' AND a.En_wh = u.Uid AND (a.En_TDate>='$fdate' AND a.En_TDate<='$tdate') AND a.En_stat=1 ORDER BY En_TDate ASC, En_ref ASC, En_id ASC";
	  
	  //$selectEnqGift="SELECT b.Ccode AS Item_Code, b.Citem AS Item, COUNT(b.Ccode) AS Orders, SUM(b.Gtotal) AS Value FROM  `order` a, `order_split`  b WHERE a.oid= b.Orderid  AND (a.date>='$fdate' AND a.date<='$tdate') AND b.Gtotal=0  AND b.Status=1 GROUP BY b.Ccode ORDER BY b.Ccode ASC";
	  
	$resultEnq=mysqli_query($con, $selectEnq);
	while($rowEnq=mysqli_fetch_array($resultEnq))
	{
		 $i = $i + 1;

if($rowEnq["IT_id"]!="98")
{
$tmt=$tmt+$rowEnq["En_rcvbl"];
$color="#000";
}
else
{
$tmt=$tmt-$rowEnq["En_rcvbl"];
$color="#f00";
}
 ?>
					
                      <tr style="color:<?php echo $color; ?>;">
                        <td><?php echo $n; ?></td>
                        <td><?php echo $rowEnq["En_TDate"]; ?></td>
                        <td><?php echo $rowEnq["En_ref"]; ?></td>
                        <td><?php echo $rowEnq["IT_name"]; ?></td>
                        <td><?php echo $rowEnq["Name"]; ?></td>
                        <td><?php echo $rowEnq["En_date"]; ?></td>
                        <td><?php echo $rowEnq["En_time"]; ?></td>
                        <td><?php echo $rowEnq["En_rcvbl"]; ?></td>
                      </tr>
                     <?php
					 $n++;
					}
					?>
                    </tbody>
                    <tfoot>
                    
                      <tr>
                        <td colspan="7"><center><span style="color:#7F00FF; font-weight:bold;">TOTAL</span></center></td>
                        <td><span style="color:#7F00FF; font-weight:bold;"><?php echo $tmt; ?></span></td>
                      </tr>
                     
                      <tr>
                     <th>#</th>
                      <th>Date</th>
                      <th>Reference</th>
                     <th> Transaction</th>
                       <th> Agent</th>
                        <th> Date of Entry</th>
                        <th> Time of Entry</th>
                      <th> Amount</th>
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