<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../../api/config/database.php';
include_once '../../api/objects/GetMac.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$getmac = new GetMac($db);
//$getmac->user_agent=$_SERVER['HTTP_USER_AGENT'];
$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
 
// query products




function getOS() { 
    
        global $user_agent;
    
        $os_platform    =   "Unknown OS Platform";
    
        $os_array       =   array(
                                '/windows nt 10/i'     =>  'Windows 10',
                                '/windows nt 6.3/i'     =>  'Windows 8.1',
                                '/windows nt 6.2/i'     =>  'Windows 8',
                                '/windows nt 6.1/i'     =>  'Windows 7',
                                '/windows nt 6.0/i'     =>  'Windows Vista',
                                '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                                '/windows nt 5.1/i'     =>  'Windows XP',
                                '/windows xp/i'         =>  'Windows XP',
                                '/windows nt 5.0/i'     =>  'Windows 2000',
                                '/windows me/i'         =>  'Windows ME',
                                '/win98/i'              =>  'Windows 98',
                                '/win95/i'              =>  'Windows 95',
                                '/win16/i'              =>  'Windows 3.11',
                                '/macintosh|mac os x/i' =>  'Mac OS X',
                                '/mac_powerpc/i'        =>  'Mac OS 9',
                                '/linux/i'              =>  'Linux',
                                '/ubuntu/i'             =>  'Ubuntu',
                                '/iphone/i'             =>  'iPhone',
                                '/ipod/i'               =>  'iPod',
                                '/ipad/i'               =>  'iPad',
                                '/android/i'            =>  'Android',
                                '/blackberry/i'         =>  'BlackBerry',
                                '/webos/i'              =>  'Mobile'
                            );
    
        foreach ($os_array as $regex => $value) { 
    
            if (preg_match($regex, $user_agent)) {
                $os_platform    =   $value;
            }
    
        }   
    
        return $os_platform;
    
    }
    $OS=getOS();
    if($_SERVER['SERVER_NAME']!="localhost")
    {
        $stmt = $getmac->readMac();
        echo json_encode(array("MacAddress" => $stmt, "OS"=>$OS));
    }else
        echo json_encode(array("MacAddress" => NULL, "OS"=>$OS));

?>