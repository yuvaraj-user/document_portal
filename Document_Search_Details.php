<?php
/**
 * 
 */
require_once('assets/plugins/FPDF/fpdf.php');
require_once('assets/plugins/FPDI/fpdi.php');
require_once('PDF_Rotate.php');

class Document_Search_Details 
{

 	public $conn;

  	function __construct($conn) {
      $this->conn = $conn;

    }


    public function calculateFileSize($size)
    {
       $sizes = ['B', 'KB', 'MB', 'GB'];
       $count=0;
       if ($size < 1024) {
        return $size . " " . $sizes[$count];
        } else{
         while ($size>1024){
            $size=round($size/1024,2);
            $count++;
        }
         return $size . " " . $sizes[$count];
       }
    }

    public function get_azure_token()
    {
        // cURL to get access token
        $ch = curl_init($token_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            echo 'Error: ' . $error_msg;
            exit;
        }
        curl_close($ch);

        // Decode JSON response
        $response_data = json_decode($response, true);
        $access_token = $response_data['access_token'];

        return $access_token;

    }


    public function read_drive_file_list($accessToken,$main_folder_name,$department_folder_name,$division_folder_name)
    {        
       $api_url = 'https://graph.microsoft.com/v1.0/me/drive/root:/'.$main_folder_name.'/'.$department_folder_name.':/children';

       if($division_folder_name != '') {
       		$api_url = 'https://graph.microsoft.com/v1.0/me/drive/root:/'.$main_folder_name.'/'.$department_folder_name.'/'.$division_folder_name.':/children';
       }       

       $ch = curl_init($api_url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Use only for testing, not recommended for production

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        ));
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
            exit;
        }

        curl_close($ch);

        $response = json_decode($response, true);
        // echo "<pre>";print_r($response);exit;


        $file_name = array();
        if(isset($response['value']) && COUNT($response['value']) > 0) {
            foreach ($response['value'] as $key => $value) {
                $file_name[] = $value['name'];
            }

        }

        return $file_name;
    }    


    public function read_drive_file_data($accessToken,$fileName,$main_folder_name,$department_folder_name,$division_folder_name)
    {        
       $api_url = 'https://graph.microsoft.com/v1.0/me/drive/root:/'.$main_folder_name.'/'.$department_folder_name.'/'.$fileName;

       if($division_folder_name != '') {
       		$api_url = 'https://graph.microsoft.com/v1.0/me/drive/root:/'.$main_folder_name.'/'.$department_folder_name.'/'.$division_folder_name.'/'.$fileName;
       }       
       // echo $api_url;exit;

       $ch = curl_init($api_url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Use only for testing, not recommended for production

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        ));
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
            exit;
        }

        curl_close($ch);

        $response = json_decode($response, true);

        // echo "<pre>";print_r($response);exit;

        $response = isset($response['@microsoft.graph.downloadUrl']) ? $response['@microsoft.graph.downloadUrl'] : 'No file';


        // $response = isset($response['webUrl']) ? $response['webUrl'] : 'No file';

        return $response;
    }   

    public function Get_Logged_User_Details()
    {
        $user_sql = "SELECT * from HR_Master_Table where Employee_Code = '".$_SESSION['EmpID']."'";
        // echo $user_sql;exit;

        $user_sql_exec = sqlsrv_query($this->conn,$user_sql);

        $result = sqlsrv_fetch_array($user_sql_exec,SQLSRV_FETCH_ASSOC);          

        return $result;
    }

    public function Get_onedrive_folder_master($department = '',$division = '')
    {
    	$user_details = $this->Get_Logged_User_Details();

        $result = array();
        
        if($_SESSION['Dcode'] == 'ADMIN') {
            $user_sql = "SELECT * from SOP_Onedrive_Folder_Master WHERE 1=1";
            
            if($department != '') {
                $user_sql .= " AND Department_Folder_Name = '".$department."'"; 
            }

            if($division != '') {
                $user_sql .= " AND Division_Folder_Name = '".$division."'"; 
            }   


            $user_sql_exec = sqlsrv_query($this->conn,$user_sql);

            while($row = sqlsrv_fetch_array($user_sql_exec,SQLSRV_FETCH_ASSOC)) {
                $result[] = $row;  
            }   

        } else {

            $user_sql = "SELECT * from SOP_Onedrive_Folder_Master WHERE 1=1";

            if($department != '') {
                $user_sql .= " AND Department_Folder_Name = '".$department."'"; 
            }

            if($division != '') {
                $user_sql .= " AND Division_Folder_Name = '".$division."'"; 
            }  


            if($department == '' && $division == '') {
                $user_sql = "SELECT * from SOP_Onedrive_Folder_Master where Department LIKE '%".$user_details['Department']."%' AND Division = '".$user_details['Business_Division']."'";
            }              
            
            
            $user_sql_exec = sqlsrv_query($this->conn,$user_sql);

            while($row = sqlsrv_fetch_array($user_sql_exec,SQLSRV_FETCH_ASSOC)) {
            	$result[] = $row;  
            }          

        }


        return $result;    	
    }     


    public function Get_Documents($request)
    {
        $department = isset($request['department']) ? $request['department'] : ''; 
        $division   = isset($request['division']) ? $request['division'] : ''; 

    	$response = array();

    	$folder_master = $this->Get_onedrive_folder_master($department,$division);
    	// echo "<pre>";print_r($folder_master);exit;

		$accessToken = $this->get_azure_token();

		$final_result = array();
		foreach ($folder_master as $fkey => $fvalue) {
			$main_folder_name 	    = $fvalue['Main_Folder_Name'];
			$department_folder_name = $fvalue['Department_Folder_Name'];
			$division_folder_name   = $fvalue['Division_Folder_Name'];



		    $file_list = $this->read_drive_file_list($accessToken,$main_folder_name,$department_folder_name,$division_folder_name);

		    // echo "<pre>";print_r($file_list);

            $result = array();
		    foreach ($file_list as $key => $file_name) {
		        $file_extension = pathinfo($file_name,PATHINFO_EXTENSION);

		        if($file_extension == 'pdf') {

		            // read file from onedrive
		            $read_file_data = $this->read_drive_file_data($accessToken,$file_name,$main_folder_name,$department_folder_name,$division_folder_name);

		            if($read_file_data != 'No file') {

		                // readed file store in local uploads folder 
		                file_put_contents("uploads/".$file_name, fopen($read_file_data, 'r'));
		                
		                $result['file_name']        = "uploads/".$file_name;
		                $file_size_byte             = filesize("uploads/".$file_name);
		                $result['file_size']        = $this->calculateFileSize($file_size_byte);
		                // $result['outlook_web_url'] = $read_file_data;

		                $final_result[] = $result;   

		            }
		        }

		    }

			$response['pdf_url'] = $final_result;
		}


		echo json_encode($response);exit;    	
    }

    public function get_department_names()
    {
    	// echo "<pre>";print_r($_SESSION);exit;

    	$user_details = $this->Get_Logged_User_Details();

        $dept_sql = "SELECT DISTINCT Department,Department_Folder_Name,Department_Folder_Image from SOP_Onedrive_Folder_Master where Department LIKE '%".$user_details['Department']."%' AND Division = '".$user_details['Business_Division']."'";

    	if($_SESSION['Dcode'] == 'ADMIN') {
        	$dept_sql = "SELECT DISTINCT Department,Department_Folder_Name,Department_Folder_Image from SOP_Onedrive_Folder_Master";
    	}


        $dept_sql_exec = sqlsrv_query($this->conn,$dept_sql);

        $result = array();

        while($row = sqlsrv_fetch_array($dept_sql_exec,SQLSRV_FETCH_ASSOC)) {
        	$result['data'][] = $row;  
        }          


        return $result;    	
    }

    public function Get_division_folder($request)
    {
    	// echo "<pre>";print_r($_SESSION);exit;

    	$user_details = $this->Get_Logged_User_Details();

        $dept_sql = "SELECT DISTINCT Division_Folder_Name,Division_Folder_Image from SOP_Onedrive_Folder_Master where Department_Folder_Name = '".$request['department']."' AND Division = '".$user_details['Business_Division']."' AND Division_Folder_Name != '' AND Division_Folder_Name IS NOT NULL";

    	if($_SESSION['Dcode'] == 'ADMIN') {
        	$dept_sql = "SELECT DISTINCT Division_Folder_Name,Division_Folder_Image from SOP_Onedrive_Folder_Master where Department_Folder_Name = '".$request['department']."' AND Division_Folder_Name != '' AND Division_Folder_Name IS NOT NULL";
    	}

    	// echo $dept_sql;exit;
        $dept_sql_exec = sqlsrv_query($this->conn,$dept_sql);

        $result = array();

        while($row = sqlsrv_fetch_array($dept_sql_exec,SQLSRV_FETCH_ASSOC)) {
        	$result['data'][] = $row;  
        	$result['type'][] = 'folder';  
        }  


        if(COUNT($result) == 0) {
        	// division folder does not exist get a file 
			$main_folder_name 	    = 'SOP_Documents';
			$department_folder_name = $request['department'];

			$accessToken = $this->get_azure_token();

		    $final_result = array();

		    $file_list = $this->read_drive_file_list($accessToken,$main_folder_name,$department_folder_name,'');


		    foreach ($file_list as $key => $file_name) {
		        $file_extension = pathinfo($file_name,PATHINFO_EXTENSION);

		        if($file_extension == 'pdf') {
		        	$result['data'][] = $file_name;
		        	$result['type'][] = 'file';  
		        }

		    }

        }
        
        return $result;    	

    }

    public function Get_division_files($request)
    {
		// division folder does not exist get a file 
		$main_folder_name 	    = 'SOP_Documents';
		$department_folder_name = $request['department'];
		$division_folder_name   = $request['division'];

		$accessToken = $this->get_azure_token();

	    $final_result = array();

	    $file_list = $this->read_drive_file_list($accessToken,$main_folder_name,$department_folder_name,$division_folder_name);
        $result['data'] = array();

	    foreach ($file_list as $key => $file_name) {
	        $file_extension = pathinfo($file_name,PATHINFO_EXTENSION);

	        if($file_extension == 'pdf') {
	        	$result['data'][] = $file_name;
	        	$result['type'][] = 'file';  
	        }

	    }

        return $result;    	

    }    

	public function View_file($request)
    {
		$main_folder_name 	    = 'SOP_Documents';
		$department_folder_name = $request['department'];
		$division_folder_name   = isset($request['division']) ? $request['division'] : '';
		$file_name              = $request['filename'];

		$accessToken = $this->get_azure_token();

        // read file from onedrive
        $read_file_data = $this->read_drive_file_data($accessToken,$file_name,$main_folder_name,$department_folder_name,$division_folder_name);

        $result = array();
        if($read_file_data != 'No file') {

            // readed file store in local uploads folder 
            file_put_contents("uploads/".$file_name, fopen($read_file_data, 'r'));
            
            // $this->add_water_mark("uploads/".$file_name);

            $result['file_name']  = "uploads/".$file_name;

        }			
        
        return $result;    	

    }


    public function Print_Watermark($x, $y, $watermarkText, $angle, $pdf, $opacity = 0.1)
    {
        $angle = $angle * M_PI / 180;
        $c = cos($angle);
        $s = sin($angle);
        $cx = $x * 1;
        $cy = (300 - $y) * 1;
        $pdf->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, - $s, $c, $cx, $cy, - $cx, - $cy));

        $pdf->_out(sprintf('%.2F gs', $opacity));  // Set the opacity (gs is the graphics state operator)
            
        $pdf->Text($x, $y, $watermarkText);
        $pdf->_out('Q');
    }

    public function add_water_mark($file)
    {
            // Set source PDF file 
        $pdf = new Fpdi(); 

        $pdf_rotate = new PDF_Rotate(); 

        try{
            if(file_exists("./".$file)){ 
                $pagecount = $pdf->setSourceFile($file); 
            }else{ 
                die('Source PDF not found!'); 
            } 
        } catch (Exception $e) {
            // If an error occurs (unsupported compression or encryption), output the error message
            echo 'Error processing the PDF: ' . $e->getMessage();
            // Optionally, you can output the original PDF without watermark
            $pdf->Output($file);
            return;  // Stop processing here
        }

        // Add watermark image to PDF pages 
        for($i=1;$i<=$pagecount;$i++){ 
            $tpl = $pdf->importPage($i); 
            $size = $pdf->getTemplateSize($tpl); 
            $pdf->addPage(); 
            
            // water mark add 
            $pdf->SetFont('Times', '', 70);
            $pdf->SetTextColor(80, 200, 120);
            $watermarkText = 'Rasi Seeds';

            $this->Print_Watermark(130, 210, $watermarkText, 45, $pdf, 0.1);
            $pdf->SetXY(25, 25);
            // water mark add end  

            
            $pdf->useTemplate($tpl, 1, 1, $size['w'], $size['h'], TRUE); 
            
            $imageWidth = 150; // Set image width
            $imageHeight = 50; // Set image height

            //Put the watermark 
            $xaxis_final = ($size['w'] - $imageWidth)/2; 
            $yaxis_final = ($size['h'] - $imageHeight)/2;


        } 
         
        // Output PDF with watermark 
        $pdf->Output($file);

    } 

   
}
?>