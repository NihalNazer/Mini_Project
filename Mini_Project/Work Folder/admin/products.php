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
            <li class="active"><i class="fa fa-user"></i> Options</li>
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
                  <h3 class="box-title">Manage Products</h3>
                </div><!-- /.box-header -->


 <div class="my-box">   
 
 <?php 
if(isset($_POST["delt"]))
{
	$did=$_POST["edit"];
	$delete="UPDATE `product` SET `status`='0' WHERE `pid`='$did'";
	mysqli_query($con, $delete);
	echo "<div class=\"alert alert-info alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-info\"></i> Alert!</h4>
                  Product Deleted Successfully...
                  </div>";
	
}
?>
                
<?php
if(isset($_POST["btnSave"]))
{	
	$product=$_POST["txtProduct"];
	$category=$_POST["ddlCategory"];
	$description=$_POST["txtareaDescription"];
	$dprice=$_POST["dprice"];
	$stock=$_POST["txtStock"];
	$reorder=$_POST["txtReorder"];
	$realPrice=$_POST["txtRealPrice"];
	$ad=$_POST["ad"];
  $dpriceb=$_POST["dpriceb"];
  $adb=$_POST["adb"];
	$dpricec=$_POST["dpricec"];
  $adc=$_POST["adc"];

	if($_POST["txtOfferPrice"]!='')
	{
	$offerPrice=$_POST["txtOfferPrice"];
	}
	else
	{
	$offerPrice=$realPrice;
	}
	
	if($product!='' && $category!='' && $description!='' && $dprice!='' && $stock!='' && $realPrice!='' && $ad!='')
	{	
		$query="select `pid` from `product` where `Product`='$product' and `status`='1'";
		$resultQuery=mysqli_query($con, $query);
		//echo $resultQuery;
		if(mysqli_num_rows($resultQuery)>=1)
		{
	  echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    The product '$product' is already existing...
                  </div>";
  }
  else
  {
	if($realPrice<=$offerPrice)
			{
				$insertQuery="insert into `product`(`pid`,`catid`,`Product`,`pdesc`,`aprice`,`bprice`,`cprice`,`stock`,`reorderlevel`,`rprice`, `aperc`, `bperc`,`cperc`,`oprice`,`status`)values (NULL,'$category','$product','$description','$dprice','$dpriceb','$dpricec', '$stock','$reorder','$realPrice', '$ad','$adb','$adc', '$offerPrice','1')";
$queryResult=mysqli_query($con, "$insertQuery");
//echo $queryResult;
	echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                    Added Successfully...
                  </div>";
$product=$category=$description=$dprice=$stock=$reorder=$realPrice=$offerPrice=$ad=$dpriceb=$adb=$dpricec=$adc=NULL;
			}
			else
			{
				echo"<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>
                   Special Order Price cannot be greater than  Retail Price ...
                  </div>";
			}

  }
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

<?php
if(isset($_POST["btnEdit"]))
{
	$hid=$_POST["hid"];
	$ProductName=$_POST["txtedtProduct"];
	$productCategory=$_POST["ddledtCategoryName"];
	$pdtDescription=$_POST["txtareaedtDescription"];
	$edprice=$_POST["edprice"];
  $edpriceb=$_POST["edpriceb"];
  $edpricec=$_POST["edpricec"];
	$stockLevel=$_POST["txtEdtStock"];
	$reorderLevel=$_POST["txteReorder"];
	$edtRealPrice=$_POST["txteRealPrice"];
	$advn=$_POST["advn"];
  $advnb=$_POST["advnb"];
  $advnc=$_POST["advnc"];
	if($_POST["txteOfferPrice"]!='')
	{
	$edtOfferPrice=$_POST["txteOfferPrice"];
	}
	else
	{
	$edtOfferPrice=$edtRealPrice;
	}
	if($ProductName!='' && $productCategory!='' && $pdtDescription!='' && $edprice!='' && $stockLevel!='' && $reorderLevel!='' && $edtRealPrice!='' && $advn!='')
{  
  $selectProduct="select `pid` from `product` where `Product`='$ProductName' and `pid`!='$hid'";
  $resultProduct=mysqli_query($con, $selectProduct);
  if(mysqli_num_rows($resultProduct)>=1)
 	 {
	   echo"<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-ban\"></i> Alert!</h4>
                    The product '$ProductName' is already existing...
                  </div>";
   }
  else
  {
	if($edtRealPrice<=$edtOfferPrice)
	{
		$updateQuery="update `product` set `catid`='$productCategory',`Product`='$ProductName',`pdesc`='$pdtDescription',`aprice`='$edprice',`bprice`='$edpriceb',`cprice`='$edpricec',`stock`='$stockLevel',`reorderlevel`='$reorderLevel',`rprice`='$edtRealPrice',`oprice`='$edtOfferPrice', `aperc`='$advn', `bperc`='$advnb',`cperc`='$advnc',`status`='1' where `pid`='$hid'";
	//echo $updateQuery;
	mysqli_query($con, $updateQuery);
	echo"<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4>	<i class=\"icon fa fa-check\"></i> Alert!</h4>
                    Updated Successfully...
                  </div>";
	$ProductName=$productCategory=$pdtDescription=$edprice=$edpriceb=$edpricec=$stockLevel=$reorderLevel=$edtRealPrice=$edtOfferPrice=$advn=$advnb=$advnc=NULL;	
	}
	else
	{
		echo"<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>
                    Special Order Price cannot be greater than Retail Price ...
                  </div>";
	}
	
	}
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
	//echo "You are editting";
	$selectQuery="select * from `product` where `pid`='$editId'";
	$resultSelectQuery=mysqli_query($con, $selectQuery);
	while($editRow=mysqli_fetch_array($resultSelectQuery))
	{
?>
<form role="form" method="post" >
                  <div class="box-body">
                    <div class="form-group">
                     <label for="pdtName">Product Name<span style="color:#FF0000">*</span></label>
                      <input id="pdtName" class="form-control" name="txtedtProduct" type="text" value="<?php echo $editRow["Product"]?>"/>
                    </div>
                    
                    <div class="form-group">
                    <label for="category">Category<span style="color:#FF0000">*</span></label>
                    <select id="category" class="form-control" name="ddledtCategoryName">
      
        <!--category added-->
      <?php 
	  $editCategoryId=$editRow["catid"];
	 echo  $editCategoryId;
	  $categoryQuery="select * from `product_category` where `catid`='$editCategoryId' and `status`='1' order by `product_category` ASC";
	  $resultCategory=mysqli_query($con, $categoryQuery);
	  while($resultCategoryRow=mysqli_fetch_array($resultCategory))
	  {
	  ?>
      <option value="<?php echo $resultCategoryRow["catid"];?>"><?php echo $resultCategoryRow["product_category"];?></option>    
      <?php
	  }
	  ?>
        <!--other categories into dropdown list-->
      <?php 
	  $categorySelectQuery="select * from `product_category` where `catid`!='$editCategoryId' and `status`='1' order by `product_category` ASC";
	  $resultCatgQuery=mysqli_query($con, $categorySelectQuery);
	  while($categoryRow=mysqli_fetch_array($resultCatgQuery))
	  {
	 ?>
     <option value="<?php echo $categoryRow["catid"];?>"><?php echo $categoryRow["product_category"];?> </option>
     <?php
	  }
	  ?>
      </select>
                    </div>
                    
                    <div class="form-group">
                    <label for="description">Description<span style="color:#FF0000">*</span></label>
                    <textarea id="description" class="form-control" name="txtareaedtDescription" cols="45" rows="5" ><?php echo $editRow["pdesc"];?></textarea>
                    </div>
                    
                    <div class="form-group">
                    <label for="dealer">Dealer Price (A Class Agent)<span style="color:#FF0000">*</span></label>
                    <input id="dealer" class="form-control" name="edprice" type="text" value="<?php echo $editRow["aprice"];?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" />
                    </div>
                    
                    <div class="form-group">
                    <label for="advance">Advance % on Dealer Price (A Class Agent)<span style="color:#FF0000">*</span></label>
                    <input id="advance" class="form-control" name="advn" type="text" value="<?php echo $editRow["aperc"];?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"/>
                    </div>

                    <div class="form-group">
                    <label for="bdealer">Dealer Price (B Class Agent)></label>
                    <input id="bdealer" class="form-control" name="edpriceb" type="text" value="<?php echo $editRow["bprice"];?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" />
                    </div>
                    
                    <div class="form-group">
                    <label for="badvance">Advance % on Dealer Price (B Class Agent)</label>
                    <input id="badvance" class="form-control" name="advnb" type="text" value="<?php echo $editRow["bperc"];?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"/>
                    </div>

                    <div class="form-group">
                    <label for="cdealer">Dealer Price (C Class Agent)</label>
                    <input id="cdealer" class="form-control" name="edpricec" type="text" value="<?php echo $editRow["cprice"];?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" />
                    </div>
                    
                    <div class="form-group">
                    <label for="cadvance">Advance % on Dealer Price (C Class Agent)</label>
                    <input id="cadvance" class="form-control" name="advnc" type="text" value="<?php echo $editRow["cperc"];?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"/>
                    </div>
                    
                     <div class="form-group">
                    <label for="stock">Stock<span style="color:#FF0000">*</span></label>
                    <input id="stock" class="form-control" type="text" name="txtEdtStock" value="<?php echo $editRow["stock"];?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"/>
                    </div>
                    
                    <div class="form-group">
                    <label for="reorder">Reorder Level<span style="color:#FF0000">*</span></label>
                    <input id="reorder" class="form-control" name="txteReorder" type="text" value="<?php echo $editRow["reorderlevel"];?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"/>
                    </div>
                    
                     <div class="form-group">
                    <label for="price">Special Order Offer Price<span style="color:#FF0000">*</span></label>
                    <input id="price" class="form-control" name="txteRealPrice" type="text" value="<?php echo $editRow["rprice"];?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" />
                    </div>
                    
                     <div class="form-group">
                    <label for="offer">Retail Price (Normal Order Price)</label>
                    <input id="offer" class="form-control" name="txteOfferPrice" type="text" value="<?php echo $editRow["oprice"];?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" />
                    </div>
                    
                   
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                   <input type="hidden" name="hid" value="<?php echo $editRow["pid"];?>" />
                   <button type="submit" name="btnEdit"  class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                  </div>
                </form>
      <?php
	}
}
else
{
	?>
                
                <!-- form start -->
                
                <form role="form" method="post" >
                  <div class="box-body">
                              <div class="form-group">
                     <label for="pdName">Product Name<span style="color:#FF0000">*</span></label>
                      <input id="pdName" class="form-control" name="txtProduct" type="text" value="<?php echo @$product;?>"/>
                    </div>
                    
                    <div class="form-group">
                    <label for="category">Category<span style="color:#FF0000">*</span></label>
                    <select id="category" class="form-control" name="ddlCategory">
      <option value="">SELECT</option>
        <!--category added-->
      <?php 
	  $editCategoryId=@$category;
	  $categoryQuery="select * from `product_category` where `catid`='$editCategoryId' and `status`='1' order by `product_category` ASC";
	  
	  $resultCategory=mysqli_query($con, $categoryQuery);
	  while($resultCategoryRow=mysqli_fetch_array($resultCategory))
	  {
	  ?>
      <option selected="selected" value="<?php echo $resultCategoryRow["catid"];?>"><?php echo $resultCategoryRow["product_category"];?></option>    
      <?php
	  }
	  ?>
        <!--other categories into dropdown list-->
      <?php 
	  $categorySelectQuery="select * from `product_category` where `catid`!='$editCategoryId' and `status`='1' order by `product_category` ASC";
	  $resultCatgQuery=mysqli_query($con, $categorySelectQuery);
	  while($categoryRow=mysqli_fetch_array($resultCatgQuery))
	  {
	 ?>
     <option value="<?php echo $categoryRow["catid"];?>"><?php echo $categoryRow["product_category"];?> </option>
     <?php
	  }
	  ?>
      </select>
                    </div>
                    
                    <div class="form-group">
                    <label for="description">Description<span style="color:#FF0000">*</span></label>
                    <textarea id="description" class="form-control" name="txtareaDescription" cols="45" rows="5" ><?php echo @$description;?></textarea>
                    </div>
                    
                    <div class="form-group">
                    <label for="dlr">Dealer Price (A Class Agent)<span style="color:#FF0000">*</span></label>
                    <input id="dlr" class="form-control" type="text" name="dprice" value="<?php echo @$dprice;?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"/>
                    </div>
                      <div class="form-group">
                    <label for="adv">Advance % on Dealer Price (A Class Agent)<span style="color:#FF0000">*</span></label>
                    <input id="adv" class="form-control" name="ad" type="text" value="<?php echo @$ad;?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"/>
                    </div>

                    <div class="form-group">
                    <label for="bdlr">Dealer Price (B Class Agent)</label>
                    <input id="bdlr" class="form-control" type="text" name="dpriceb" value="<?php echo @$dpriceb;?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"/>
                    </div>
                      <div class="form-group">
                    <label for="badv">Advance % on Dealer Price (B Class Agent)</label>
                    <input id="badv" class="form-control" name="adb" type="text" value="<?php echo @$adb;?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"/>
                    </div>

                    <div class="form-group">
                    <label for="cdlr">Dealer Price (C Class Agent)</label>
                    <input id="cdlr" class="form-control" type="text" name="dpricec" value="<?php echo @$dpricec;?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"/>
                    </div>
                      <div class="form-group">
                    <label for="cadv">Advance % on Dealer Price (C Class Agent)</label>
                    <input id="cadv" class="form-control" name="adc" type="text" value="<?php echo @$adc;?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"/>
                    </div>
                    
                     <div class="form-group">
                    <label for="stock">Stock<span style="color:#FF0000">*</span></label>
                    <input id="stock" class="form-control" type="text" name="txtStock" value="<?php echo @$stock;?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"/>
                    </div>
                    
                    <div class="form-group">
                    <label for="reorder">Reorder Level<span style="color:#FF0000">*</span></label>
                   <input id="reorder" class="form-control" name="txtReorder" type="text" value="<?php echo @$reorder?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"/>
                    </div>
                    
                     <div class="form-group">
                    <label for="price">Special Order Offer Price<span style="color:#FF0000">*</span></label>
                   <input id="price" class="form-control" name="txtRealPrice" type="text" value="<?php echo @$realPrice;?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"/>
                    </div>
                    
                     <div class="form-group">
                    <label for="offer">Retail Price (Normal Order Price)</label>
                    <input id="offer" class="form-control" name="txtOfferPrice" type="text" value="<?php echo @$offerPrice;?>" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"/>
                    </div>
                    
                   
                                       
                                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                   <button type="submit" name="btnSave"  class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
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
   	require_once("../class/pagination.php");
   	$page=new pagination();
   	$page->perpage=10;
	$page->show=3;
	$page->con=$con;
	$page->query="select a.*, b.* from `product` a,`product_category` b where a.status='1' and a.catid=b.catid order by a.Product ASC";
   ?>
              <div class="box box-success">
                <div class="box-header">
               
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Products</h3>
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
$select="select a.*, b.* from `product` a,`product_category` b where a.status='1' and a.catid=b.catid order by a.Product ASC LIMIT $pstart,$perpage";
  $result=mysqli_query($con, $select);
while($row=mysqli_fetch_array($result))
  {
  ?>
                    <li>
                      <span class="handle">
                        <i class="fa  fa-hand-o-right"></i>
                      </span>
                      <span class="text"><?php echo $row["Product"]." (Rs. ".$row["oprice"].") ";?></span>
                      
                      
                       <small class="label label-default"><i class="fa fa-shopping-cart"></i> <?php echo $row["stock"];?></small>
                     
                      
                     
                      <div class="tools">
          <form  action="" method="post">
         <input name="edit" type="hidden" value="<?php echo $row["pid"];?>"/>
          
          <button type="submit" name="edt" style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-edit"></i></button>
          <button type="submit" name="delt" onClick="return confirm('Are you sure you want to delete this?');"  style="border:none; height:20px; width:20px; padding:3px; background:none; position:relative; float:left;"><i class="fa fa-trash-o"></i></button>
         
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

  </body>
</html>
<?php
}
?>