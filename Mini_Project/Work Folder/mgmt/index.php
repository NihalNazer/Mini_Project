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
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Your Page Content Here -->
          
          
           <!-- =========================================================== -->

          <div class="row">
          
          <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-green">
             
                <span class="info-box-icon"><i class="fa fa-phone"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Data Alloted</span>
                 
                  
                  <span class="info-box-number">
                   <?php
					$fday=date('Y-m-01');
				  $selectEnq="SELECT count(a.eid) as Ecount FROM  `enquiry` a, `number_config` b, `user` c WHERE a.lnode= b.ncid AND a.`userid`!=0  AND a.userid=c.Uid  AND a.status=1 AND a.`adate`>='$fday'";
	$resultEnq=mysqli_query($con, $selectEnq);
	while($rowEnq=mysqli_fetch_array($resultEnq))
	{
		echo $rowEnq["Ecount"];
	}
				?>
                  </span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                  </div>
                  <span class="progress-description"  style="cursor:pointer;" onClick="location.href='campaign-summary.php'" >
                   Click here to go &raquo;
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-aqua">
             
                <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Orders</span>
                  <span class="info-box-number">
                   <?php
				  $fday=date('Y-m-01');
				  $selectOrdr="select count(a.oid) as Ocount from `order` a, `customer` b, `district` c,  `pin` e,  `order_status` g, `user` u where a.customerid=b.customerid and  b.districtid=c.Did and b.post=e.Pid and u.Uid=a.tme and g.OsId=a.oFlag and a.`status`='1' and a.tqty!=0 AND a.date>='$fday' ";
	$resultOrdr=mysqli_query($con, $selectOrdr);
while($rowOrdr=mysqli_fetch_array($resultOrdr))
{
	echo $rowOrdr["Ocount"];
}?>
                  </span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                  </div>
                  <span class="progress-description" style="cursor:pointer;" onClick="location.href='order_search.php'" >
                    Click here to go &raquo;
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <div class="col-md-3 col-sm-6 col-xs-12">
             
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-smile-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Customers</span>
                  <span class="info-box-number">
                  <?php
				 $fday=date('Y-m-01');
				$selectCst="select  count(b.customerid) as  Ccount from  `customer` b, `district` c,  `pin` e where  b.districtid=c.Did and b.post=e.Pid and  b.`status`='1' AND b.CuDate>='$fday' ";
	$resultCst=mysqli_query($con, $selectCst);
	while($rowCst=mysqli_fetch_array($resultCst))
	{
 echo $rowCst["Ccount"];
}
				?>
                  </span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                  </div>
                  <span class="progress-description"  style="cursor:pointer;" onClick="location.href='customer_search.php'" >
                     Click here to go &raquo;
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
              
                <span class="info-box-icon"><i class="fa fa-tags"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Products</span>
                  <span class="info-box-number">
                    <?php
	
	 $fday=date('Y-m-01'); 
	  $selectEnqT="SELECT SUM(b.Qty) AS Value FROM  `order` a, `order_split`  b WHERE a.oid= b.Orderid  AND b.Gtotal!=0  AND b.Status=1 AND a.date>='$fday' ";
	 
	$resultEnqT=mysqli_query($con, $selectEnqT);
	while($rowEnqT=mysqli_fetch_array($resultEnqT))
	{
 echo $rowEnqT["Value"];
}
					?>
                     
                  </span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                  </div>
                  <span class="progress-description" style="cursor:pointer;" onClick="location.href='product-orders.php'" >
                    Click here to go &raquo;
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- =========================================================== -->
          
          
        <div class="row">
