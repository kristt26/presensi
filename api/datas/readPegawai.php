<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../../api/config/database.php';
include_once '../../api/objects/pegawai.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$pegawai = new Pegawai($db);
 
// query products
$stmt = $pegawai->read();   
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $products_arr=array();
    $products_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $product_item=array(
            "Nip" => $Nip,
            "Nama" => $Nama,
            "Alamat" => html_entity_decode($Alamat),
            "Kontak" => $Kontak,
            "Sex" => $Sex,
            "IdBidang" => $IdBidang,
            "NamaBidang"=>$NamaBidang,
            "Jabatan" => $Jabatan,
            "Pangkat" => $Pangkat
        );
 
        array_push($products_arr["records"], $product_item);
    }
    echo json_encode($products_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>