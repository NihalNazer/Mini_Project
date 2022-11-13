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
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
 
 <?php  head_part(); ?>
  <body class="skin-black">
    <div class="wrapper">

      	<?php top($con); ?>
      <!-- Left side column. contains the logo and sidebar -->
   <?php  admin_nav($con); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
             <!-- <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
            <li class="active"><i class="fa fa-user"></i>Account</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
    
<!----------------------------------------------------PAGE CONTENTS START HERE ------------------------------------------------->
<div class="row">             


        
 <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Manage Account Balance</h3>
                </div><!-- /.box-header -->


 <div class="my-box">   
 

<?php
if(isset($_POST["btnEdit"]))
{
	$hid=$_POST["hid"];
	$amount=$_POST["amount"];
	
		$updateQuery="update `user` set `balance`='$amount', `ludate`='$CurrentDate', `lutime`='$CurrentTime' where `Uid`='$hid'";
	//echo $updateQuery;
	mysqli_query($con, $updateQuery);
	echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                    Updated Successfully...
                  </div>";
				  
	$amount=NULL;	
	echo"<script type=\"text/javascript\">
 window.location.assign(\"account.php\")
</script>";

}
	
?>
</div>


<?php 
if(isset($_POST["btnRef"]))
{
	$editId=$_POST["refid"];
	//echo "You are editting";
	$selectQuery="select Uid, balance, Name from `user` where `Uid`='$editId'";
	$resultSelectQuery=mysqli_query($con, $selectQuery);
	while($editRow=mysqli_fetch_array($resultSelectQuery))
	{
?>
<form role="form" method="post" >
                 <div class="box-body">
                   <div class="form-group">
                    <label for="price">Current Balance (<?php echo $editRow["Name"];?>)<span style="color:#FF0000">*</span></label>
                    <input id="price" class="form-control" name="amount" type="text" value="<?php echo $editRow["balance"];?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" />
                    </div>
                    
                   
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                   <input type="hidden" name="hid" value="<?php echo $editRow["Uid"];?>" />
                   <button type="submit" name="btnEdit"  class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                  </div>
                </form>
      <?php
	}
}
else
{
echo"<script type=\"text/javascript\">
 window.location.assign(\"account.php\")
</script>";
}
?>

                
              </div><!-- /.box -->
</div>



 <div class="col-md-6">
  <!-- TO DO List -->
   <?php
   	require_once("../class/pagination.php");
   	$page=new pagination();
   	$page->perpage=10;
	$page->show=3;
	$page->con=$con;
	$page->query="select a.En_ref, a.En_TDate, a.En_rcvbl,  b.IT_name from `inventry` a,`inventype` b where a.En_stat='1' and a.En_type=b.IT_id and a.En_rcvbl!=0 order by a.En_TDate DESC limit 0,10";
   ?>
              <div class="box box-success">
                <div class="box-header">
               
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Recent Entries</h3>
                  <div class="box-tools pull-right">
                   <?php
				   $page->pagenav(); 
				   $perpage=$page->perpage;
				   $pstart=$page->pstart;
					?>
                 
                  </div>
                </div><!-- /.box-header -->
                
                
                <div class="box-body">
                  <ul class="todo-list">
                    
                
                   <?php
$select="select a.En_ref, a.En_TDate, a.En_rcvbl, b.IT_name from `inventry` a,`inventype` b where a.En_stat='1' and a.En_type=b.IT_id and a.En_rcvbl!=0 order by a.En_TDate DESC limit 0,10 ";
  $result=mysqli_query($con, $select);
while($row=mysqli_fetch_array($result))
  {
  ?>
                    <li>
                      <span class="handle">
                        <i class="fa  fa-hand-o-right"></i>
                      </span>
                      <span class="text"><?php echo $row["En_ref"]."/".$row["En_TDate"];?></span>
                      
                      
                       <small class="label label-default"><i class="fa fa-inr"></i> <?php echo $row["En_rcvbl"]." - ".$row["IT_name"];?></small>
                      
                    </li>
                    <?php 
}
?>
                  </ul>
                  <br/>
                  <?php echo  $page->trows ." Found"; ?>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div>


</div>
<!----------------------------------------------------PAGE CONTENTS START HERE ------------------------------------------------->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php footer($con); ?>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    
     <?php jss(); ?>

  </body>
</html>
<?php
}
?>