<div class="col-xs-12">              
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Routine Order</h3>
                  <?php
                  $mdate=date('Y-m-01'); 
                  $todaydate=date('Y-m-d');
                  $wdate=date('Y-m-d', strtotime("this week"));
                  ?>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                     <th>#</th>
                   	 <th> Report</th>
                     <th> Daily</th>
                     <th> Weekly</th>
                     <th> Monthly</th>                   
                      </tr>
                    </thead>
                    <tbody>
                   <tr>
                        <td>1</td>
                        <td>Call Conversion Ratio BPE Wise</td>
                         <td>
                            <form action="bpe-performance.php" method="post">
                  <input name="txtfDate" type="hidden" class="form-control"  value="<?php echo $todaydate; ?>"/>
                  <input name="txttDate" type="hidden" class="form-control"  value="<?php echo $todaydate; ?>"/>
                  <button type="submit" name="search"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Daily</button>
                  </form> 
                         </td>
                         <td>
                           <form action="bpe-performance.php" method="post">
                  <input name="txtfDate" type="hidden"  value="<?php echo $wdate; ?>"/>
                  <input name="txttDate" type="hidden"  value="<?php echo $todaydate; ?>"/>
                  <button type="submit" name="search"  class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Weekly</button>
                  </form> 
                         </td>
                        <td>
                  <form action="bpe-performance.php" method="post">
                  <input name="txtfDate" type="hidden" value="<?php echo $mdate; ?>"/>
                  <input name="txttDate" type="hidden"  value="<?php echo $todaydate; ?>"/>
                  <button type="submit" name="search"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Monthly</button>
                  </form>    
                    
				   </td>
                      </tr>

                      <tr>
                        <td>2</td>
                        <td>Call Conversion Ratio Campaign Wise</td>
                         <td>
                            <form action="campaign-summary.php" method="post">
                   <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <input name="txttDate" type="hidden"value="<?php echo $todaydate; ?>"/>
                  <button type="submit" name="search"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Daily</button>
                  </form> 
                         </td>
                         <td>
                           <form action="campaign-summary.php" method="post">
                            <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $wdate; ?>"/>
                  <input name="txttDate" type="hidden"  value="<?php echo $todaydate; ?>"/>
                  <button type="submit" name="search"  class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Weekly</button>
                  </form> 
                         </td>
                        <td>
                  <form action="campaign-summary.php" method="post">
                    <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden"  value="<?php echo $mdate; ?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <button type="submit" name="search"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Monthly</button>
                  </form>    
                    
           </td>
                      </tr>

                        <tr>
                        <td>3</td>
                        <td>Delivered Orders BPE Wise</td>
                         <td>
                            <form action="campaign-summary.php" method="post">
                   <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <input name="txttDate" type="hidden"value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Daily</button>
                  </form> 
                         </td>
                         <td>
                           <form action="campaign-summary.php" method="post">
                            <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $wdate; ?>"/>
                  <input name="txttDate" type="hidden"  value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Weekly</button>
                  </form> 
                         </td>
                        <td>
                  <form action="campaign-summary.php" method="post">
                    <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden"  value="<?php echo $mdate; ?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Monthly</button>
                  </form>    
                    
           </td>
                      </tr>

                        <tr>
                        <td>4</td>
                        <td>Delivered Orders Agent Wise</td>
                         <td>
                            <form action="campaign-summary.php" method="post">
                   <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <input name="txttDate" type="hidden"value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Daily</button>
                  </form> 
                         </td>
                         <td>
                           <form action="campaign-summary.php" method="post">
                            <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $wdate; ?>"/>
                  <input name="txttDate" type="hidden"  value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Weekly</button>
                  </form> 
                         </td>
                        <td>
                  <form action="campaign-summary.php" method="post">
                    <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden"  value="<?php echo $mdate; ?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Monthly</button>
                  </form>    
                    
           </td>
                      </tr>

                        <tr>
                        <td>5</td>
                        <td>Delivered Orders Campaign Wise</td>
                         <td>
                            <form action="campaign-summary.php" method="post">
                   <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <input name="txttDate" type="hidden"value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Daily</button>
                  </form> 
                         </td>
                         <td>
                           <form action="campaign-summary.php" method="post">
                            <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $wdate; ?>"/>
                  <input name="txttDate" type="hidden"  value="<?php echo $todaydate; ?>"/>
                  <button type="submit" disabled=""  name="search"  class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Weekly</button>
                  </form> 
                         </td>
                        <td>
                  <form action="campaign-summary.php" method="post">
                    <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden"  value="<?php echo $mdate; ?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <button type="submit" disabled="" name="search"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Monthly</button>
                  </form>    
                    
           </td>
                      </tr>

                      <tr>
                        <td>6</td>
                        <td>Pending Orders BPE Wise</td>
                         <td>
                            <form action="campaign-summary.php" method="post">
                   <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <input name="txttDate" type="hidden"value="<?php echo $todaydate; ?>"/>
                  <button type="submit" disabled="" name="search"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Daily</button>
                  </form> 
                         </td>
                         <td>
                           <form action="campaign-summary.php" method="post">
                            <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $wdate; ?>"/>
                  <input name="txttDate" type="hidden"  value="<?php echo $todaydate; ?>"/>
                  <button type="submit" disabled="" name="search"  class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Weekly</button>
                  </form> 
                         </td>
                        <td>
                  <form action="campaign-summary.php" method="post">
                    <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden"  value="<?php echo $mdate; ?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <button type="submit" disabled="" name="search"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Monthly</button>
                  </form>    
                    
           </td>
                      </tr>

                        <tr>
                        <td>7</td>
                        <td>Pending Orders Agent Wise</td>
                         <td>
                            <form action="pending-orders.php" method="post">
                   <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <input name="txttDate" type="hidden"value="<?php echo $todaydate; ?>"/>
                  <button type="submit" name="search"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Daily</button>
                  </form> 
                         </td>
                         <td>
                           <form action="pending-orders.php" method="post">
                            <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $wdate; ?>"/>
                  <input name="txttDate" type="hidden"  value="<?php echo $todaydate; ?>"/>
                  <button type="submit" name="search"  class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Weekly</button>
                  </form> 
                         </td>
                        <td>
                  <form action="pending-orders.php" method="post">
                    <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden"  value="<?php echo $mdate; ?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <button type="submit" name="search"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Monthly</button>
                  </form>    
                    
           </td>
                      </tr>

                        <tr>
                        <td>8</td>
                        <td>Pending Orders Campaign Wise</td>
                         <td>
                            <form action="campaign-summary.php" method="post">
                   <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <input name="txttDate" type="hidden"value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Daily</button>
                  </form> 
                         </td>
                         <td>
                           <form action="campaign-summary.php" method="post">
                            <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $wdate; ?>"/>
                  <input name="txttDate" type="hidden"  value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Weekly</button>
                  </form> 
                         </td>
                        <td>
                  <form action="campaign-summary.php" method="post">
                    <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden"  value="<?php echo $mdate; ?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Monthly</button>
                  </form>    
                    
           </td>
                      </tr>

