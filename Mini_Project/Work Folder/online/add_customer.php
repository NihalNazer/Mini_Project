<?php include("../config/conn.php"); ?>
<?php
//validation for admin page;
if(!isset($_SESSION['user']) || !isset($_SESSION['utype']) ||($_SESSION['utype']!=3))
{
	echo"<script type=\"text/javascript\">
 window.location.assign(\"../login\")
</script>";	
}
else
{
	/*require_once("../class/user.php");
   	$userclass=new users();
   	$userclass->user=$_SESSION['user'];
	$userclass->userinfo();*/
	$user=$_SESSION['user'];
?>
<?php include("../template.inc.php"); ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
 
  <?php  head_part(); ?>
   <script>
$(document).ready(function(){
    $("#inputTextBox").keypress(function(event){
        var inputValue = event.which;
        // allow letters and whitespaces only.
        if((inputValue > 47 && inputValue < 58) && (inputValue != 32)){
            event.preventDefault();
        }
    });
});
</script>
  <body class="skin-blue">
    <div class="wrapper">

      	<?php top(); ?>
      <!-- Left side column. contains the logo and sidebar -->
   <?php  super_nav(); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Supervisor
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
             <!-- <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Control Panel</a></li>
            <li class="active"><i class="fa fa-smile-o"></i> Cutomer</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
    
<!----------------------------------------------------PAGE CONTENTS START HERE ------------------------------------------------->
<div class="row">             

 <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
               <i class="fa fa-smile-o"></i>
                  <h3 class="box-title">Customer</h3>
                </div><!-- /.box-header -->


<div class="my-box">
				<?php
if(isset($_POST["btnSave"]))
{		
//------from session--------
$enq=0;
//------from session--------

$name=$_POST["txtName"];
//$district=$_POST["ddlDistrict"];

$house=$_POST["txtHouse"];
$place=$_POST["txtPlace"];

$primaryPost=$_POST["ddlPost"];
$selectPost="SELECT * FROM `pin` WHERE `Pid`='$primaryPost' AND `Status`=1 ";
$resultPost=mysql_query($selectPost);
$rowPost=mysql_fetch_array($resultPost);

$pin=$rowPost["Pincode"];

//$taluk=$_POST["ddlTaluk"];
$primaryLocation=$_POST["ddlLocation"];
$selectLocation="SELECT * FROM `location` WHERE `Lid`='$primaryLocation' AND `Status`='1'";
$resultLocation=mysql_query($selectLocation);
$rowLocation=mysql_fetch_array($resultLocation);
$district=$rowLocation["district_id"];


$landmark=$_POST["txtLandmark"];
$town=$_POST["ddltown"];
//$ccode1=$_POST["ddlCountryCode1"];
$ccode1="91";
//$ccode2=$_POST["ddlCountryCode2"];
$ccode2="91";


if(strlen(intval($_POST["txtMobile"]))==10)
{
$contactNumber1=$_POST["txtMobile"];
} 
else
{
	$contactNumber1='';
}

if(strlen(intval($_POST["txtLandline"]))==10)
{
$contactNumber2=$_POST["txtLandline"];
}
else
{
	$contactNumber2='';
}

$email=$_POST["txtEmail"];
$remark=$_POST["txtAreaRemark"];
if(isset($_POST["chkboxUpsell"]))
{
$upsell=1;
}
else
{
	$upsell=0;
}
$userId=$user;

$dateTime=$_POST["txtDateAndTime"];
//echo $dateTime;
$pdDate=date("Y-m-d", strtotime($dateTime));
$pdTime=date("H:i:s", strtotime($dateTime));


if($name!='' && $district!='' && $house!='' && $place!='' && $primaryPost!='' && $pin!='' &&$primaryLocation!='' && $town!='' && $ccode1!='' && $contactNumber1!='')
{
	$query="select * from `customer` where `Country_code1`='$ccode1' &&`contactNum1`='$contactNumber1' && `name`='$name' and `Status`=1";
//	echo $query;
	$queryResult=mysql_query($query);
	if(mysql_num_rows($queryResult)>=1)
	{
	  echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    CUSTOMER: $name ALREADY EXISTING IN THIS MOBILE NUMBER: $contactNumber1 ...
                  </div>";
  }//exist check
  else
  {
	  date_default_timezone_set('Asia/Kolkata');
					$CurrentDate=date('Y-m-d');
					$CurrentTime=date("h:i:s A");
					
$insertQuery="insert into `customer` (`customerid`,`userid`,`CuDate`,`CuTime`,`name`,`districtid`,`housename`,`place`,`post`,`pin`,`locationid`,`landmark`,`city_id`,`Country_code1`,`contactNum1`,`Country_code2`,`contactNum2`,`Email`,`Remark`,`upsell_possibility`, `PDDate`, `PDTime`,`Status`) values (NULL,'$userId','$CurrentDate','$CurrentTime','$name','$district','$house','$place','$primaryPost','$pin','$primaryLocation','$landmark','$town','$ccode1','$contactNumber1','$ccode2','$contactNumber2','$email','$remark','$upsell','$pdDate','$pdTime','1')";
//	echo $insertQuery;
	mysql_query($insertQuery);
	
	
	
	$aquery="select * from `customer` where `Country_code1`='$ccode1' &&`contactNum1`='$contactNumber1' && `name`='$name' and `Status`=1";
//	echo $query;
	$aqueryResult=mysql_query($aquery);
	if(mysql_num_rows($aqueryResult)>=1)
	{
		$arowqueryResult=mysql_fetch_array($aqueryResult);
		$custumercode=$arowqueryResult["customerid"];
		
	//$updateEnq="UPDATE `enquiry` SET `customerid`='$custumercode' WHERE `eid`='$refid'";
	//mysql_query($updateEnq);
	}
	
	
	echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                   Customer Added Successfully...
                  </div>";
				 $name=$district=$house=$place=$primaryPost=$pin=$primaryLocation=$landmark=$contactNumber1=$contactNumber2=$email=$remark=$upsell=NULL;
				 echo"<script type=\"text/customer_search.php\")
</script>";	

  }//not exist
}
else
{
	echo"<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>
                    Please fill mandatory fields...
                  </div>";
}
}//event
?>
</div>
 <!----------------------------------------------ADD NEW---------------------------------------------------->
                <!-- form start -->
                
                <form role="form" method="post" >
                  <div class="box-body">
        
                   <div class="form-group">
                   <label for="name">Full Name of the Customer<span style="color:#FF0000">*</span></label>
 <input  id="inputTextBox" class="form-control" placeholder="Customer Name" name="txtName" value="<?php echo @$name;?>"/>
                    </div> 
                 
                  
                   <div class="form-group">
                   <label for="district">House Name<span style="color:#FF0000">*</span></label>
                   <input id="house" class="form-control" placeholder="House Name" name="txtHouse" type="text" value="<?php echo @$house?>"/>
                   </div>
              
              <div class="form-group">
                   <label for="place">Place<span style="color:#FF0000">*</span></label>
                   <input id="place" class="form-control" placeholder="Place" name="txtPlace" type="text" value="<?php echo @$place
	?>" />
                   </div>
                   
               <div class="form-group">
                   <label for="landmark">Landmark</label>
                   <input id="landmark" class="form-control" placeholder="Landmark" name="txtLandmark" type="text" value="<?php echo @$landmark?>"/>
                   </div>
                   
       
                   <div class="form-group">
                   <label for="post">Post Office &amp; PIN<span style="color:#FF0000">*</span></label>
                   
                   <select id="post" style="width:100%;"  name="ddlPost">
          <option value="">Select</option>
           <!--post office added-->
      <?php 
	  $editPostId=@$primaryPost;

		  $selectPostQuery="select a.*, b.*, c.* from `pin` a, `taluk` b, `district` c where a.Taluk=b.Tid and b.Did=c.Did and a.Pid='$editPostId' and a.Status='1'";
	  $resultpost=mysql_query($selectPostQuery);
	  while($resultpostRow=mysql_fetch_array($resultpost))
	  {
	  ?>
      <option selected="selected" value="<?php echo @$resultpostRow["Pid"];?>"><?php echo @$resultpostRow["Officename"];?> &raquo; <?php echo @$resultpostRow["District"];?></option>    
      <?php
	  }
	  ?>
          <?php
			   //$SelectArea="select a.*, b.*, c.* from `pin` a, `taluk` b, `district` c where a.Taluk=b.Tid and b.Did=c.Did and a.Status=1 AND a.PinFlag!=1";
			   $SelectArea="select a.*, b.*, c.* from `pin` a, `taluk` b, `district` c where a.Taluk=b.Tid and b.Did=c.Did and a.Status=1";
			   $ResultArea=mysql_query($SelectArea);
			   while($RowArea=mysql_fetch_array($ResultArea))
			   {
			   ?>
          <option value="<?php echo $RowArea["Pid"];?>"> <?php echo $RowArea["Pincode"];?> - <?php echo $RowArea["Officename"];?> 
          &raquo; <?php echo $RowArea["District"];?>
          </option>
          <?php
		}
		?>
    </select>
                   
				  </div>
                   
                   
                   <div class="form-group">
                   <label for="states"> Panchayat / Municipality / Corporation <span style="color:#FF0000">*</span></label>
                   
                   <select style="width:100%;" id="states" name="ddlLocation">
                      
                      <?php
					  if(@$primaryLocation!='' || @$primaryLocation!=0)
	{
		$NewArea=@$primaryLocation;
		$NewSelectArea="SELECT * FROM  `location` WHERE `Status`=1 AND `Lid`='$NewArea'";
		//echo $NewSelectArea;
			   $NewResultArea=mysql_query($NewSelectArea);
			   while($NewRowArea=mysql_fetch_array($NewResultArea))
			   {
				   ?>
                   <option value="<?php echo $NewRowArea["Lid"];?>">
                   <?php echo $NewRowArea["Location"];?>
                    - 
					<?php
						$type= $NewRowArea["type"]; 
						if($type==1){ echo "Panchayat";}
						elseif($type==2){ echo "Municipality";}
						elseif($type==3){ echo "Corporation";}
						else{ echo "Unknown";}
						?>
                   </option>
                   <?php
			   }
	}
					  ?>
                      
        <option value="">Select</option>
        <?php
		$SelectDist="SELECT * FROM `district` Where `Status`='1' order by `District` ASC";
		$ResultDist=mysql_query($SelectDist);
		while($RowDist=mysql_fetch_array($ResultDist))
		{
		?>
               <optgroup label="<?php echo $RowDist["District"];?>">
               
               <?php
			   $dist=$RowDist["Did"];
			   //$SelectArea="SELECT * FROM  `location` WHERE `Status`=1 AND `LFlag`!=1 AND `district_id`='$dist'";
			   $SelectArea="SELECT * FROM  `location` WHERE `Status`=1 AND `district_id`='$dist'";
			   $ResultArea=mysql_query($SelectArea);
			   while($RowArea=mysql_fetch_array($ResultArea))
			   {
			   ?>
                   <option value="<?php echo $RowArea["Lid"];?>">
                   <?php echo $RowArea["Location"];?>
                    - 
					<?php
						$type= $RowArea["type"]; 
						if($type==1){ echo "Panchayat";}
						elseif($type==2){ echo "Municipality";}
						elseif($type==3){ echo "Corporation";}
						else{ echo "Unknown";}
						?>
                   </option>
                <?php
			   }
			   ?>
               </optgroup>
        <?php
		}
		?>
              </select>
                   </div>
                   

                         <div class="form-group">
                   <label for="citys">City<span style="color:#FF0000">*</span></label>
                   <select id="citys"  style="width:100%;"   name="ddltown" >
      <option value="">SELECT</option>
        <!--city added-->
      <?php 
	  $edtId=@$town;
	//  echo $editTalukId;
	  $selectCityQuery="select a.*, b.* from `city` a, `district` b where a.Tid=b.Did AND a.`cid`='$edtId' and a.`Status`='1' order by a.`City` ASC";
	  $resultCity=mysql_query($selectCityQuery);
	  while($resultCityRow=mysql_fetch_array($resultCity))
	  {
	  ?>
      <option selected="selected" value="<?php echo @$resultCityRow["cid"];?>"><?php echo $resultCityRow["City"]." (".$resultCityRow["District"].")";?> </option>    
      <?php
	  }
	  ?>
        <!--other cities into dropdown-->
      <?php 
	  $selectOtherCitiesQuery="select a.*, b.* from `city` a, `district` b where a.Tid=b.Did AND a.`cid`!='$edtId' and a.`Status`='1' order by a.`City` ASC";
	  $resultCityQuery=mysql_query($selectOtherCitiesQuery);
	  while($rowCities=mysql_fetch_array($resultCityQuery))
	  {
	 ?>
     <option value="<?php echo @$rowCities["cid"];?>"><?php echo $rowCities["City"]." (".$rowCities["District"].")";?> </option>
     <?php
	  }
	  ?>
      </select>
                   </div>
                   
                   <div class="form-group">
                   <label for="num1">Contact Number 1<span style="color:#FF0000">*</span></label>
                 
 <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                      
                     
                      <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;9999999999&quot;" data-mask="" id="num1" placeholder="Phone Number" name="txtMobile"  onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" value="<?php echo @$contactNumber1?>">
                                            
                    </div><!-- /.input group -->
                   
                   </div>
                   
                    <div class="form-group">
                   <label for="num2">Contact Number 2</label>
                 
   
     <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                      <input  data-inputmask="&quot;mask&quot;: &quot;9999999999&quot;" data-mask=""  name="txtLandline" id="num2" class="form-control" placeholder="Phone Number" type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" value="<?php echo @$contactNumber2?>" />
    
                    </div><!-- /.input group -->
                   
                   </div>
                   
                   
                   
                   <div class="form-group">
                   <label for="mail">Email</label>
                   <input id="mail" class="form-control" name="txtEmail" type="email" placeholder="example@abc.com" value="<?php echo  @$email?>"/>
                   </div>
             
             <div class="form-group">
             <label for="remark">Remark</label>
             <textarea id="remark" class="form-control" placeholder="Remark" name="txtAreaRemark" cols="" rows=""><?php echo @$remark;?></textarea>
             </div>
             
             <div class="form-group">
             
             
             <label>
             
         <?php 
	if(@$upsell==1)
	{
		?>
        
          <input id="upsell"  name="chkboxUpsell" type="checkbox" value="1" checked="checked" />      
        <?php
	}
	else
	{
		?>
         <input id="upsell" name="chkboxUpsell" type="checkbox" value="1" />    
        <?php		
	}
	?>    
     Upsell Possibility
    </label>
             </div>
             
                      
             <hr/>
             
               <div class="form-group">
                     <label for="dateTime">Prefered Date and Time for Delivery</label>
                     <input name="txtDateAndTime" id="dateTime" placeholder="Date and Time" class="form-control" type="datetime-local" value="<?php echo @$dateTime;?>" />
                     
                    </div>
          
      
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                   <input type="hidden" name="refid" value="<?php echo $refid;  ?>" /> 
                   <button type="submit" name="btnSave"  class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                  </div>
                </form>
                
 
 
 </div>
 </div>


</div>
<!----------------------------------------------------PAGE CONTENTS START HERE ------------------------------------------------->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php footer(); ?>
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