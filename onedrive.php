<?php
    function calculateFileSize($size)
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

    function get_azure_token()
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


    function read_drive_file_list($accessToken)
    {        
       $api_url = 'https://graph.microsoft.com/v1.0/me/drive/root:/SOP_Documents:/children';

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

        $file_name = array();
        if(COUNT($response['value']) > 0) {
            foreach ($response['value'] as $key => $value) {
                $file_name[] = $value['name'];
            }

        }

        return $file_name;
    }    


    function read_drive_file_data($accessToken,$fileName)
    {        

       $api_url = 'https://graph.microsoft.com/v1.0/me/drive/root:/SOP_Documents/'.$fileName;

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


    $accessToken = get_azure_token();
    // echo $accessToken;exit;

    $final_result = array();

    $file_list = read_drive_file_list($accessToken);

    foreach ($file_list as $key => $file_name) {
        $file_extension = pathinfo($file_name,PATHINFO_EXTENSION);

        if($file_extension == 'pdf') {

            // read file from onedrive
            $read_file_data = read_drive_file_data($accessToken,$file_name);

            if($read_file_data != 'No file') {

                // readed file store in local uploads folder 
                file_put_contents("uploads/".$file_name, fopen($read_file_data, 'r'));
                
                $result['file_name']        = "uploads/".$file_name;
                $file_size_byte = filesize("uploads/".$file_name);
                $result['file_size']        = calculateFileSize($file_size_byte);
                // $result['outlook_web_url'] = $read_file_data;

                $final_result[] = $result;   

            }
        }

    }



    $response['pdf_url'] = $final_result;

    echo json_encode($response);exit;

?>


