<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../../api/config/database.php';
include_once '../../api/objects/Pegawai.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$pegawai = new Pegawai($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$pegawai->Nip = $data->Nip;
 
// set product property values
$pegawai->Nip = $data->Nip;
$pegawai->Nama = $data->Nama;
$pegawai->Alamat = $data->Alamat;
$pegawai->Kontak = $data->Kontak;
$pegawai->Sex = $data->Sex;
$pegawai->IdBidang = $data->IdBidang;
$pegawai->Jabatan = $data->Jabatan;
$pegawai->Pangkat = $data->Pangkat;
$pegawai->Email = $data->Email;
 
// update the product
if($pegawai->update()){
    echo '{';
        echo '"message": "Product was updated"';
    echo '}';
}
 
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update product"';
    echo '}';
}
?>