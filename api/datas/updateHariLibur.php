<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../../api/config/database.php';
include_once '../../api/objects/HariLibur.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$hariLibur = new HariLibur($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$hariLibur->IdHari = $data->IdHari;
 
$a = new DateTime($data->DariTgl);
$aa=str_replace('-', '/', $a->format('Y-m-d'));
$aaa = date('Y-m-d',strtotime($aa . "+1 days"));
$b = new DateTime($data->SampaiTgl);
$bb=str_replace('-', '/', $b->format('Y-m-d'));
$bbb = date('Y-m-d',strtotime($bb . "+1 days"));

// set product property values
$hariLibur->IdHari = $data->IdHari;
$hariLibur->DariTgl = $aaa;
$hariLibur->SampaiTgl = $bbb;
$hariLibur->Keterangan = $data->Keterangan;
 
// update the product
if($hariLibur->update()){
    echo '{';
        echo '"message": "Bidang was updated"';
    echo '}';
}
 
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update product"';
    echo '}';
}
?>