<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

date_default_timezone_set('Asia/Seoul');


// get posted data
$data =json_decode(file_get_contents("php://input"));
$a = new DateTime($data->DariTanggal);
$aa=str_replace('-', '/', $a->format('Y-m-d'));
$aaa = date('Y-m-d',strtotime($aa . "+1 days"));
$b = new DateTime($data->SampaiTanggal);
$bb=str_replace('-', '/', $b->format('Y-m-d'));
$bbb = date('Y-m-d',strtotime($bb . "+1 days"));
session_start();
$_SESSION['DariTanggal']= $aaa;
$_SESSION['SampaiTanggal']=$bbb;
$_SESSION['message']=true;

echo json_encode($_SESSION);
?>