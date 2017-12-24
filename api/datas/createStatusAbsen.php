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
include_once '../../api/objects/StatusAbsen.php';
 
$database = new Database();
$db = $database->getConnection();
 
$statusabsen = new StatusAbsen($db);
 
// get posted data
$data =json_decode(file_get_contents("php://input"));
 
$a = new DateTime($data->Pengajuan);
$aa=str_replace('-', '/', $a->format('Y-m-d'));
$aaa = date('Y-m-d',strtotime($aa . "+1 days"));
$b = new DateTime($data->TglMulai);
$bb=str_replace('-', '/', $b->format('Y-m-d'));
$bbb = date('Y-m-d',strtotime($bb . "+1 days"));
$c = new DateTime($data->TglSelesai);
$cc=str_replace('-', '/', $c->format('Y-m-d'));
$ccc = date('Y-m-d',strtotime($cc . "+1 days"));
// set product property values
$statusabsen->Nip = $data->Nip;
$statusabsen->Jenis = $data->Jenis;
$statusabsen->TglPengajuan = $aaa;
$statusabsen->TglMulai = $bbb;
$statusabsen->TglSelesai=$ccc;
$statusabsen->Keterangan=$data->Keterangan;
 
// create the product
if($statusabsen->create()){
    echo '{';
        echo '"message": '.$statusabsen->Id.'';
    echo '}';
}
 
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create StatusAbsen."';
    echo '}';
}


?>