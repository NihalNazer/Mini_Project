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
            <li class="active"><i class="fa fa-shopping-cart"></i> Order by Campaigns</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
         <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Order by Campaigns</h3>
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
         if(isset($_POST['txtPro']))
         {
         $pro=$_POST['txtPro'];
         }
         ?> 
            
            <div class="box-body">
                <form method="POST" action="">
                 <div class="col-xs-12">
                 
                  <div class="col-xs-5">
                   <div class="form-group">
                   <select name="txtPro"  class="form-control" >
                   <option value="">All</option>
                   <?php
if(isset($pro))
{ 
$selectTme="SELECT * FROM  `number_config` WHERE `ncid`='$pro' AND  `ncstatus`=1 ORDER BY ncflag ASC, ncfor ASC";
$resultTme=mysqli_query($con, $selectTme);
while($rowTme=mysqli_fetch_array($resultTme))
{
?>
<option selected value="<?php echo $rowTme["ncid"]; ?>"><?php echo $rowTme["ncfor"]; ?></option>
<?php
}
}
?>

<?php 
$selectTme="SELECT * FROM  `number_config` WHERE `ncstatus`=1 ORDER BY ncflag ASC, ncfor ASC";
$resultTme=mysqli_query($con, $selectTme);
while($rowTme=mysqli_fetch_array($resultTme))
{
?>
<option value="<?php echo $rowTme["ncid"]; ?>"><?php echo $rowTme["ncfor"]; ?></option>
<?php
}
?>
                   </select>
                  </div>
                  </div>
                 
                  <div class="col-xs-3">
                   <div class="form-group">
                     <input name="txtfDate" type="date" class="form-control"  value="<?php echo @$fdate; ?>"/>  
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
                    <input name="txttDate" type="date" class="form-control"  value="<?php echo @$tdate; ?>"/>
                   <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" name="btnSearch" type="subit">Search</button>
                    </span>
                  
                  </div>
                  </div>
                  </div>    
            </form>
                        
            
        </div>
        <br/> <hr/> <br/>
                
                <?php
if(isset($_POST["btnSearch"]))
{
  $fdate=$_POST['txtfDate'];
  $tdate=$_POST['txttDate'];
  $pro=$_POST['txtPro'];
?>

            <div class="col-xs-12">
             <div class="btn-group">
 
              <button class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars"></i> Export Table Data
                            </button>
                            
                            
              <ul class="dropdown-menu" role="menu">
                            
                            <li>
                                <a href="#" onclick="$('#example1').tableExport({type:'excel',escape:'false',ignoreColumn: [10],tableName:'OrderTable'});"> 
                                <img src="../table_export/images/xls.png" width="24px"> XLS
                                </a>
                                </li>                               
  
              </ul>
                            </div>
                            
                           <!-- <div class="btn-group">
                            <form method="post" action="order_search_report.php">
                    <input type="hidden" value="<?php echo @$svalue; ?>" name="tSearch">
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
                      <th> Order</th>
                      <th> Lead Date</th>
                     <th> DIST</th>                     
                     <th> Taluk</th>
                     <th> Phone Number</th>
                     <th> Campaign</th>
                     <th> Product</th>
                     <th> Qty</th>
                     <th> Value</th>
                     <th> Status</th>               
                      </tr>
                    </thead>
                    <tbody>
                    <?php
          $n=1;
    $i = 0;
  
  $selectBase="select os.Citem, os.Uprice, os.Qty, os.Gtotal, os.Remark, a.oid, a.eid, c.short, a.date, b.name,  a.tqty, a.gtotal, g.OsName, t.Taluk, n.ncfor, m.vnum, m.vctime from `order` a, `customer` b, `district` c, `pin` e,  `order_status` g, `order_split` os, `taluk` t, `enquiry` m, `number_config` n  where  n.ncid=m.lnode and m.eid=a.eid and a.customerid=b.customerid and  b.districtid=c.Did and t.Tid=e.Taluk and b.post=e.Pid and os.Orderid=a.oid and (a.oFlag>='2') and g.OsId=a.oFlag and a.`status`='1' ";
  if($fdate!='')
  {
  $selectFrom=" AND (m.`adate`>='$fdate')";
  }
  else
  {
  $selectFrom='';
  }
    
  if($tdate!='')
  {
  $selectTo=" AND (m.`adate`<='$tdate')";
  }
  else
  {
  $selectTo='';
  }  
  if($pro!='')
  {
  $selectSearch=" AND (n.`ncid`='$pro')";
  }
  else
  {
  $selectSearch='';
  }  
  //echo $selectBase.$selectSearch.$selectFrom.$selectTo;
  $resultSearch=mysqli_query($con, $selectBase.$selectSearch.$selectFrom.$selectTo);
  //echo $resultSearch;
  if(mysqli_num_rows($resultSearch)>=1)
  {
    while($row=mysqli_fetch_array($resultSearch))
    {
     $i = $i + 1;
  ?>
          
                      <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo $row["oid"]; ?></td>
                         <td><?php echo $row["vctime"]; ?></td>
                         <td><?php echo $row["short"]; ?></td>
                         <td><?php echo $row["Taluk"]; ?></td>
                         <td><?php echo $row["vnum"]; ?> </td>
                         <td><?php echo $row["ncfor"]; ?></td>
                        <td><?php echo $row["Citem"]; ?></td>                         
                         <td><?php if($row["Qty"]==$row["tqty"] ){ echo $row["Qty"];} else {echo $row["Qty"]."(".$row["tqty"].")"; } ?></td>
                         <td><?php echo $row["Gtotal"]; ?></td>
                         <td>
                           <?php echo $row["OsName"]; ?> 
                         </td>
                         
                         
                      </tr>
                     <?php
           $n++;
          }
  }
          ?>
                    </tbody>
                    <tfoot>
                      <tr>
                      <th>#</th>
                     <th> Order</th>
                      <th> Lead Date</th>
                     <th> DIST</th>                     
                     <th> Taluk</th>
                     <th> Phone Number</th>
                     <th> Campaign</th>
                     <th> Product</th>
                     <th> Qty</th>
                     <th> Value</th>
                     <th> Status</th> 
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