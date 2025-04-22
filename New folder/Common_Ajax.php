<?php 
include '../../auto_load.php';
include 'Common_Filter.php';
error_reporting(-1);
$Common_Filter=new Common_Filter($conn);
$Action=@$_POST['Action'];
if($Action=="QC_Product_report")
{
	$QCData=$Common_Filter->QC_Product_report($_POST);
	echo json_encode($QCData);exit;
}






?>