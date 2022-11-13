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
<?php 
if(isset($_POST["download"]))
{
$fdate=$_POST["fdate"];
$tdate=$_POST["tdate"];	

$setCounter = 0;
$setExcelName = "Hanbaz_Call_summary_from_".$fdate."_to_".$tdate;
//$setExcelName = "Ccall_summary";

//$setSql = "YOUR SQL QUERY GOES HERE";
//SET @serial=0;
//$setSql = "SELECT @serial := @serial+1 AS Sl_No, b.name AS Response, COUNT(a.rtype) AS Calls FROM (select @serial:=0) initvars, `response` a, `response_category`  b WHERE a.rtype= b.rtid  AND a.rstatus=1  AND (a.rdate>='$fdate' AND a.rdate<='$tdate')   GROUP BY a.rtype ORDER BY COUNT(a.rtype) DESC";
$setSql ="SELECT b.name AS Response, COUNT(a.rtype) AS Calls FROM `response` a, `response_category`  b WHERE  a.`uid`='$user' AND  a.rtype= b.rtid  AND a.rstatus=1  AND (a.rdate>='$fdate' AND a.rdate<='$tdate')   GROUP BY a.rtype ORDER BY COUNT(a.rtype) DESC";

$setMainHeader=$setData="";

$setRec = mysqli_query($con, $setSql);

$setCounter = mysqli_num_fields($setRec);

for ($i = 0; $i < $setCounter; $i++) {
    $setMainHeader .=mysqli_fetch_field_direct($setRec, $i)->name."\t";
}

while($rec = mysqli_fetch_row($setRec))  {
  $rowLine = '';
  foreach($rec as $value)       {
    if(!isset($value) || $value == "")  {
      $value = "\t";
    }   else  {
//It escape all the special charactor, quotes from the data.
      $value = strip_tags(str_replace('"', '""', $value));
      $value = '"' . $value . '"' . "\t";
    }
    $rowLine .= $value;
  }
  $setData .= trim($rowLine)."\n";
}
  $setData = str_replace("\r", "", $setData);

if ($setData == "") {
  $setData = "\nno matching records found\n";
}

$setCounter = mysqli_num_fields($setRec);

//This Header is used to make data download instead of display the data
 header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=".$setExcelName."_Reoprt.xls");

header("Pragma: no-cache");
header("Expires: 0");

//It will print all the Table row as Excel file row with selected column name as header.
echo ucwords($setMainHeader)."\n".$setData."\n";
}
?>
<?php
}
?>