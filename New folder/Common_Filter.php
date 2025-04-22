<?php 




error_reporting(-1);
Class Common_Filter{
  public $conn;

  function __construct($conn) {
      $this->conn = $conn;

    }

  private function get_Sql_Result($Sql_Dets){
    $result=array();
    while($value=sqlsrv_fetch_array($Sql_Dets)){
      $result[]=$value;
    }
    return $result;
  }

 public function QC_Product_report($User_Input=array())
  {
    // echo "<pre>";print_r($User_Input);exit;

    $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
    $Length=@$User_Input['length'];
    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
    $Dcode=$_SESSION['Dcode'];

    $from_date  = ($User_Input['user_input']['from_date'] != '') ? date('Ymd',strtotime($User_Input['user_input']['from_date'])) : '';
    $to_date  = ($User_Input['user_input']['to_date'] != '') ? date('Ymd',strtotime($User_Input['user_input']['to_date'])) : ''; 


    $season    = ($User_Input['user_input']['SeasonCode'] != '') ? $User_Input['user_input']['SeasonCode'] : ''; 
    $crop_code = ($User_Input['user_input']['CropCode'] != '') ? $User_Input['user_input']['CropCode'] : ''; 
    $year_code = ($User_Input['user_input']['Yearcode'] != '') ? $User_Input['user_input']['Yearcode'] : ''; 
    $plant     = ($User_Input['user_input']['Plant'] != '') ? $User_Input['user_input']['Plant'] : ''; 

    $sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $i=0;
   

   $url ='http://192.168.162.213:8081/kanagaraj/DEV/QCFIELD/ZIN_RFC_GET_FIELDINSP_DET.php?SEASON_CODE='.$season.'&CROP_CODE='.$crop_code.'&YEAR_CODE='.$year_code.'&WERKS='.$plant.'&FROM_DATE='.$from_date.'&TO_DATE='.$to_date;
   

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);

    if(curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        return null;
    }

    curl_close($ch);

    $data = json_decode($response, true);

    // echo "<pre>";print_r($data);exit;

    $recordsTotal = COUNT($data['result']);

    $final_data = array();
    
    foreach ($data['result'] as $key => $value) {
      $data_res = array();

      //sno added 
      $data_res[] = $key+1;

      foreach (array_keys($value) as $key => $key_name) {
        if($key_name == 'BK' || $key_name == 'BL' || $key_name == 'BM' || $key_name == 'BN') {
          if($value[$key_name] != '') {
            $data_res[] = '<div class="mobile-image text-center">
                               <input type="hidden" id="img" value="'.$value[$key_name].'">
                                   <i class="mdi mdi-image text-primary" style="height: 16px;font-size: 20px;"></i>
                           </div>';
          } else {
            $data_res[] = '-';
          }
        } else {
          $data_res[] = $value[$key_name];
        }
      }
      
      // push final array 
      $final_data[] = $data_res; 
    }

    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = $User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }

    $res['recordsFiltered'] = $User_Input['length'];
    $res['recordsTotal'] = $User_Input['length'];
    $res['data'] = $final_data;

    return $res;
   
  }


   

}?>