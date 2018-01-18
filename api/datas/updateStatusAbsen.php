<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../../api/config/database.php';
include_once '../../api/objects/StatusAbsen.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$statusabsen = new StatusAbsen($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$statusabsen->Id = $data->Id;
$statusabsen->Jenis = $data->Jenis;
$statusabsen->Keterangan = $data->Keterangan;
$a = new DateTime($data->Pengajuan);
$aa=str_replace('-', '/', $a->format('Y-m-d'));
$aaa = date('Y-m-d',strtotime($aa . "+1 days"));
$b = new DateTime($data->TglMulai);
$bb=str_replace('-', '/', $b->format('Y-m-d'));
$bbb = date('Y-m-d',strtotime($bb . "+1 days"));
$c = new DateTime($data->TglSelesai);
$cc=str_replace('-', '/', $c->format('Y-m-d'));
$ccc = date('Y-m-d',strtotime($cc . "+1 days"));
$statusabsen->TglPengajuan=$aaa;
$statusabsen->TglMulai=$bbb;
$statusabsen->TglSelesai=$ccc;

// set product property values

 
// update the product
if($statusabsen->update()){
    echo '{';
        echo '"message": "Status Absen was updated"';
    echo '}';
}
 
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update product"';
    echo '}';
}
?>