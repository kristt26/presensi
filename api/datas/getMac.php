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
$getmac->user_agent=$_SERVER['HTTP_USER_AGENT'];
 
// query products
$stmt = $getmac->readMac();
echo json_encode(array("MacAdress" => $stmt, "OS"=>$getmac->getOS()));

?>