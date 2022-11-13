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
            <li class="active"><i class="fa fa-inr"></i> Account Summary</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         
          <div class="row">
             
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> Account Summary</h3>
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

                     <div class="input-group input-group-sm">
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
  if($tme!='')
  {
  $stme=" b.Uid='$tme' AND ";
  $baltme=" a.Uid='$tme' AND ";
  }
  else
  {
  $stme=" ";
  $baltme=" ";
  }
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
                      <th>Particulars</th>
                      <th>Amount</th>
                      <th>View</th>
                   	 </tr>
                    </thead>
                    <tbody>
                     <tr style="color:#000;">
                        <td>1</td>
                        <td>Gross Advance from Sales</td>
                        <td> Rs
<?php 
$resultSales=mysqli_query($con, "select SUM(a.En_rcvbl) as amount from `inventry` a, `user` b  where a.En_wh=b.Uid and ".$stme."`En_type`=2 and `En_TDate`>='$fdate' and `En_TDate`<='$tdate' and `En_stat`=1");
$rowSales=mysqli_fetch_array($resultSales);
if($rowSales["amount"]!=0){$salesAmount= $rowSales["amount"];} else { $salesAmount=0; }
echo $salesAmount;
?>
                        </td>
                        <td>
                          <form action="trans-report.php" method="post" target="_blank">
                  <input name="txtfDate" type="hidden" value="<?php echo @$fdate?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo @$tdate?>"/>
                  <input name="tme" type="hidden" value="<?php echo @$tme?>"/>
                  <input name="tra" type="hidden" value="2"/>
                  <button type="submit" name="search"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> View  </button>
                  </form> 
                        </td>
                      </tr>

                      <tr style="color:#000;">
                        <td>2</td>
                        <td><i>less</i> Advance from Return</td>
                        <td>(Rs 
                          <?php 
$resultRet=mysqli_query($con, "select SUM(a.En_rcvbl) as amount from `inventry` a, `user` b  where a.En_wh=b.Uid and ".$stme."`En_type`=3 and `En_TDate`>='$fdate' and `En_TDate`<='$tdate' and `En_stat`=1");
$rowRet=mysqli_fetch_array($resultRet);
if($rowRet["amount"]!=0){$salesRet= $rowRet["amount"];} else { $salesRet=0; }
echo $salesRet;
?> )</td>
<td>
   <form action="trans-report.php" method="post" target="_blank">
                  <input name="txtfDate" type="hidden" value="<?php echo @$fdate?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo @$tdate?>"/>
                  <input name="tme" type="hidden" value="<?php echo @$tme?>"/>
                  <input name="tra" type="hidden" value="3"/>
                  <button type="submit" name="search"  class="btn btn-danger btn-xs"><i class="fa fa-eye"></i> View  </button>
                  </form> 
</td>
                      </tr>
                      <tr style="ccolor:#000;">
                        <td>3</td>
                        <td><b>Net Advance from Sales</b></td>
                        <td><b>Rs <?php echo $gSales=$salesAmount-$salesRet;?></b></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr style="ccolor:#000;">
                        <td>4</td>
                        <td><i>Add</i> Balance from Delivery</td>
                        <td>Rs 
<?php 
$resultDel=mysqli_query($con, "select SUM(a.En_rcvbl) as amount from `inventry` a, `user` b  where a.En_wh=b.Uid and ".$stme." `En_type`=4 and `En_TDate`>='$fdate' and `En_TDate`<='$tdate' and `En_stat`=1");
$rowDel=mysqli_fetch_array($resultDel);
if($rowDel["amount"]!=0){$salesDel= $rowDel["amount"];} else { $salesDel=0; }
echo $salesDel;
?>
                        </td>
                        <td>
                           <form action="trans-report.php" method="post" target="_blank">
                  <input name="txtfDate" type="hidden" value="<?php echo @$fdate?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo @$tdate?>"/>
                  <input name="tme" type="hidden" value="<?php echo @$tme?>"/>
                  <input name="tra" type="hidden" value="4"/>
                  <button type="submit" name="search"  class="btn btn-info btn-xs"><i class="fa fa-eye"></i> View  </button>
                  </form> 
                        </td>
                      </tr>
                      <tr style="ccolor:#000;">
                        <td>5</td>
                        <td><b>Gross Amount Payable</b></td>
                        <td><b>Rs <?php echo $gpay=$gSales+$salesDel; ?></b></td>
                        <td>&nbsp;</td>
                      </tr>

                       <tr style="color:#000;">
                        <td>6</td>
                        <td><i>less</i> Payments</td>
                        <td>(Rs 
<?php 
$resultPay=mysqli_query($con, "select SUM(a.En_rcvbl) as amount from `inventry` a, `user` b  where a.En_wh=b.Uid and ".$stme." `En_type`=99 and `En_TDate`>='$fdate' and `En_TDate`<='$tdate' and `En_stat`=1");
$rowPay=mysqli_fetch_array($resultPay);
if($rowPay["amount"]!=0){$salesPay= $rowPay["amount"];} else { $salesPay=0; }
echo $salesPay;
?>
                        )</td>
                        <td>
                           <form action="acc-report.php" method="post" target="_blank">
                  <input name="txtfDate" type="hidden" value="<?php echo @$fdate?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo @$tdate?>"/>
                  <input name="tme" type="hidden" value="<?php echo @$tme?>"/>
                  <input name="tra" type="hidden" value="99"/>
                  <button type="submit" name="search"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> View  </button>
                  </form> 
                        </td>
                      </tr>
                     <tr style="ccolor:#000;">
                        <td>7</td>
                        <td><b>Net Amount Payable</b></td>
                        <td><b>Rs <?php echo $nPay=$gpay-$salesPay; ?></b></td>

                        <td>&nbsp;</td>
                      </tr>

                    </tbody>
                    <tfoot>
                    
                      <tr>
                        <td colspan="2"><center><span style="color:#7F00FF; font-weight:bold;">Current Account Balance as per record </span></center></td>
                        <td><span style="color:#7F00FF; font-weight:bold;">Rs
<?php 
$resultCur=mysqli_query($con, "select SUM(a.balance) as amount from `user` a where ".$baltme." a.Status=1");
$rowCur=mysqli_fetch_array($resultCur);
if($rowCur["amount"]!=0){$salesCur= $rowCur["amount"];} else { $salesCur=0; }
echo $salesCur;
?>
                        </span></td>
                      </tr>
                     <td>&nbsp;</td>
                     
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