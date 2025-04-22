<?php 
include '../auto_load.php';
include 'Document_Search_Details.php';
error_reporting(-1);

$Document_Search_Details = new Document_Search_Details($conn);

$Action = $_POST['Action'];

if($Action=="Get_Documents") {
	$Get_Documents = $Document_Search_Details->Get_Documents($_POST);
	echo json_encode($Get_Documents);exit;
}

if($Action=="get_department_names") {
	$get_department_names = $Document_Search_Details->get_department_names($_POST);
	echo json_encode($get_department_names);exit;
}

if($Action=="Get_division_folder") {
	$Get_division_folder = $Document_Search_Details->Get_division_folder($_POST);
	echo json_encode($Get_division_folder);exit;
}

if($Action=="Get_division_files") {
	$Get_division_files = $Document_Search_Details->Get_division_files($_POST);
	echo json_encode($Get_division_files);exit;
}

if($Action=="View_file") {
	$View_file = $Document_Search_Details->View_file($_POST);
	echo json_encode($View_file);exit;
}




?>