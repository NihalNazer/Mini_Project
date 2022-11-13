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
            <li><i class="fa fa-reply-all"></i> Rejected Orders</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          
          <div class="row">
            
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Rejected Orders</h3>
                
               <?php

    $showUserid=$_SESSION['homsuser'];
   	require_once("../class/ipagination.php");
   	$page=new ipagination();
   	$page->perpage=20;
	$page->show=3;
	$page->con=$con;
	
	if(isset($_GET["q"]))
	{
		$q=$_GET["q"];
		$qquery=" AND (a.oid='$q' OR b.contactNum1 like '%$q%' OR b.name like '%$q%') ";
	}
	else
	{
		$qquery='';
	}
	
	$page->query="select a.oid, a.date, b.name, b.contactNum1, a.tqty, a.gtotal, a.oFlag, g.OsName, a.eid, e.Officename, e.Pincode, a.oFlag, u.Name from `order` a, `customer` b, `district` c, `pin` e,  `order_status` g, user u where  a.`oFlag`='10' and a.customerid=b.customerid and b.districtid=c.Did and b.post=e.Pid and a.oallotment=u.Uid and g.OsId=a.oFlag and a.`status`='1' and a.invtype=1 ".$qquery;
   ?>
   
    <?php
				   $page->pageinfo(); 
	?>
    <small class="label bg-green"><?php echo  $page->trows ; ?></small>
    <form method="get" action="">
  <div class="box-tools">
                    <div class="input-group">
                   
                    <input type="text" name="q" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" value="<?php echo @$_GET["q"]; ?>" autofocus/>
                      <div class="input-group-btn">
                        <button type="submit" name="search" value="yes" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                        
                    </div>
                  </div>
                  
                  </form>
                </div><!-- /.box-header -->
              
            
            <div class="box-body">
              <div class="my-box"> 
                         <?php 
   if(isset($_POST["allot"]))
{
  
  $Ordrid=$_POST["ordr"];
  $FRiD=$_POST["area"];
  
  if($FRiD!='' && $FRiD!='0')
  {
  
  $updateStatus="Update `order` SET `oallotment`='$FRiD', `oFlag`='8' WHERE `oid`='$Ordrid'";
  mysqli_query($con,$updateStatus);
  
   /*?>$selectUpdate="SELECT * FROM `order_status_update` WHERE `Oid`='$Ordrid' AND `OSid`='8' AND `uid`='$user' AND `OSUstatus`='1' AND `OSUflag`='1'";
  $resultUpdate=mysql_query($selectUpdate);
  if(mysql_num_rows($resultUpdate)==0)
  {<?php */
  
  $insertOrdr="INSERT INTO `order_status_update` 
    (`OSUid`, `Oid`,`OSid`,`uid`,`OSUdate`,`OSUtime`,`OSUstatus`,`OSUflag`,`OSUremark`)
    VALUES (NULL, '$Ordrid', '8', '$user', '$CurrentDate', '$CurrentTime', '1', '1','')";
    mysqli_query($con,$insertOrdr);
    
  /*?>}<?php */
    
    echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>  <i class=\"icon fa fa-check\"></i> Alert!</h4>
                   Alloted Successfully...
                  </div>";
}
else
{
  echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    Please select any Agent to allot this order ...
                  </div>";
}
}
?>


 <?php 
   if(isset($_POST["withheld"]))
{
  $Ordrid=$_POST["ordr"];
  $FRiD=$_POST["area"];
  
  if($FRiD!='' && $FRiD!='0')
  {
  $updateStatus="Update `order` SET `oallotment`='$FRiD', `oFlag`='7' WHERE `oid`='$Ordrid'";
  mysqli_query($con, $updateStatus);
  
  /*?>$selectUpdate="SELECT * FROM `order_status_update` WHERE `Oid`='$Ordrid' AND `OSid`='7' AND `uid`='$user' AND `OSUstatus`='1' AND `OSUflag`='1'";
  $resultUpdate=mysql_query($selectUpdate);
  if(mysql_num_rows($resultUpdate)==0)
  {<?php */
  
    $insertOrdr="INSERT INTO `order_status_update` 
    (`OSUid`, `Oid`,`OSid`,`uid`,`OSUdate`,`OSUtime`,`OSUstatus`,`OSUflag`,`OSUremark`)
    VALUES (NULL, '$Ordrid', '7', '$user', '$CurrentDate', '$CurrentTime', '1', '1','')";
    mysqli_query($con, $insertOrdr);
  /*}*/
  
  
    
    echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>  <i class=\"icon fa fa-check\"></i> Alert!</h4>
                   Successfully Withheld this Order ...
                  </div>";      
}
else
{
  echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    Please select any Agent to without this order ...
                  </div>";
}         
}
?>
            </div> 
                  
                  <table id="#example1" class="table table-hover">
                    <thead>
                      <tr>
                     <th>#</th>
                   	 <th> Order</th>
                     <th> Date</th>
                     <th> Customer</th>
                     <th> Contact</th>
                     <th> Qty</th>
                     <th> Value</th>
                     <th> Rejected Agent</th>   
                     <th> Action</th>                
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
	  $i = 0;
	
	$perpage=$page->perpage;
				   $pstart=$page->pstart;

					$selectBase=$page->query." ORDER BY a.oid ASC LIMIT $pstart,$perpage";
	

	
	//echo $selectBase;
	$resultSearch=mysqli_query($con, $selectBase);
	//echo $selectBase.$selectSearch.$selectFrom.$selectTo;
	//$resultSearch=($resultBase;
	
	//echo $resultSearch;
	if(mysqli_num_rows($resultSearch)>=1)
	{
		while($row=mysqli_fetch_array($resultSearch))
		{
		 $i = $i + 1;
	?>
					
                      <tr>
                        <td><?php echo $n; ?></td>
                        <td>
                        <?php echo $row["oid"]; ?>
					</td>
                         
                         <td><?php $odate=$row["date"]; echo date("d-m-Y", strtotime($odate)); ?></td>
                         <td><?php echo $row["name"]; ?></td>
                         <td><?php echo $row["contactNum1"]; ?></td>
                         <td><?php echo $row["tqty"]; ?></td>
                         <td><?php echo $row["gtotal"]; ?></td>
                         <td><?php echo $row["Name"]; ?></td>
                        <td>
                         <?php if($row["oFlag"]==10){ ?>
                           
                  <form action="reallot.php" method="post">
                  <input type="hidden" name="refid" value="<?php echo $row["eid"]; ?>" /> 
                  <button type="submit" name="btnShow"  class="btn btn-warning"><i class="fa fa-eye"></i> View</button>
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
                   	 <th> Order</th>
                     
                     <th> Date &amp; Time</th>
                     <th> Customer</th>
                     <th> Contact</th>
                     <th> Qty</th>
                     <th> Value</th>
                     <th> Rejected Agent</th>
                     <th> Action</th>
                      </tr>
                    </tfoot>
                  </table>
                  
 

    </div><!-- /.box-body -->
    
    
    <div class="box-footer clearfix">
                                <?php echo $page -> pinfo; ?>
                                <?php  $page->pagenav(); ?>
     </div>
    
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