<?php include("../config/conntme.php"); ?>
<?php
//validation for admin page;
if(!isset($_SESSION['homsuser']) || !isset($_SESSION['homsutype']) ||($_SESSION['homsutype']!=2))
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

<?php
if(isset($_GET["ref"]))
 {
	 $refid=$_GET["ref"];
 }
 elseif(isset($_GET["fref"]))
 {
	 $refid=$_GET["fref"];
 }
 elseif(isset($_POST["btnRef"]))
 {
	 $refid=$_POST["refid"];
	 mysqli_query($con, "update `enquiry` set `flag`='1' WHERE `eid`='$refid'");
 }
 elseif(isset($_POST["btnSave"]))
{	
 	$refid=$_POST["refid"];
}
elseif(isset($_POST["edt"]))
{	
 	$refid=$_POST["refid"];
}
elseif(isset($_POST["delt"]))
{	
 	$refid=$_POST["refid"];
}
elseif(isset($_POST["btnEdit"]))
{	
 	$refid=$_POST["refid"];
}
elseif(isset($_POST["EbtnRef"]))
{	
 	$refid=$_POST["refid"];
}
elseif(isset($_POST["view"]))
{	
 	$refid=$_POST["refid"];
}
else
{
	echo"<script type=\"text/javascript\">
 window.location.assign(\"javascript:history.go(-1)\")
</script>";	
}
 ?>
 
 <?php
 if(isset($_GET["ref"]))
 {
	 $ref=$_GET["ref"];
 $selectPermission="SELECT `eid` FROM `enquiry` WHERE `eid`='$ref' AND `userid`='$user'";
// echo $selectPermission;
 $resultPermission=mysqli_query($con, $selectPermission);
if(mysqli_num_rows($resultPermission)==0)
 {
	 echo"<script type=\"text/javascript\">
 window.location.assign(\"javascript:history.go(-1)\")
</script>";	      	 
 }
  }
 ?>
 
  <?php
 if(isset($_GET["fref"]))
 {
	 $ref=$_GET["fref"];
 $selectPermission="SELECT `eid` FROM `enquiry` WHERE `eid`='$ref' AND `userid`='$user'";
// echo $selectPermission;
 $resultPermission=mysqli_query($con, $selectPermission);
if(mysqli_num_rows($resultPermission)==0)
 {
	 echo"<script type=\"text/javascript\">
 window.location.assign(\"followups.php\")
</script>";	      	 
 }
  }
 ?>
 
<!DOCTYPE html>

<html>
 
 <?php  head_part(); ?>
  <body class="skin-black">
    <div class="wrapper">

      	<?php top($con); ?>
      <!-- Left side column. contains the logo and sidebar -->
   <?php  tme_nav($con); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            BPE
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
             <!-- <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
           <li class="active"><i class="fa fa-thumbs-o-up"></i> Follow-ups</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
<div class="row">             

    <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-danger">
                <div class="box-header">
               <i class="fa fa-comment"></i>
                  <h3 class="box-title">Lead Details</h3>
                </div><!-- /.box-header -->
                <?php if((isset($refid)) &&$refid!=''){?>
                 <div class="box-body">
                 
                 <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tbody><tr>
                      <th>Ref_Id</th>
                      <th>Contact Number</th>
                      <th>Source</th>	
                      <th>Date and Time</th>
                      <th>#Notes</th>
                      </tr>
                    <?php
					$selectLead="SELECT a.eid, a.sid, a.vnum, a.vctime, a.fresh, a.ERemarks, b.ncfor FROM  `enquiry` a, `number_config` b WHERE a.lnode= b.ncid AND a.`userid`!=0  AND a.status=1  AND a.userid='$user' AND a.`eid`='$refid'";
					$resultLead=mysqli_query($con, $selectLead);
					while($rowLead=mysqli_fetch_array($resultLead))
					{
					?>
                    
                    <tr>
                      <td><?php echo $rowLead["sid"]; ?></td>
                      <td>
					  <?php echo $rowLead["vnum"]; ?>
                      <?php
					  $tennumber=substr($rowLead["vnum"], -10);
					  $selectCustomer="Select `name` from `customer` where `contactNum1`='$tennumber' and `Status`=1";
					  $resultCustomer=mysqli_query($con, $selectCustomer);
					  if(mysqli_num_rows($resultCustomer)>=1)
					  {
						  $rowCustomer=mysqli_fetch_array($resultCustomer);
						  echo " [".$rowCustomer["name"]."] ";
					  }
					  ?>
                      </td>
                      <td><?php echo $rowLead["ncfor"]; ?>
                      <?php
						if($rowLead["fresh"]=='1')
						{
						?>
                        <small class="label bg-green">F</small>
                        <?php
						}
						else
						{
							?>
                        <small class="label bg-blue">S</small>
                        <?php
						}
						?>
                      </td>
                      <td><?php echo $rowLead["vctime"]; ?></td>
                      <td><?php echo $rowLead["ERemarks"]; ?></td>
                      </tr>
                   <?php
					}
					?>
                  </tbody></table>
                </div>
                 
                 </div>
                </div>
               </div>
             </div>
<div class="row">             

    <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
               <i class="fa fa-thumbs-o-up"></i>
                  <h3 class="box-title">Follow-up</h3>
                </div><!-- /.box-header -->


 <div class="my-box">   
 
 <?php
  if(isset($refid) || $refid!='')
  {
	  $selectLead="SELECT * FROM `lead` WHERE `Lead_id`='$refid'";
	  $resultLead=mysqli_query($con, $selectLead);
	  $rowLead=mysqli_fetch_array($resultLead);
	  //$oldAmt=$rowLead["Total_amount"];
	  //echo  $oldAmt;
  }
 ?>
    
   <?php 
   if(isset($_POST["delt"]))
{
	$did=$_POST["edit"];
	$delete="UPDATE `response` SET `rstatus`='0' WHERE `rid`='$did'";
	mysqli_query($con, $delete);
	echo "<div class=\"alert alert-info alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-info\"></i> Alert!</h4>
                   Response Removed Successfully...
                  </div>";
}
?>
             
<?php
if(isset($_POST["btnSave"]))
{	
$resposeCategory=$_POST["ddlCategory"];
	//$date=$_POST["txtDate"];
	$subject=$_POST["txtFUsub"];
	$fuDate=$_POST["txtFDate"];
	$fuTime=$_POST["txtFTime"];
	$remark=$_POST["txtareaRemark"];
	
	/****************FROM SESSION**************/
	$userId=$user;
	$enquiryId=$_POST["refid"];
	/****************FROM SESSION**************/
	
	if ($resposeCategory!='' && $CurrentDate!='')
	{ 
    $insert="INSERT INTO `response` (`rid`, `rtype`, `rdate`, `rtime`, `uid`, `rstatus`, `remark`, `Enquiry_id`, `FUTitle`, `FUDate`, `FUTime`) VALUES (NULL,'$resposeCategory', '$CurrentDate', '$CurrentTime', '$userId', '1', '$remark', '$enquiryId', '$subject', '$fuDate', '$fuTime')";
	mysqli_query($con, $insert);
	mysqli_query($con, "update `enquiry` set `flag`='2' WHERE `eid`='$enquiryId'");
	
	//echo $insert;
echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                    Dropped Successfully...
                  </div>";
	 
				 $resposeCategory=$CurrentDate=$CurrentTime=$subject=$fuDate=$fuTime=$remark=NULL;
				 echo"<script type=\"text/javascript\">
 window.location.assign(\"javascript:history.go(-2)\")
</script>";	
	
  
}
else
{
	echo"<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>
                    Please fill mandatory fields...
                  </div>";
	}
}
?>

<?php
if(isset($_POST["btnEdit"]))
{
	$edtResposeCategory=$_POST["ddlEdtCategory"];
	$edtDate=$_POST["edtTxtDate"];
	$edtSubject=$_POST["edtTxtSub"];
	$edtFuDate=$_POST["txtEdtFDate"];
	$edtFuTime=$_POST["txtEdtFTime"];
	$edtRemark=$_POST["txtareaEdtRemark"];
	
	/****************FROM SESSION**************/
	$edtUserId=$user;
	$edtEnquiryId=$_POST["refid"];
	/****************FROM SESSION**************/
	$hid=$_POST["hid"];

	if($edtResposeCategory!='' && $edtDate!='')
	{
		$update="update `response` set 
`rtype`='$edtResposeCategory',`rdate`='$edtDate',`uid`='$edtUserId',`remark`='$edtRemark',`Enquiry_id`='$edtEnquiryId', `FUTitle`='$edtSubject', `FUDate`='$edtFuDate', `FUTime`='$edtFuTime' where `rid`='$hid'";
		mysqli_query($con, $update);
		
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
                    Please fill mandatory fields......
                  </div>";
}
}	
?>
</div>
<?php 
if(isset($_POST["edt"]) || isset($_POST["EbtnRef"]))
{
	$editId=$_POST["edit"];
//	echo "you are editting";
	$editSelect="SELECT * FROM `response` WHERE `rid`='$editId'";
	$result=mysqli_query($con, $editSelect);
	while($editRow=mysqli_fetch_array($result))
	{
?>
<!----------------------------------EDIT WAREHOUSE---------------------------------->
<form role="form" method="post" >

                  <div class="box-body">
                  <div class="form-group">
                      <label for="dateTime">Date<span style="color:#FF0000">*</span></label>
                     <input name="edtTxtDate" class="form-control" id="date"  type="date" value="<?php echo $editRow["rdate"];?>"/>
                      </div>
                   
                     <div class="form-group">
                     <label for="respCat">Response Category<span style="color:#FF0000">*</span></label>
                      <select id="ddlEdtCategory" class="form-control" name="ddlEdtCategory">
      <option value="">SELECT</option>
      <!-----------------------------response category addded---------------------------->
      <?php 
	$editCatId=$editRow["rtype"];
	$selectResponseCat="select * from `response_category` where `rtid`='$editCatId' and `rtstatus`='1' and `rflag`='0' order by `name` ASC";
	$resultQuery=mysqli_query($con, $selectResponseCat);
	while($resCatRow=mysqli_fetch_array($resultQuery))
	{
	?>
      <option selected="selected" value="<?php echo $resCatRow["rtid"];?>"><?php echo $resCatRow["name"];?></option>
      <?php
	}
	?>
      <!---------------------------------other response category into drop down list----------------------------------->
      <?php 
	$selectOtherCatg="select * from `response_category` where `rtid`!='$editCatId' and `rtstatus`='1' and `rflag`='0' order by `name` ASC";
	$resultCatg=mysqli_query($con, $selectOtherCatg);
	while($otherCatgRow=mysqli_fetch_array($resultCatg))
	{
	?>
      <option value="<?php echo $otherCatgRow["rtid"];?>"><?php echo $otherCatgRow["name"];?></option>
      <?php
	}
	 ?>
    </select>
                    </div> 
                   <div class="form-group">
                      <label for="remark">Remark</label>
                    <textarea id="remark" class="form-control" placeholder="Remark" name="txtareaEdtRemark" cols="45" rows="5"><?php echo $editRow["remark"];?></textarea>
                 </div>
                   
                   <hr/>
                 <div class="form-group">
                      <label for="nDate">Date and Time for Next Follow Up </label>
                      <input name="txtEdtFDate" type="date" class="form-control"  value="<?php echo $editRow["FUDate"];?>" id="nDate"/>
                   <div class="bootstrap-timepicker">
                      <div class="input-group">
                        <input type="text" class="timepicker form-control"  name="txtEdtFTime"  value="<?php echo $editRow["FUTime"];?>"/>
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                    </div> 
                    </div>
                    
                   </div> 
                               
                   <div class="form-group">
                     <label for="fuSub">Follow Up Subject</label>
                     <input name="edtTxtSub" type="text" class="form-control"  value="<?php echo $editRow["FUTitle"];?>" id="fuSub" placeholder="Follow Up Subject"/>
                   </div>
                 
                 </div><!-- /.box-body -->

                  <div class="box-footer">
                  <input type="hidden" name="hid" value="<?php echo $editRow["rid"];?>" />
                   <input type="hidden" name="refid" value="<?php echo $editRow["Enquiry_id"];?>" />  
                  <button type="submit" name="btnEdit"  class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                  </div>
                </form>
          
<!----------------------------------EDIT WAREHOUSE END---------------------------------->     
      <?php
	}
}
else
{
	?>
                <!----------------------------------------------ADD NEW---------------------------------------------------->
                <!-- form start -->
                
                <form role="form" method="post" >
                  <div class="box-body">
  
                    <div class="form-group">
                     <label for="respCat">Response Category<span style="color:#FF0000">*</span></label>
                     <select id="respCat" class="form-control" name="ddlCategory">
    <option value="">SELECT</option>
    <!-----------------------------response category addded---------------------------->
    <?php 
	$editCatId=@$resposeCategory;
	$selectResponseCat="select * from `response_category` where `rtid`='$editCatId' and `rtstatus`='1' and `rflag`='0' order by `name` ASC";
	$resultQuery=mysqli_query($con, $selectResponseCat);
	while($resCatRow=mysqli_fetch_array($resultQuery))
	{
	?>
    <option selected="selected" value="<?php echo $resCatRow["rtid"];?>"><?php echo $resCatRow["name"];?></option>
    <?php
	}
	?>
    <!---------------------------------other response category into drop down list----------------------------------->
    <?php 
	$selectOtherCatg="select * from `response_category` where `rtid`!='$editCatId' and `rtstatus`='1' and `rflag`='0' order by `name` ASC";
	$resultCatg=mysqli_query($con, $selectOtherCatg);
	while($otherCatgRow=mysqli_fetch_array($resultCatg))
	{
	?>
    <option value="<?php echo $otherCatgRow["rtid"];?>"><?php echo $otherCatgRow["name"];?></option>
    <?php
	}
	 ?>
    </select>
                    </div> 
                   
           
                   
                    <div class="form-group">
       <label for="remark">Remark</label>
       <textarea id="remark" class="form-control" placeholder="Remark" name="txtareaRemark" cols="45" rows="5"><?php echo @$remark?></textarea>              
     </div>
            
    <hr/>                   
                  
                   
                   <div class="form-group">
                    <label for="nDate">Date and Time for Next Follow Up </label>
                    <input name="txtFDate" type="date" class="form-control"  value="<?php echo @$fuDate;?>" id="nDate2"/>
                     <div class="bootstrap-timepicker">
            <div class="input-group">
                        <input type="text" class="timepicker form-control"  name="txtFTime"  value="<?php echo @$fuTime; ?>"/>
              <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                    </div> 
                    </div> 
                  </div> 
                   
  <div class="form-group">
                      <label for="fuSub">Follow Up Subject</label> 
                      <input name="txtFUsub" type="text" class="form-control"  value="<?php echo @$subject ?>" id="fuSub" placeholder="Follow Up Subject"/>
                   
                   </div>
    
           

 </div><!-- /.box-body -->

                  <div class="box-footer">
                   <input type="hidden" name="refid" value="<?php echo $refid;  ?>" /> 
                   <button type="submit" name="btnSave"  class="btn btn-success"><i class="fa fa-trash-o"></i> Save and Drop</button>
                  </div>
                </form>
                
  <?php
}
?>

                
              </div><!-- /.box -->
</div>

 <div class="col-md-6">
  <!-- TO DO List -->
   <?php
    $showUserid=$_SESSION['homsuser'];
   	require_once("../class/pagination.php");
   	$page=new pagination();
   	$page->perpage=10;
	$page->show=3;
	$page->con=$con;
	$page->query="select a.rid from `response` a, `response_category` b, `enquiry` c where a.rstatus='1' and a.rtype=b.rtid AND c.`eid`=a.Enquiry_id  AND c.`eid`='$refid' order by a.rdate ASC";
   ?>
              <div class="box box-success">
                <div class="box-header">
               
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Follow-ups </h3>
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
$select="select a.rdate, b.name, a.remark, a.Enquiry_id, a.rid  from `response` a, `response_category` b, `enquiry` c where a.rstatus='1' and a.rtype=b.rtid AND c.`eid`=a.Enquiry_id  AND c.`eid`='$refid' order by a.rdate ASC LIMIT $pstart,$perpage";

//echo $select;
  $result=mysqli_query($con, $select);
while($row=mysqli_fetch_array($result))
  {
  ?>
                    <li>
                      <span class="handle">
                        <i class="fa fa-calendar"></i>
                         <small class="label label-default"><?php echo $row["rdate"];?></small>
                      </span>
                      <span class="text"><?php echo $row["name"];if($row["remark"]!=''){echo " - ".$row["remark"];}?></span>
                      <div class="tools">
          <form  action="" method="post">
          <input type="hidden" name="refid" value="<?php echo $row["Enquiry_id"];?>" /> 
         <input name="edit" type="hidden" value="<?php echo $row["rid"];?>"/><button type="submit" name="view" style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-eye"></i></button>
          <button type="submit" name="delt" onClick="return confirm('Are you sure you want to delete this?');" style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-trash-o"></i></button>
         
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
       

<?php 
if(isset($_POST["view"]))
{
	$editId=$_POST["edit"];
//	echo "you are editting";
	$editSelect="SELECT a.*, b.name FROM `response` a, `response_category` b WHERE a.rtype=b.rtid and a.`rid`='$editId'";
	$result=mysqli_query($con, $editSelect);
	while($editRow=mysqli_fetch_array($result))
	{
?>
 <!----------------------------------------------VIEW---------------------------------------------------->
                
                <div class="box-body">
                <table class="table table-condensed">
                    <tbody>
                    
                    <tr>
                      <th>Date &amp; Time</th>
                      <th><?php echo $editRow["rdate"]." ".$editRow["rtime"];?></th>
					 </tr>
                     
                      <tr>
                      <th>Response Category</th>
                      <td><?php echo $editRow["name"];?></td>
					 </tr>
                     
                     <tr>
                      <th>Remark</th>
                      <td><?php echo $editRow["remark"];?></td>
					 </tr>
                     
                      <tr>
                      <th>Next Follow-Up date and Time</th>
                      <th><?php echo $editRow["FUDate"]." ".$editRow["FUTime"];?></th>
					 </tr>
                     
                      <tr>
                      <th>Follow-Up Subject</th>
                      <td><?php echo $editRow["FUTitle"];?></td>
					 </tr>
                     
                     </tbody>
                 </table>
</div>
<?php
	}
}
?>
             <?php } ?>   
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
     
     <!-- Page script -->
    <script type="text/javascript">
      $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                  ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                  },
                  startDate: moment().subtract('days', 29),
                  endDate: moment()
                },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>

   
  </body>
</html>
<?php
}
?>