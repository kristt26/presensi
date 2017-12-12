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
include_once '../../api/objects/Perangkat.php';
 
$database = new Database();
$db = $database->getConnection();
 
$perangkat = new Perangkat($db);
 
// get posted data
$data =json_decode(file_get_contents("php://input"));
 

// set product property values
$perangkat->Nip = $data->Nip;
$perangkat->MacAddress = $data->MacAddress;

$cekMac="SELECT * from perangkat where MacAddress='$perangkat->MacAddress'";
$stmt=$db->prepare($cekMac);
$stmt->execute();
$num=$stmt->rowCount();
// create the product
if($num==0)
{
    if($perangkat->create()){
        echo '{';
            echo '"message": "Data Tersimpan", "IdPerangkat": "'.$perangkat->IdPerangkat.'"';
        echo '}';
    }
     
    // if unable to create the product, tell the user
    else{
        echo '{';
            echo '"message": "Unable to create product."';
        echo '}';
    }
}
else{
    echo '{';
        echo '"message": "Perangkat yang diinput sudah ada"';
    echo '}';
}



?>