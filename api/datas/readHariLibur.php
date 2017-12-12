<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

date_default_timezone_set('Asia/Seoul');
// include database and object files
include_once '../../api/config/database.php';
include_once '../../api/objects/HariLibur.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$hariLibur = new HariLibur($db);
 
// query products
$stmt = $hariLibur->read();   
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $hariLibur_arr=array();
    $hariLibur_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $hariLibur_item=array(
            "IdHari" => $IdHari,
            "TglLibur" => $TglLibur,
            "Keterangan" => $Keterangan
        );
 
        array_push($hariLibur_arr["records"], $hariLibur_item);
    }
 
    echo json_encode($hariLibur_arr);
}
 
else{
    echo json_encode(
        array("message" => "No Hari Libur found")
    );
}
?>