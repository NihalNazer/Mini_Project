<?php include("../config/conntme.php"); ?>
<?php
//validation for bpe page;
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
<!DOCTYPE html>
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
           <li class="active"><i class="fa fa-smile-o"></i>Customers</li>
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
               <i class="fa  fa-smile-o"></i>
                  <h3 class="box-title">Customer</h3>
                </div><!-- /.box-header -->


 <div class="my-box">   
 <?php
 if(isset($_POST["btnRef"]))
 {
	 $refid=$_POST["refid"];
	 
			$selectConv="select `rid` from `response` where `Enquiry_id`='$refid' and `rtype`=11 and `rstatus`=1";
  $resultConv=mysqli_query($con, $selectConv);
  if(mysqli_num_rows($resultConv)>=1)
	{
	}
	else
	{
		$insertConv="INSERT INTO `response` (`rid`, `rtype`, `rdate`, `rtime`, `uid`, `rstatus`, `remark`, `Enquiry_id`) VALUES (NULL,'11', '$CurrentDate', '$CurrentTime', '$user', '1', '', '$refid')";
		mysqli_query($con, $insertConv);
	}
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
else
{
	echo"<script type=\"text/javascript\">
 window.location.assign(\"javascript:history.go(-1)\")
</script>";	
}
 ?>
 
 <?php
  if(isset($refid) && $refid!='')
  {
	  $selectLead="SELECT * FROM `enquiry` WHERE `eid`=$refid";
	  //echo $selectLead;
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
	$delete="UPDATE `customer` SET `Status`='0' WHERE `customerid`='$did'";
	//echo $delete;
	//mysqli_query($con, $delete);
	echo "<div class=\"alert alert-info alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-info\"></i> Alert!</h4>
                   Removed Successfully...
                  </div>";
}
?>
             
<?php
if(isset($_POST["btnSave"]))
{		
//------from session--------
$enq=$refid;
//------from session--------

$name=$_POST["txtName"];
//$district=$_POST["ddlDistrict"];

$house=$_POST["txtHouse"];
$place=$_POST["txtPlace"];

$primaryPost=$_POST["ddlPost"];
$selectPost="select a.Pincode, a.Officename, c.Did, a.Pid from `pin` a, `taluk` b, `district` c where a.Pid='$primaryPost' and a.Taluk=b.Tid and b.Did=c.Did  and a.Status='1'";
$resultPost=mysqli_query($con, $selectPost);
$rowPost=mysqli_fetch_array($resultPost);

$pin=$rowPost["Pincode"];
$district=$rowPost["Did"];
$landmark=$_POST["txtLandmark"];
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

if($name!='' && $district!='' && $house!='' && $place!='' && $primaryPost!='' && $pin!=''&& $ccode1!='' && $contactNumber1!='')
{
	$query="select `customerid` from `customer` where `contactNum1`='$contactNumber1' && `Country_code1`='$ccode1' &&  `name`='$name' and `Status`=1";
//	echo $query;
	$queryResult=mysqli_query($con, $query);
	if(mysqli_num_rows($queryResult)>=1)
	{
	  echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    CUSTOMER: $name ALREADY EXISTING IN THIS MOBILE NUMBER: $contactNumber1 ...
                  </div>";
  }//exist check
  else
  {		

  		
$insertQuery="insert into `customer` (`customerid`,`userid`,`CuDate`,`CuTime`,`name`,`districtid`,`housename`,`place`,`post`,`pin`,`landmark`,`Country_code1`,`contactNum1`,`Country_code2`,`contactNum2`,`Email`,`Remark`,`upsell_possibility`, `PDDate`, `PDTime`, `Status`) values (NULL,'$userId','$CurrentDate','$CurrentTime','$name','$district','$house','$place','$primaryPost','$pin','$landmark','$ccode1','$contactNumber1','$ccode2','$contactNumber2','$email','$remark','$upsell','$pdDate','$pdTime','1')";
//	echo $insertQuery;
	mysqli_query($con, $insertQuery);
	$aquery="select `customerid` from `customer` where `Country_code1`='$ccode1' &&`contactNum1`='$contactNumber1' && `name`='$name' and `Status`=1";
//	echo $query;
	$aqueryResult=mysqli_query($con, $aquery);
	if(mysqli_num_rows($aqueryResult)>=1)
	{
		$arowqueryResult=mysqli_fetch_array($aqueryResult);
		$custumercode=$arowqueryResult["customerid"];
		
	$updateEnq="UPDATE `enquiry` SET `customerid`='$custumercode' WHERE `eid`='$refid'";
	mysqli_query($con, $updateEnq);
	}
	
	
	echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                   Customer Added Successfully...
                  </div>";
				 $name=$district=$house=$place=$primaryPost=$pin=$landmark=$contactNumber1=$contactNumber2=$email=$remark=$upsell=$dateTime=NULL;

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

<?php
if(isset($_POST["btnEdit"]))
{
//------from session--------
$enq=$refid;

//------from session--------
$eName=$_POST["txteName"];
	//$eDistrict=$_POST["ddlEdtDistrict"];
	$eHouse=$_POST["txteHouse"];
	$ePlace=$_POST["txtePlace"];
	
	$ePost=$_POST["ddlEdtPost"];
$selectPost="select a.Pincode, a.Officename, c.Did, a.Pid from `pin` a, `taluk` b, `district` c where a.Taluk=b.Tid and b.Did=c.Did and a.Pid='$ePost' and a.Status='1'";
$resultPost=mysqli_query($con, $selectPost);
$rowPost=mysqli_fetch_array($resultPost);
$ePinNum=$rowPost["Pincode"];
$eDistrict=$rowPost["Did"];
	
	$eLandmark=$_POST["txteLandmark"];
	//$edtCountry1=$_POST["ddlEdtCountryCode1"];
	$edtCountry1="91";
	//$edtCountry2=$_POST["ddlEdtCountryCode2"];
	$edtCountry2="91";
	
	if(strlen(intval($_POST["txteMobile"]))==10)
{
	$edtContact1=$_POST["txteMobile"];
}
else
{
	$edtContact1='';
}
if(strlen(intval($_POST["txteLandline"]))==10)
{
	$edtContact2=$_POST["txteLandline"];
}
else
{
	$edtContact2='';
}
	$eEmail=$_POST["txteEmail"];
	$eRemark=$_POST["txtAreaeRemark"];	
	if(isset($_POST["checkboxEdtUpsell"]))
	{
		$edtUpsell=1;
	}
	else
	{
		$edtUpsell=0;
	}
	$hid=$_POST["hid"];
	 $user_Id=$user;
	 
$edateTime=$_POST["EdtDateAndTime"];
//echo $dateTime;
$epdDate=date("Y-m-d", strtotime($edateTime));
$epdTime=date("H:i:s", strtotime($edateTime));

if($eName!='' && $eDistrict!='' && $eHouse!='' && $ePlace!='' && $ePlace!='' && $ePost!=''&& $edtCountry1!='' && $edtContact1!='')
	{
		$querySelect="SELECT * FROM  `customer` WHERE `Country_code1`='$edtCountry1' and `contactNum1` ='$edtContact1'  and  `Country_code2`='$edtCountry2' and `contactNum2` ='$edtContact2'  and `customerid`!='$hid'";
		$resultCustomer=mysqli_query($con, $querySelect);
		//echo $querySelect;
		if(mysqli_num_rows($resultCustomer)>=1)
		{
			 echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    CUSTOMER: $eName  ALREADY EXISTING IN THIS PHONE NUMBER: $edtCountry1 $edtContact1 ...
                  </div>";
		}
		
		else
		{
			
	$updateQuery="UPDATE `customer` SET `name`='$eName',`districtid`='$eDistrict',`housename`='$eHouse',`place`='$ePlace',`post`='$ePost',`pin`='$ePinNum',`landmark`='$eLandmark',`Country_code1`='$edtCountry1',`contactNum1`='$edtContact1',`Country_code2`='$edtCountry2',`contactNum2`='$edtContact2',`Email`='$eEmail',`Remark`='$eRemark',`upsell_possibility`='$edtUpsell',`Status`='1' ,`PDDate`='$epdDate' ,`PDTime`='$epdTime' WHERE `customerid`=$hid";
		//echo $updateQuery;
		mysqli_query($con, $updateQuery);
		
		echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                   Updated Successfully...
                  </div>";
		}
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
</div>


<?php 
if(isset($_POST["btnRef"]) || isset($_POST["btnSave"]) || isset($_POST["btnEdit"]))
{
	$editId=$refid;
	
	$selectEnquiry="Select `customerid` from `enquiry` where `eid`='$editId'";
	$resultEnquiry=mysqli_query($con, $selectEnquiry);
	while($rowEnquiry=mysqli_fetch_array($resultEnquiry))
	{
		$custumer=$rowEnquiry["customerid"];
	}
	if($custumer!='0')
	{
	
//	echo "you are editting";
	$editSelect="SELECT * FROM `customer` WHERE `customerid`='$custumer'";
//	echo $editSelect;
	$result=mysqli_query($con, $editSelect);
	while($editRow=mysqli_fetch_array($result))
	{
?>
<!----------------------------------EDIT WAREHOUSE---------------------------------->
<form role="form" method="post" >
                  <div class="box-body">
              
                           
                   <div class="form-group">
                      <label for="Name">Full Name of the Customer<span style="color:#FF0000">*</span></label>
                      <input id="Name" class="form-control" placeholder="Customer Name" name="txteName" type="text" value="<?php echo $editRow["name"];?>"/>
                    </div> 
                 
                  
                   <div class="form-group">
                   <label for="house">House Name<span style="color:#FF0000">*</span></label>
                   <input id="house" class="form-control" placeholder="House Name" name="txteHouse" type="text"  value="<?php echo $editRow["housename"];?>"/>
                   </div>
              
              <div class="form-group">
                   <label for="place">Location<span style="color:#FF0000">*</span></label>
                   <input id="place" class="form-control" placeholder="Place" name="txtePlace" type="text" value="<?php echo $editRow["place"];?>"/>
                   </div>
                   
               <div class="form-group">
                   <label for="landmark">Landmark</label>
                   <input id="landmark" class="form-control" placeholder="Landmark" name="txteLandmark" type="text" value="<?php echo $editRow["landmark"];?>" />
                   </div>
                    <div class="form-group">
             		<label for="post">Post Office &amp; PIN<span style="color:#FF0000">*</span></label>
                   
           
                   <select id="post" style="width:100%;"  name="ddlEdtPost">
          <option value="">Select</option>
           <!--post office added-->
      <?php 
	  $editPostId=$editRow["post"];

		  $selectPostQuery="select a.Pincode, a.Officename, c.District, a.Pid from `pin` a, `taluk` b, `district` c where a.Taluk=b.Tid and b.Did=c.Did and a.Pid='$editPostId' and a.Status='1'";
	  $resultpost=mysqli_query($con, $selectPostQuery);
	  while($resultpostRow=mysqli_fetch_array($resultpost))
	  {
	  ?>
      <option selected="selected" value="<?php echo @$resultpostRow["Pid"];?>"><?php echo @$resultpostRow["Officename"];?> &raquo; <?php echo @$resultpostRow["District"];?></option>    
      <?php
	  }
	  ?>
          <?php
		   if(isset($_POST["pinc"]) && $_POST["pinc"]!=0)
 {
	 $did=$_POST["pinc"];
	 $SelectArea="select a.Pincode, a.Officename, c.District, a.Pid from `pin` a, `taluk` b, `district` c  where a.Pincode='$did' and a.Taluk=b.Tid and b.Did=c.Did and a.Status=1 order by Officetype DESC, Officename ASC";
 }
 else
 {
	 $SelectArea="select a.Pincode, a.Officename, c.District, a.Pid from `pin` a, `taluk` b, `district` c  where a.Taluk=b.Tid and b.Did=c.Did and a.Status=1";
 }
			   $ResultArea=mysqli_query($con, $SelectArea);
			   while($RowArea=mysqli_fetch_array($ResultArea))
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
                   <label for="num1">Contact Number 1<span style="color:#FF0000">*</span></label>
    
    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
    
    <input name="txteMobile" id="num1" placeholder="Phone Number" class="form-control" type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"  readonly data-inputmask="&quot;mask&quot;: &quot;9999999999&quot;" data-mask=""  value="<?php echo $editRow["contactNum1"];?>" />
    </div>
                   </div>
                   
                    <div class="form-group">
                   <label for="num2">Contact Number 2</label>
         
    
      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
    <input id="num2" class="form-control" placeholder="Phone Number" name="txteLandline" type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" value="<?php echo $editRow["contactNum2"];?>"  data-inputmask="&quot;mask&quot;: &quot;9999999999&quot;" data-mask=""   />
                   </div>
                   </div>
             
             <div class="form-group">
                   <label for="mail">Email</label>
                   <input id="mail" name="txteEmail" class="form-control" type="email" placeholder="example@abc.com" value="<?php echo $editRow["Email"];?>"/>
                   </div>
             
             <div class="form-group">
             <label for="remark">Remark</label>
             <textarea id="remark" class="form-control" placeholder="Remark" name="txtAreaeRemark"><?php echo $editRow["Remark"];?></textarea>
             </div>
             
             <div class="form-group">
             <label>
             <?php 
	if($editRow["upsell_possibility"]==1)
	{
		?>
         <input type="checkbox" id="upsell" value="1"  name="checkboxEdtUpsell" checked="checked" />      
        <?php
	}
	else
	{
		?>
         <input type="checkbox" id="upsell" value="1"  name="checkboxEdtUpsell" />    
        <?php		
	}
	?>
    Upsell Possibility
    </label>  
             </div>

  <hr/>
             
               <div class="form-group">
                     <label for="dateTime">Prefered Date and Time for Delivery</label>
                     <input name="EdtDateAndTime" id="dateTime" placeholder="Date and Time" class="form-control" type="datetime-local" value="<?php echo $editRow["PDDate"]."T".$editRow["PDTime"];?>" />
                     
                    </div>
                
                </div><!-- /.box-body -->

                  <div class="box-footer">
                  <input type="hidden" name="hid" value="<?php echo $editRow["customerid"]; ?>" />
                 <input type="hidden" name="refid" value="<?php echo $refid;?>" />
                 <input type="hidden" name="pinc" value="<?php echo $did;  ?>" />
                  <button type="submit" name="btnEdit"  class="btn btn-primary"><i class="fa fa-save"></i> Save Customer Details</button>
                  </div>
                </form>
                <div class="box-footer">
                 <form action="order.php" method="post">
                  <input type="hidden" name="refid" value="<?php echo $refid;?>" /> 
					<button type="submit" name="btnRef"  class="btn btn-info"><i class="fa fa-shopping-cart"></i> Proceed to Order</button>
                 </form> 
                 </div>

                  <div class="box-footer">
                 <form action="bulk-order.php" method="post">
                  <input type="hidden" name="refid" value="<?php echo $refid;?>" /> 
					<button type="submit" name="btnRef"  class="btn btn-success"><i class="fa fa-truck"></i> Bulk Order Entry</button>
                 </form> 
                 </div>               
                    
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
                   <label for="name">Full Name of the Customer<span style="color:#FF0000">*</span></label>
 <input  id="inputTextBox" class="form-control" placeholder="Customer Name" name="txtName" value="<?php echo @$name;?>"/>
                    </div> 
                 
                  
                   <div class="form-group">
                   <label for="district">House Name<span style="color:#FF0000">*</span></label>
                   <input id="house" class="form-control" placeholder="House Name" name="txtHouse" type="text" value="<?php echo @$house?>"/>
                   </div>
              
              <div class="form-group">
                   <label for="place">Location<span style="color:#FF0000">*</span></label>
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

		  $selectPostQuery="select a.Officename, c.District, a.Pid from `pin` a, `taluk` b, `district` c  where a.Taluk=b.Tid and b.Did=c.Did and a.Pid='$editPostId' and a.Status='1'";
	  $resultpost=mysqli_query($con, $selectPostQuery);
	  while($resultpostRow=mysqli_fetch_array($resultpost))
	  {
	  ?>
      <option selected="selected" value="<?php echo @$resultpostRow["Pid"];?>"><?php echo @$resultpostRow["Officename"];?> &raquo; <?php echo @$resultpostRow["District"];?></option>    
      <?php
	  }
	  ?>
          <?php
		   if(isset($_POST["pinc"]) && $_POST["pinc"]!=0)
 {
	 $did=$_POST["pinc"];
	 $SelectArea="select a.Pincode, a.Officename, c.District, a.Pid from `pin` a, `taluk` b, `district` c  where a.Pincode='$did' and a.Taluk=b.Tid and b.Did=c.Did and a.Status=1 order by Officetype DESC, Officename ASC";
 }
 else
 {
	 $SelectArea="select a.Pincode, a.Officename, c.District, a.Pid from `pin` a, `taluk` b, `district` c  where a.Taluk=b.Tid and b.Did=c.Did and a.Status=1";
 }
			   $ResultArea=mysqli_query($con, $SelectArea);
			   while($RowArea=mysqli_fetch_array($ResultArea))
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
                   <label for="num1">Contact Number 1<span style="color:#FF0000">*</span></label>
                 
 <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                      
                      <?php
					  $selectPhone="select `vnum` from `enquiry` where `eid`=$refid";
					  $resultPhone=mysqli_query($con, $selectPhone);
					  while($rowPhone=mysqli_fetch_array($resultPhone))
					  {
					  ?>
                      <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;9999999999&quot;" data-mask="" id="num1" placeholder="Phone Number" name="txtMobile"  onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" value="<?php echo substr($rowPhone["vnum"], -10);//@$contactNumber1?>" readonly >
                      <?php
					  }
					  ?>
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
                   <input type="hidden" name="pinc" value="<?php echo $did;  ?>" />
                   <button type="submit" name="btnSave"  class="btn btn-primary"><i class="fa fa-save"></i> Save Customer Details</button>
                  </div>
                </form>
                
  <?php
}
}
?>

                
              </div><!-- /.box -->
</div>



 <div class="col-md-6">
  <!-- TO DO List -->
   <?php
   $selectCustomer="Select `customerid` From `enquiry` where `eid`='$refid' AND `status`=1";
   $resultCustomer=mysqli_query($con, $selectCustomer);
   $rowCustomer=mysqli_fetch_array($resultCustomer);
   $custid=$rowCustomer["customerid"];
   
    $showUserid=$_SESSION['homsuser'];
   	require_once("../class/pagination.php");
   	$page=new pagination();
   	$page->perpage=10;
	$page->show=3;
	$page->con=$con;
	$page->query="SELECT a.*, b.*, c.* , g.* FROM  `order_split` a, `order` b, `product` c, `order_status` g WHERE a.Orderid=b.oid AND a.Ccode=c.pid AND  b.customerid='$custid' and g.OsId=b.oFlag order by b.oid DESC";
   ?>
              <div class="box box-success">
                <div class="box-header">
               
                  <i class="fa fa-shopping-cart"></i>
                  <h3 class="box-title">Recent Orders</h3>
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
$select="SELECT b.date, b.oid, a.Citem, a.Qty, g.OsName FROM  `order_split` a, `order` b, `product` c, `order_status` g WHERE a.Orderid=b.oid AND a.Ccode=c.pid AND  b.customerid='$custid' and g.OsId=b.oFlag order by b.oid DESC LIMIT $pstart,$perpage";
//echo $select;
  $result=mysqli_query($con, $select);
while($row=mysqli_fetch_array($result))
  {
  ?>
                    <li>
                      <span class="handle">
                        <i class="fa fa-calendar"></i>
                          <small class="label label-default"><?php echo $row["date"]." #".$row["oid"];?></small>
                      </span>
                      <span class="text"><?php echo $row["Citem"]." (".$row["Qty"].") - ".$row["OsName"];?></span>
                     
                      
                      
                      <div class="tools">
          <form  action="show-invoice.php" method="post"  target="_blank">
          <input type="hidden" name="refid" value="<?php echo $row["eid"];?>" /> 
         <input name="edit" type="hidden" value="<?php echo $row["Osid"];?>"/>
          
          <button type="submit" name="btnShow" style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-eye"></i></button>
         
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