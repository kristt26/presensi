<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../../api/config/database.php';

// instantiate product object
include_once '../../api/objects/HariLibur.php';

date_default_timezone_set('Asia/Seoul');
session_start();

$database = new Database();
$db = $database->getConnection();

$harilibur = new HariLibur($db);


//$a = new DateTime($_SESSION['DariTanggal']);
//$b = new DateTime($_SESSION['SampaiTanggal']);
$DariTanggal = $_SESSION['DariTanggal'];
$SampaiTanggal = $_SESSION['SampaiTanggal'];
$testing=array(
    "dari"=>$_SESSION['DariTanggal'],
    "sampai"=>$_SESSION['SampaiTanggal']
);
$stmt = $harilibur->read();
if($DariTanggal>$SampaiTanggal)
{
    echo '{';
        echo '"message": "Lebih Kecil"';
    echo '}';
}else{
    echo '{';
        echo '"message": "Lebih Besar"';
    echo '}';
}
//echo json_encode($arr_item);
?>