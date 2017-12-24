<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

date_default_timezone_set('Asia/Seoul');
// include database and object files
include_once '../../api/config/database.php';
include_once '../../api/objects/StatusAbsen.php';
 
date_default_timezone_set('Asia/Seoul');
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$statusabsen = new StatusAbsen($db);
 
// query products
$stmt = $statusabsen->read();   
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $status_arr=array();
    $status_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $status_item=array(
            "Id" => $Id,
            "Nip" => $Nip,
            "Jenis" => $Jenis,
            "Pengajuan" => $TglPengajuan,
            "TglMulai"=>$TglMulai,
            "TglSelesai"=>$TglSelesai,
            "Keterangan"=>$Keterangan
        );
 
        array_push($status_arr["records"], $status_item);
    }
 
    echo json_encode($status_arr);
}
 
else{
    echo json_encode(
        array("message" => "No Status Absen found")
    );
}
?>