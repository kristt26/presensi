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
include_once '../../api/objects/pegawai.php';
 
$database = new Database();
$db = $database->getConnection();
 
$pegawai = new Pegawai($db);
 
// get posted data
$data =json_decode(file_get_contents("php://input"));
 

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
$pegawai->Password = md5("12345678");
 
// create the product
if($pegawai->create()){
    echo '{';
        echo '"message": "Product was created"';
    echo '}';
}
 
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create product."';
    echo '}';
}


?>