<tr>
                        <td>9</td>
                        <td>Canceled Orders BPE Wise</td>
                         <td>
                            <form action="campaign-summary.php" method="post">
                   <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <input name="txttDate" type="hidden"value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Daily</button>
                  </form> 
                         </td>
                         <td>
                           <form action="campaign-summary.php" method="post">
                            <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $wdate; ?>"/>
                  <input name="txttDate" type="hidden"  value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Weekly</button>
                  </form> 
                         </td>
                        <td>
                  <form action="campaign-summary.php" method="post">
                    <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden"  value="<?php echo $mdate; ?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Monthly</button>
                  </form>    
                    
           </td>
                      </tr>

                        <tr>
                        <td>10</td>
                        <td>Canceled Orders Agent Wise</td>
                         <td>
                            <form action="campaign-summary.php" method="post">
                   <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <input name="txttDate" type="hidden"value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Daily</button>
                  </form> 
                         </td>
                         <td>
                           <form action="campaign-summary.php" method="post">
                            <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $wdate; ?>"/>
                  <input name="txttDate" type="hidden"  value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Weekly</button>
                  </form> 
                         </td>
                        <td>
                  <form action="campaign-summary.php" method="post">
                    <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden"  value="<?php echo $mdate; ?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <button type="submit" disabled=""  name="search"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Monthly</button>
                  </form>    
                    
           </td>
                      </tr>

                        <tr>
                        <td>11</td>
                        <td>Canceled Orders Campaign Wise</td>
                         <td>
                            <form action="campaign-summary.php" method="post">
                   <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <input name="txttDate" type="hidden"value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Daily</button>
                  </form> 
                         </td>
                         <td>
                           <form action="campaign-summary.php" method="post">
                            <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $wdate; ?>"/>
                  <input name="txttDate" type="hidden"  value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Weekly</button>
                  </form> 
                         </td>
                        <td>
                  <form action="campaign-summary.php" method="post">
                    <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden"  value="<?php echo $mdate; ?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <button type="submit"  disabled="" name="search"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Monthly</button>
                  </form>    
                    
           </td>
                      </tr>

                       <tr>
                        <td>12</td>
                        <td>Delivery Agents Outstandings</td>
                         <td>
                            <form action="acc-summary.php" method="post">
                   <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <input name="txttDate" type="hidden"value="<?php echo $todaydate; ?>"/>
                  <button type="submit" name="search"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Daily</button>
                  </form> 
                         </td>
                         <td>
                           <form action="acc-summary.php" method="post">
                            <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $wdate; ?>"/>
                  <input name="txttDate" type="hidden"  value="<?php echo $todaydate; ?>"/>
                  <button type="submit" name="search"  class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Weekly</button>
                  </form> 
                         </td>
                        <td>
                  <form action="acc-summary.php" method="post">
                    <input name="tme" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden"  value="<?php echo $mdate; ?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <button type="submit" name="search"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Monthly</button>
                  </form>    
                    
           </td>
                      </tr>

                        <tr>
                        <td>13</td>
                        <td>Delivery Agents Stock Status</td>
                         <td>
                            <form action="trans-report.php" method="post">
                   <input name="tme" type="hidden"value=""/>
                   <input name="tra" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <input name="txttDate" type="hidden"value="<?php echo $todaydate; ?>"/>
                  <button type="submit" name="search"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Daily</button>
                  </form> 
                         </td>
                         <td>
                           <form action="trans-report.php" method="post">
                            <input name="tme" type="hidden"value=""/>
                            <input name="tra" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden" value="<?php echo $wdate; ?>"/>
                  <input name="txttDate" type="hidden"  value="<?php echo $todaydate; ?>"/>
                  <button type="submit" name="search"  class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Weekly</button>
                  </form> 
                         </td>
                        <td>
                  <form action="trans-report.php" method="post">
                    <input name="tme" type="hidden"value=""/>
                    <input name="tra" type="hidden"value=""/>
                  <input name="txtfDate" type="hidden"  value="<?php echo $mdate; ?>"/>
                  <input name="txttDate" type="hidden" value="<?php echo $todaydate; ?>"/>
                  <button type="submit" name="search"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Monthly</button>
                  </form>    
                    
           </td>
                      </tr>

                    
                    </tbody>
                    <tfoot>
                      <tr>
                     <th>#</th>
                     <th> Report</th>
                     <th> Daily</th>
                     <th> Weekly</th>
                     <th> Monthly</th>   
                      </tr>
                    </tfoot>
                  </table>
                  
    
 </div><!-- /.box --></div> </section><!-- /.content -->
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