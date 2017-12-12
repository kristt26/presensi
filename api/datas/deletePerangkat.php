<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 
// include database and object file
include_once '../../api/config/database.php';
include_once '../../api/objects/Perangkat.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$perangkat = new Perangkat($db);
 
// get product id
$data = json_decode(file_get_contents("php://input"));
 
// set product id to be deleted
$perangkat->IdPerangkat = $data->IdPerangkat;
 
// delete the product
if($perangkat->delete()){
    echo '{';
        echo '"message": "Perangkat Berhasil Di Hapus"';
    echo '}';
}
 
// if unable to delete the product
else{
    echo '{';
        echo '"message": "Data Perangkat Tidak Dapat dihapus"';
    echo '}';
}
?>