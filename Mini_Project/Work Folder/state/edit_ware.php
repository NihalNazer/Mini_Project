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
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Your Page Content Here -->
          
          
           <!-- =========================================================== -->
<div class="row">

 <div class="col-md-6">
  <!-- TO DO List -->
   <?php
   	require_once("../class/pagination.php");
   	$page=new pagination();
   	$page->perpage=14;
	$page->show=3;
	$page->con=$con;
	$page->query="SELECT * FROM `district` Where `Status`='1' order by `District` ASC";
   ?>
              <div class="box box-success">
                <div class="box-header">
               
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Warehouses </h3>
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
$select="SELECT * FROM `district` Where `Status`='1' order by `District` ASC LIMIT $pstart,$perpage";
  $result=mysqli_query($con, $select);
while($row=mysqli_fetch_array($result))
  {
  ?>
                    <li>
                      <span class="handle">
                        <i class="fa  fa-hand-o-right"></i>
                      </span>
                      <span class="text"><?php echo $row["District"];?></span>
                      
                      <div class="tools">
          <form  action="" method="post">
         <input name="edit" type="hidden" value="<?php echo $row["Did"];?>"/>
          
          <button type="submit" name="edt" style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-edit"></i></button>
         </form>
         
          
         
                      </div>
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
    
    <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Manage District Warehouse</h3>
                </div><!-- /.box-header -->


 <div class="my-box">   
 

<?php
if(isset($_POST["editSubmit"]))
{
	$districtBdm=$_POST["bdm"];;
	$hid=$_POST["hid"];
	
	if ($districtBdm!='' )
	{ 
	
	$insert="UPDATE `district` SET `WH`='$districtBdm' WHERE `Did`=$hid";
	mysqli_query($con, $insert);
	
	//$update="UPDATE `franchisee` SET `FRUser`='$districtBdm' WHERE `FRDist`=$hid";
	//mysqli_query($con, $update);
	
	//echo $insert;
	echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                    Updated Successfully...
                  </div>";
				  
	
}
else
{
	echo"<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>
                    Please fill all fields...
                  </div>";
}

}
	
?>
</div>


<?php 
if(isset($_POST["edt"]))
{
	$editId=$_POST["edit"];
	//echo "you are editting";
	$editSelect="SELECT * FROM `district` WHERE `Did`='$editId'";
	$result=mysqli_query($con, $editSelect);
	while($editRow=mysqli_fetch_array($result))
	{
?>
<form role="form" method="post" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="DName">District Name</label>
                      <input name="dName" type="text" class="form-control"  readonly value="<?php echo $editRow["District"]?>" id="DName" placeholder="Enter District Name"/>
                     
                    </div>
                    
                     <div class="form-group">
                      <label for="BDM">Warehouse</label>
                      <select id="BDM" name="bdm" class="form-control" >
                      
                      <option value="">Select</option>
                      
                      <?php 
					  $cbdm=$editRow["WH"];
					  if($cbdm!=0)
					  {
					  $selectbdmc="select wh_id, wh_name from `warehouse` where `wh_stat`=1 AND `wh_id`='$cbdm'";
					  $resultbdmc=mysqli_query($con, $selectbdmc);
					  while($rowbdmc=mysqli_fetch_array($resultbdmc))
					  {
					  ?>
                       <option selected value="<?php echo $rowbdmc["wh_id"]; ?>"><?php echo $rowbdmc["wh_name"]; ?></option>
                      
                      <?php
					  }
					  }
					  ?>
                      
                      <?php
					  $selectbdm="select wh_id, wh_name from `warehouse` where `wh_stat`=1 AND `wh_id`!='$cbdm' order by wh_name ASC";
					  $resultbdm=mysqli_query($con, $selectbdm);
					  while($rowbdm=mysqli_fetch_array($resultbdm))
					  {
					  ?>
                      <option value="<?php echo $rowbdm["wh_id"]; ?>"><?php echo $rowbdm["wh_name"]; ?></option>
                      <?php
					  }
					  ?>
                      </select>
                     
                    </div>
                   
                     
                   </div><!-- /.box-body -->

                  <div class="box-footer">
                  <input type="hidden" name="hid" value="<?php echo $editRow["Did"]; ?>" /> 
                   <button type="submit" name="editSubmit"  class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                  </div>
                </form>
      <?php
	}
}
else
{
	?>
    <div class="box-body">
	Please Choose a District to Edit...
    </div>
    <?php
}
?>
 </div><!-- /.box -->
</div>

    
    
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