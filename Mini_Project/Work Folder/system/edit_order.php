<?php include("../config/conn.php"); ?>
<?php
//validation for admin page;
if(!isset($_SESSION['homsuser']) || !isset($_SESSION['homsutype']) ||($_SESSION['homsutype']!=4))
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
    <?php system_nav($con); ?>
  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            System Admin
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <!--<li><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
            <li class="active"><i class="fa fa-shopping-cart"></i> Order Search for Edit</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
         <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Order Search for Edit</h3>
                </div><!-- /.box-header -->
               <?php
			   if(isset($_POST['txtFromDate']))
			   {
			   $fdate=$_POST['txtFromDate'];
			   }
			   if(isset($_POST['txtToDate']))
			   {
			   $tdate=$_POST['txtToDate'];
			   }
			   if(isset($_POST['txtSearch']))
			   {
			   $svalue=$_POST['txtSearch'];
			   }
			   ?> 
            
            <div class="box-body">
                <form method="POST" action="">
                 <div class="col-xs-12">
                 
                  <div class="col-xs-5">
                   <div class="form-group">
                   
                  <input  id="searchVal"  name="txtSearch" type="text" class="form-control"  value="<?php echo @$svalue?>"  placeholder="Search Here..."/>
                  </div>
                  </div>
                 
                  <div class="col-xs-3">
                   <div class="form-group">
                     <input name="txtFromDate"  id="searchFrom" type="date" class="form-control"  value="<?php echo @$fdate?>"  placeholder="From Date"/>
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
                    
              
                    <input name="txtToDate" type="date" class="form-control"  value="<?php echo @$tdate?>"  id="searchTo"   placeholder="To Date"/>
                   
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
			
 $searchValue=$_POST["txtSearch"];
 $searchFromDate=$_POST["txtFromDate"];
 $searchToDate=$_POST["txtToDate"];
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
                            
                            
                         </div>   
<br/> <hr/> <br/>

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                     <th>#</th>
                     <th> District</th>
                   	 <th> Order</th>
                     <th> Date</th>
                     <th> Customer</th>
                     <th> Contact</th>
                     <th> Qty</th>
                     <th> Value</th>
                     <th> TME</th>
                     <th> Status</th>
                     <th> Action</th>                    
                      </tr>
                    </thead>
                    <tbody>
                    <?php
          $n=1;
    $i = 0;
  $selectBase="select a.oid, a.eid, a.invtype, c.District, a.date, b.customerid, b.name, b.contactNum1, a.tqty, a.gtotal, u.Name, g.OsName, a.oFlag from `order` a, `customer` b, `district` c, `pin` e,  `order_status` g, `user` u where a.customerid=b.customerid and  b.districtid=c.Did and b.post=e.Pid and u.Uid=a.tme and g.OsId=a.oFlag and a.`status`='1' ";

  if($searchValue!='')
  {
  $selectSearch="AND (a.`oid`='$searchValue' or a.`ref`='$searchValue' or  a.`Barcode`='$searchValue' or b.`name` like '%$searchValue%' or b.`housename` like '%$searchValue%' or  b.`place` like '%$searchValue%' or b.`pin`='$searchValue' or b.`landmark` like '%$searchValue%' or b.`contactNum1` LIKE '$searchValue' or b.`contactNum2` LIKE '$searchValue' or b.`Email` like '%$searchValue%' or b.`Remark` like '%$searchValue%' or c.`District` like '%$searchValue%' or e.`Officename` like '%$searchValue%')";  
  }
  else
  {
  $selectSearch='';
  } 
  if($searchFromDate!='')
  {
  $selectFrom=" AND (a.`date`>='$searchFromDate')";
  
  }
  else
  {
  $selectFrom='';
  }
    
  if($searchToDate!='')
  {
  $selectTo=" AND (a.`date`<='$searchToDate')";
  }
  else
  {
  $selectTo='';
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
                        <td><?php echo $row["District"]; ?></td>
                        <td><?php echo "#".$row["oid"]; ?></td>
                         <td><?php echo $row["date"]; ?></td>
                         <td><?php echo $row["name"]; ?></td>
                         <td>
                          <?php if($row["oFlag"]==2)
                          { ?>
                           <form action="customers.php" method="post">
                           <input type="hidden" name="hid" value="<?php echo $row["customerid"]; ?>" /> 
                           <input type="hidden" name="refid" value="<?php echo $row["eid"]; ?>" />
                  <button type="submit" name="btnRef"  class="btn btn-xs"><i class="fa fa-user"></i> <?php echo $row["contactNum1"]; ?></button>
                 </form>  
                  
                   <?php
          }
          else
          {
           echo $row["contactNum1"];  } ?>  
                          </td>
                         <td><?php echo $row["tqty"]; ?></td>
                         <td><?php echo $row["gtotal"]; ?></td>
                         <td><?php echo $row["Name"]; ?></td>
                         <td><?php echo $row["OsName"]; ?></td>
                         <td>
                         <?php if($row["oFlag"]==2){ ?>
                           <form action="<?php if($row["invtype"]!=2){ echo "order.php";} else{echo "bulk-order.php";}?>" method="post">
                           <input type="hidden" name="refid" value="<?php echo $row["eid"]; ?>" /> 
                  <button type="submit" name="btnRef"  class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button>
                 </form>  
                  
                   <?php
				  }
				  else
				  {
					?>
                    
                  <form action="invoice.php" method="post">
                  <input type="hidden" name="refid" value="<?php echo $row["eid"]; ?>" /> 
                  <button type="submit" name="btnShow"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> View</button>
                  </form>    
                     <?php
				  }
				  ?>  
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
                     <th> District</th>
                   	 <th> Order</th>
                     <th> Date</th>
                     <th> Customer</th>
                     <th> Contact</th>
                     <th> Qty</th>
                     <th> Value</th>
                     <th> TME</th>
                     <th> Status</th>
                     <th> Action</th> 
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