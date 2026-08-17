<?php //error_reporting(0);

/**
 * Copyright 2017 Viaviweb.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
 

#Admin Login
function adminUser($username, $password){
    
    global $mysqli;

    $sql = "SELECT id,username FROM tbl_admin where username = '".$username."' and password = '".md5($password)."'";       
    $result = mysqli_query($mysqli,$sql);
    $num_rows = mysqli_num_rows($result);
     
    if ($num_rows > 0){
        while ($row = mysqli_fetch_array($result)){
            echo $_SESSION['ADMIN_ID'] = $row['id'];
            echo $_SESSION['ADMIN_USERNAME'] = $row['username'];
                                      
            return true; 
        }
    }
}


# Insert Data 
function Insert($table, $data) {
    global $mysqli;

    if (!$mysqli) {
        die("Database Connection Error: \$mysqli object is missing.");
    }

    $fields = array();
    $values = array();

    foreach ($data as $key => $val) {
        $fields[] = "`" . trim($key) . "`";
        $values[] = "'" . mysqli_real_escape_string($mysqli, $val) . "'";
    }

    $sql = "INSERT INTO `" . trim($table) . "` (" . implode(", ", $fields) . ") VALUES (" . implode(", ", $values) . ")";

    $result = mysqli_query($mysqli, $sql);
    
    if (!$result) {
        die("SQL Insert Failed: " . mysqli_error($mysqli) . "<br>Query: " . $sql);
    }

    if (function_exists('mysqli_commit')) {
        @mysqli_commit($mysqli);
    }

    return $result;
}

// Update Data, Where clause is left optional
function Update($table_name, $form_data, $where_clause='')
{   
    global $mysqli;

    if (!$mysqli) {
        die("Database Connection Error: \$mysqli object is missing.");
    }

    $whereSQL = '';
    if(!empty($where_clause))
    {
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }

    $sets = array();
    foreach($form_data as $column => $value)
    {
         $escaped_val = mysqli_real_escape_string($mysqli, $value);
         $sets[] = "`" . trim($column) . "` = '" . $escaped_val . "'";
    }

    $sql = "UPDATE `" . trim($table_name) . "` SET " . implode(', ', $sets) . $whereSQL;

    $result = mysqli_query($mysqli, $sql);

    if (!$result) {
        die("SQL Update Failed: " . mysqli_error($mysqli) . "<br>Query: " . $sql);
    }

    if (function_exists('mysqli_commit')) {
        @mysqli_commit($mysqli);
    }

    return $result;
}

 
//Delete Data, the where clause is left optional incase the user wants to delete every row!
function Delete($table_name, $where_clause='')
{   
    global $mysqli;
    $whereSQL = '';
    if(!empty($where_clause))
    {
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    $sql = "DELETE FROM ".$table_name.$whereSQL;
     
    return mysqli_query($mysqli,$sql);
}  
 
//GCM function
function Send_GCM_msg($registration_id,$data)
{
    $data1['data']=$data;
 
    $url = 'https://fcm.googleapis.com/fcm/send';
  
    $registatoin_ids = array($registration_id);
   
    $fields = array(
        'registration_ids' => $registatoin_ids,
        'data' => $data1,
    );

    $headers = array(
        'Authorization: key='.APP_GCM_KEY.'',
        'Content-Type: application/json'
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }

    curl_close($ch);
}

function calculate_time_span($post_time, $flag = false)
{
    if ($post_time != '') {

        $seconds = time() - $post_time;
        $year = floor($seconds / 31556926);
        $months = floor($seconds / 2629743);
        $week = floor($seconds / 604800);
        $day = floor($seconds / 86400);
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours * 3600)) / 60);
        $secs = floor($seconds % 60);

        if ($seconds < 60) $time = $secs . " sec ago";
        else if ($seconds < 3600) $time = ($mins == 1) ? $mins . " min ago" : $mins . " mins ago";
        else if ($seconds < 86400) $time = ($hours == 1) ? $hours . " hour ago" : $hours . " hours ago";
        else if ($seconds < 604800) $time = ($day == 1) ? $day . " day ago" : $day . " days ago";
        else if ($seconds < 2629743) $time = ($week == 1) ? $week . " week ago" : $week . " weeks ago";
        else if ($seconds < 31556926) $time = ($months == 1) ? $months . " month ago" : $months . " months ago";
        else $time = ($year == 1) ? $year . " year ago" : $year . " years ago";

        if ($flag) {
            if ($day > 1) {
                $time = date('d-m-Y', $post_time);
            }
        }
        return $time;
    } else {
        return 'not available';
    }
}

//Image compress
function compress_image($source_url, $destination_url, $quality)
{
    try {
        if (empty($source_url) || !file_exists($source_url)) {
            return false;
        }

        $info = @getimagesize($source_url);
        if (!$info) {
            return false;
        }

        $allowed_types = ['image/jpeg', 'image/gif', 'image/png', 'image/webp'];
        if (!in_array($info['mime'], $allowed_types)) {
            return false;
        }

        $image = null;
        switch ($info['mime']) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source_url);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($source_url);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source_url);
                break;
            case 'image/webp':
                $image = imagecreatefromwebp($source_url);
                break;
        }

        if (!$image) {
            return false;
        }

        $dest_dir = dirname($destination_url);
        if (!is_dir($dest_dir)) {
            @mkdir($dest_dir, 0777, true);
        }

        $result = imagejpeg($image, $destination_url, $quality);
        imagedestroy($image);

        return $result ? $destination_url : false;

    } catch (Exception $e) {
        error_log('[PlaceFinder] ' . $e->getMessage());
        return false;
    }
}

// clean input
function cleanInput($input)
{
    $input = trim($input);
    return $input;
}

function real_escape_string($inputText)
{
    global $mysqli;
    return trim(mysqli_real_escape_string($mysqli,$inputText));
}

// Total Count
function CountRow($table_name, $where_clause='')
{   
    global $mysqli;
    $whereSQL = '';
    if(!empty($where_clause))
    {
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    $sql = "SELECT * FROM ".$table_name.$whereSQL;
     
    $res=mysqli_query($mysqli,$sql);

    return mysqli_num_rows($res);
}  

//Create Thumb Image
function create_thumb_image($target_folder = '', $thumb_folder = '', $thumb_width = '', $thumb_height = '')
{
    try {
        if (empty($target_folder) || !file_exists($target_folder) || empty($thumb_folder)) {
            return false;
        }

        $thumb_dir = dirname($thumb_folder);
        if (!is_dir($thumb_dir)) {
            @mkdir($thumb_dir, 0777, true);
        }

        $info = @getimagesize($target_folder);
        if (!$info) {
            return false;
        }

        list($width, $height) = $info;
        if ($width == 0 || $height == 0) {
            return false;
        }

        $thumb_create = imagecreatetruecolor($thumb_width, $thumb_height);
        $source = null;

        switch ($info['mime']) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($target_folder);
                break;
            case 'image/png':
                $source = imagecreatefrompng($target_folder);
                break;
            case 'image/gif':
                $source = imagecreatefromgif($target_folder);
                break;
            case 'image/webp':
                $source = imagecreatefromwebp($target_folder);
                break;
            default:
                return false;
        }

        if (!$source) {
            imagedestroy($thumb_create);
            return false;
        }

        imagecopyresized($thumb_create, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
        $result = imagejpeg($thumb_create, $thumb_folder, 80);

        imagedestroy($source);
        imagedestroy($thumb_create);

        return $result;

    } catch (Exception $e) {
        error_log('[PlaceFinder] ' . $e->getMessage());
        return false;
    }
}

function getBaseUrl($array=false) {
    $protocol = "http";
    $host = "";
    $port = "";
    $dir = "";  

    if(array_key_exists("HTTPS", $_SERVER) && $_SERVER["HTTPS"] != "") {
        if($_SERVER["HTTPS"] == "on") { $protocol = "https"; }
        else { $protocol = "http"; }
    } elseif(array_key_exists("REQUEST_SCHEME", $_SERVER) && $_SERVER["REQUEST_SCHEME"] != "") { $protocol = $_SERVER["REQUEST_SCHEME"]; }

    if(array_key_exists("HTTP_X_FORWARDED_HOST", $_SERVER) && $_SERVER["HTTP_X_FORWARDED_HOST"] != "") { $host = trim(end(explode(',', $_SERVER["HTTP_X_FORWARDED_HOST"]))); }
    elseif(array_key_exists("SERVER_NAME", $_SERVER) && $_SERVER["SERVER_NAME"] != "") { $host = $_SERVER["SERVER_NAME"]; }
    elseif(array_key_exists("HTTP_HOST", $_SERVER) && $_SERVER["HTTP_HOST"] != "") { $host = $_SERVER["HTTP_HOST"]; }
    elseif(array_key_exists("SERVER_ADDR", $_SERVER) && $_SERVER["SERVER_ADDR"] != "") { $host = $_SERVER["SERVER_ADDR"]; }

    if(array_key_exists("SERVER_PORT", $_SERVER) && $_SERVER["SERVER_PORT"] != "") { $port = $_SERVER["SERVER_PORT"]; }
    elseif(stripos($host, ":") !== false) { $port = substr($host, (stripos($host, ":")+1)); }
    $host = preg_replace("/:\d+$/", "", $host);

    if(array_key_exists("SCRIPT_NAME", $_SERVER) && $_SERVER["SCRIPT_NAME"] != "") { $dir = $_SERVER["SCRIPT_NAME"]; }
    elseif(array_key_exists("PHP_SELF", $_SERVER) && $_SERVER["PHP_SELF"] != "") { $dir = $_SERVER["PHP_SELF"]; }
    elseif(array_key_exists("REQUEST_URI", $_SERVER) && $_SERVER["REQUEST_URI"] != "") { $dir = $_SERVER["REQUEST_URI"]; }
    if(stripos($dir, "/") !== false) { $dir = substr($dir, 0, (strripos($dir, "/")+1)); }

    if(!$array) {
        if($port == "80" || $port == "443" || $port == "") { $port = ""; }
        else { $port = ":".$port; } 
        return htmlspecialchars($protocol."://".$host.$port.$dir, ENT_QUOTES); 
    } else { return ["protocol" => $protocol, "host" => $host, "port" => $port, "dir" => $dir]; }
}

function checkSignSalt($data_info){
    $key="viaviweb";
    $data_json = $data_info;
    $data_arr = json_decode(urldecode(base64_decode($data_json)),true);

    if($data_arr['sign'] == '' && $data_arr['salt'] == '' ){
        $set['Place_App'][] = array("status" => -1, "message" => "Invalid sign salt.");
        header( 'Content-Type: application/json; charset=utf-8' );
        echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        exit();
    } else {
        $md5_salt=md5($key.$data_arr['salt']);
        if($data_arr['sign']!=$md5_salt){
            $set['Place_App'][] = array("status" => -1, "message" => "Invalid sign salt.");   
            header( 'Content-Type: application/json; charset=utf-8' );
            echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            exit();
        }
    }
    return $data_arr;
}

function verify_envato_purchase_code($product_code)
{ 
    $url = "https://api.envato.com/v3/market/author/sale?code=".$product_code;
    $curl = curl_init($url);

    $personal_token = "M8tF6z8lzZBBkmZt4xm3dU4lw7Rlbrwp";
    $header = array();
    $header[] = 'Authorization: Bearer '.$personal_token;
    $header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:41.0) Gecko/20100101 Firefox/41.0';
    $header[] = 'timeout: 20';
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER,$header);

    $envatoRes = curl_exec($curl);
    curl_close($curl);
    $envatoRes = json_decode($envatoRes);
     
    return $envatoRes;   
}

function verify_data_on_server($product_id,$buyer_name,$purchase_code,$purchased_status,$admin_url,$package_name,$ios_bundle_identifier)
{  
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"http://www.secureapp.viaviweb.in/verified_user.php");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query(array('envato_product_id' => $product_id,'envato_buyer_name' => $buyer_name,'envato_purchase_code' => $purchase_code,'envato_purchased_status' => $purchased_status,'buyer_admin_url' => $admin_url,'package_name' => $package_name,'ios_bundle_identifier' => $ios_bundle_identifier,)));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close ($ch);

    if ($server_output == "success") { echo "done1"; } else { echo "fail!";}     
}
?>