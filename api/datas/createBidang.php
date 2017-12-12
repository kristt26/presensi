<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../../api/config/database.php';
 
// instantiate product object
include_once '../../api/objects/Bidang.php';
 
$database = new Database();
$db = $database->getConnection();
 
$bidang = new Bidang($db);
 
// get posted data
$data =json_decode(file_get_contents("php://input"));
 

// set product property values
$bidang->NamaBidang = $data->NamaBidang;
$bidang->KepalaBagian = $data->KepalaBagian;
 
// create the product
if($bidang->create()){
    echo '{';
        echo '"message": "'.$bidang->IdBidang.'"';
    echo '}';
}
 
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create product."';
    echo '}';
}


?>