<?php 


include '../../auto_load.php';


if(isset($_POST['Action']) && $_POST['Action']=='Mustard_Product_report_footer')
{



$Season_Code_value	= isset($_POST["Season_Code"]) && !empty($_POST["Season_Code"]) ? implode(",", $_POST["Season_Code"]) : "0";
$Variety_Code_value	= isset($_POST["Variety_Code"]) && !empty($_POST["Variety_Code"]) ? implode(",", $_POST["Variety_Code"]) : "0";
$Process_Code_value	= isset($_POST["Process_code"]) && !empty($_POST["Process_code"]) ? implode(",", $_POST["Process_code"]) : "0";
$Crop_Code_value	= isset($_POST["Crop_Code"]) && !empty($_POST["Crop_Code"]) ? implode(",", $_POST["Crop_Code"]) : "0";


	$offset=@$_POST['start'];
	$length=@$_POST['length'];
	$length=$length == '-1' ? "All" : $length;


	$Season=@$_POST['Season'];
	
	$Variety_Code=@$_POST['Variety_Code'];
	$Process_Code=@$_POST['Process_Code'];
	$Production_Center=@$_POST['Production_Center'];
	$Actual_Code=@$_POST['Actual_Code'];
	$Is_Product_Visible=@$_POST['Is_Product_Visible'];
	

	$zone  = ($_POST['user_input']['zone'] != '') ? $_POST['user_input']['zone'] : '';
    $region  = ($_POST['user_input']['region'] != '') ? $_POST['user_input']['region'] : '';
    $territory  = ($_POST['user_input']['territory'] != '') ? $_POST['user_input']['territory'] : '';
    $retailer  = ($_POST['user_input']['retailer'] != '') ? $_POST['user_input']['retailer'] : '';
    $location_date  = ($_POST['user_input']['location_date'] != '') ? $_POST['user_input']['location_date'] : '';

    // echo "<pre>";print_r($_POST['user_input']['retailer']);exit;

	
	$sql="SELECT Mustard_Product,SUM(CAST(Target_Plan as int)) As Target_Plan,SUM(CAST(Actual_Sale as int)) As Actual_Sale from ESO_Mustard_Daily_Report WHERE 1=1";


	if($zone != '') {
        $sql.= " AND Zone_Name = '".$zone."'";
    }

    if($region != '') {
        $sql.= " AND Region_Name = '".$region."'";
    }

    if($territory != '') {
        $sql.= " AND TERRITORY = '".$territory."'";
    }

    if($retailer != '') {
        $sql.= " AND Retailar_Name = '".$retailer."'";
    }

    if($location_date != '') {
        $location_date = explode(' - ', $location_date);
        
        $from_date = DateTime::createFromFormat('d/m/Y', trim($location_date[0]));
        $from_date = $from_date->format('Y-m-d');
        $to_date = DateTime::createFromFormat('d/m/Y', trim($location_date[1]));
        $to_date = $to_date->format('Y-m-d');
        
        $sql.= " AND CONVERT(DATE, LOCATIONDATE,104) BETWEEN '".$from_date."' AND '".$to_date."'";
    }

    $sql .= " Group by Mustard_Product ORDER BY Mustard_Product ASC";

    // echo $sql;exit; 

	$stmt = sqlsrv_prepare($conn, $sql);
	
	sqlsrv_execute($stmt);
	$sno=$offset+1;
	$res['recordsTotal']=0;
	$resultarr=array();
	
	$KarunaGoldPlan=$KarunaGoldActual=$RMX9906Plan=$RMX9906Actual=$RMX9922Plan=$RMX9922Actual=$RMX9903Plan=$RMX9903Actual=$ANMOLPlan=$ANMOLActual=0;

	while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
	{		

//echo "hai";
		if(@$prow['Mustard_Product']=="KARUNA GOLD"){



			$KarunaGoldPlan 	        =round(@$prow['Target_Plan'],0);
			$KarunaGoldActual 	        =round(@$prow['Actual_Sale'],0);


		}


		if(@$prow['Mustard_Product']=="RMX-9906" ){



			$RMX9906Plan 	        =round(@$prow['Target_Plan'],0);
			$RMX9906Actual 	        =round(@$prow['Actual_Sale'],0);


		}


		if(@$prow['Mustard_Product']=="RMX-9922" ){



			$RMX9922Plan 	        =round(@$prow['Target_Plan'],0);
			$RMX9922Actual 	        =round(@$prow['Actual_Sale'],0);


		}


		if(@$prow['Mustard_Product']=="RMX-9903" ){



			$RMX9903Plan 	        =round(@$prow['Target_Plan'],0);
			$RMX9903Actual 	        =round(@$prow['Actual_Sale'],0);


		}


		if(@$prow['Mustard_Product']=="ANMOL" ){



			$ANMOLPlan 	        =round(@$prow['Target_Plan'],0);
			$ANMOLActual 	        =round(@$prow['Actual_Sale'],0);


		}



		
		

	}


		$sql="SELECT SUM(CAST(Target_Plan as int)) As Target_Plan,SUM(CAST(Actual_Sale as int)) As Actual_Sale from ESO_Mustard_Daily_Report WHERE 1=1";
	
		if($zone != '') {
	        $sql.= " AND Zone_Name = '".$zone."'";
	    }

	    if($region != '') {
	        $sql.= " AND Region_Name = '".$region."'";
	    }

	    if($territory != '') {
	        $sql.= " AND TERRITORY = '".$territory."'";
	    }

	    if($retailer != '') {
	        $sql.= " AND Retailar_Name = '".$retailer."'";
	    }

	    if($location_date != '') {
	        $location_date = explode(' - ', $location_date);
	        
	        $from_date = DateTime::createFromFormat('d/m/Y', trim($location_date[0]));
	        $from_date = $from_date->format('Y-m-d');
	        $to_date = DateTime::createFromFormat('d/m/Y', trim($location_date[1]));
	        $to_date = $to_date->format('Y-m-d');
	        
	        $sql.= " AND CONVERT(DATE, LOCATIONDATE,104) BETWEEN '".$from_date."' AND '".$to_date."'";
	    }


		 $Sql_Connection =sqlsrv_query($conn,$sql);
        $Sql_Result = sqlsrv_fetch_array($Sql_Connection,SQLSRV_FETCH_ASSOC);


	
	 $html="<tr >
                      <td colspan='9' align='center' style='text-align: center;'> Total</td>  "; 
                      
                       $html.="
                      <td class='text-end'>".$RMX9906Plan."</td>
                      <td class='text-end'>".$RMX9906Actual."</td>
                      <td class='text-end'>".$RMX9922Plan."</td>
                      <td class='text-end'>".$RMX9922Actual."</td>
                      <td class='text-end'>".$RMX9903Plan."</td>
                      <td class='text-end'>".$RMX9903Actual."</td>
                      <td class='text-end'>".$KarunaGoldPlan."</td>
                      <td class='text-end'>".$KarunaGoldActual."</td>
                      <td class='text-end'>".$ANMOLActual."</td>
                      <td class='text-end'>".$ANMOLActual."</td>
                      <td class='text-end'>".$Sql_Result['Target_Plan']."</td>
                      <td class='text-end'>".$Sql_Result['Actual_Sale']."</td>
                      <td class='text-end'>".$RMX9906Actual."</td>
                      <td class='text-end'>".$RMX9922Actual."</td>
                      <td class='text-end'>".$RMX9903Actual."</td>
                      <td class='text-end'>".$KarunaGoldActual."</td>
                      <td class='text-end'>".$KarunaGoldActual."</td>
                      <td class='text-end'>".$Sql_Result['Actual_Sale']."</td>
               
                     
                    

                    </tr>";

echo $html;
	
}



//
?>


