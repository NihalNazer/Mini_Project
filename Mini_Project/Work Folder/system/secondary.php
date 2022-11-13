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
   
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <SCRIPT language="javascript">
$(function(){
 
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
});
</SCRIPT>

<SCRIPT language="javascript">
$(function(){
 
    // add multiple select / deselect functionality
    $("#selectallb").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectallb").attr("checked", "checked");
        } else {
            $("#selectallb").removeAttr("checked");
        }
 
    });
});
</SCRIPT>

<script>

$(document).ready(function(){

$('#select_all_state').click(function() {
    $('#state_id option').prop('selected', true);
});


$('#unselect_all_state').click(function() {
    $('#state_id option').prop('selected', false);
});


});
</script>
  
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
            <li class="active"><i class="fa fa-database"></i> Secondary Data Allotment</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <div class="row">
             <form method="POST" action="">
           <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-database"></i> &nbsp; Secondary Data Allotment</h3>
                </div><!-- /.box-header -->
                
  <div class="my-box">              
<?php
if(isset($_POST['allot']))
{

	if(isset($_POST['state_id']))
	{
$state_id=implode(',',$_POST['state_id']);
//echo $state_id;
//echo "<br/>";
$array = $_POST['state_id'];
//print_r(array_values($array));
//echo "<br/>"; //echo "<br/>";
$amt = $_POST['total']; // Get the total rows

$selectCount=0;
for($i=1; $i<=$amt; $i++) {
		
		if(isset($_POST["enq$i"]))
		{
			$stack = array();
			//$newval=$_POST["enq$i"];
			//array_push($stack, $newval);
			//print_r($stack);
		$selectCount++;
		}		
	}

$tmecount=count($array);//total tme to be alloted 
$selectCount;//all selected values
$perData=floor($selectCount/$tmecount);
$Balance=$selectCount%$tmecount;	

	$k=1;	
	foreach($array as $value)
			{
					
	$amtn=$amt-$Balance;	
	for($i=$k; $i<=$amtn; $i+=$tmecount) 
	{
		
		if(isset($_POST["enq$i"]))
		{
			$enquiry=$_POST["enq$i"];
			//echo $value."<br />\n";
				$allot = "UPDATE `enquiry` SET `userid`='$value', `adate`='$CurrentDate', `atime`='$CurrentTime' WHERE eid = '$enquiry'";
				//echo $allot ."<br/>";
				mysqli_query($con, $allot); // Run the delete query inside for loop
	
		}
	}
	
	$k++;
	
}
	unset($value);
	$msg="<h5>" .$perData. " Data  Alloted to " .$tmecount." Business Process Executives ". "</h5>";
	 
	echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                    $msg
                  </div>";
	}
}


?>

<?php
if(isset($_POST['delete']))
{
	
	$amt = $_POST['total']; // Get the total rows
	$d=0;
        for($i=1; $i<=$amt; $i++) {
			if(isset($_POST["enq$i"]))
		{
			
               $delete = mysqli_query($con, "DELETE FROM `enquiry` WHERE eid = '".$_POST["enq$i"]."'"); // Run the delete query inside for loop
			   
	   $d++;
			      
		}
        }
	
		$msg="<h5>" .$d. " Data  Deleted Successfully "."</h5>";
	 
	echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                    $msg
                  </div>";
}
?>
  </div>             
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      <th>#</th>
                      <th><input type="checkbox" id="selectall"/></th>
                      <th>Ref_Id</th>
                      	 <th> Contact Number</th>
                        <th>Date & Time</th>
                        <th>Data Source</th>
                        <th>Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$n=1;
	  $i = 0;
	$selectEnq="SELECT b.`ncid`, b.`ncfor`, a.* FROM  `enquiry` a, `number_config` b WHERE a.lnode= b.ncid AND `userid`=0 AND a.status=1 AND a.fresh='2'";
	$resultEnq=mysqli_query($con, $selectEnq);
	while($rowEnq=mysqli_fetch_array($resultEnq))
	{
		 $i = $i + 1;
	?>
					
                      <tr>
                        <td><?php echo $n; ?></td>
                        <td><input type="checkbox" class="case" name="enq<?php echo $i; ?>" value="<?php echo $rowEnq["eid"]; ?>"/></td>
                        <td><?php echo $rowEnq["sid"]; ?></td>
                        <td><?php echo $rowEnq["vnum"]; ?></td>
                        <td><?php echo $rowEnq["vctime"]; ?></td>
                        <td><?php echo $rowEnq["ncfor"]; ?></td>
                        <td><?php echo $rowEnq["ERemarks"]; ?></td>
                      </tr>
                     <?php
					 $n++;
					}
					?>
                    </tbody>
                    <tfoot>
                      <tr>
                      <th>#</th>
                      <th><input type="checkbox" id="selectallb"/></th>
                      <th>Ref_Id</th>
                      	 <th> Contact Number</th>
                        <th>Date & Time</th>
                        <th>Data Source</th>
                        <th>Remarks</th>
                      </tr>
                    </tfoot>
                  </table>
                 
                  <input type="hidden" name="total" value="<?php echo $i; ?>" /> <?php // Post the total rows count value ?>

<div class="form-group">
<select id="state_id" name="state_id[]" multiple="multiple" class="form-control">

<?php 
$selectTme="SELECT `Uid`, `Name` FROM  `user` WHERE `Categoryid`='2' and `Status`=1 ORDER BY Name ASC";
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
<div class="form-group">
<input type="button" id="select_all_state" class="btn btn-bricky" name="select_all_state" value="Select All">
<input type="button" id="unselect_all_state" class="btn btn-bricky" name="unselect_all_state" value="Unselect All">
</div>

    </div><!-- /.box-body -->
    
    <div class="box-footer">
                  <button type="submit" name="allot"  class="btn btn-success"><i class="fa fa-paperclip"></i> Allot Data</button>
                  <button type="submit" name="delete"  class="btn btn-danger"><i class="fa fa-trash-o"></i> Remove Data</button>
                  </div> 
              </div><!-- /.box -->
              
              </form>
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