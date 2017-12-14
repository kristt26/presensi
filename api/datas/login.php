<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../../api/config/database.php';
include_once '../../api/objects/Login.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$login = new Login($db);

$data = json_decode(file_get_contents("php://input"));


// set product property values

$login->Email = $data->Email;
$login->Password = md5($data->Password);



// query products
$stmt = $login->LoginUser();
$num = $stmt->rowCount();
 
// check if more than 0 record found
try {
    if ($num > 0) {
        session_start();
    // products array
        $products_arr = array();
        $products_arr["records"] = array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
            extract($row);
            $_SESSION['Nip'] = $Nip;
            $_SESSION['Nama'] = $Nama;

            $product_item = array(
                "Nip" => $Nip,
                "Nama" => $Nama,
                "Alamat" => html_entity_decode($Alamat),
                "Kontak" => $Kontak,
                "Sex" => $Sex,
                "IdBidang" => $IdBidang,
                "NamaBidang" => $NamaBidang,
                "Jabatan" => $Jabatan,
                "Email" => $Email,
                "Session" => $_SESSION,
                "Message" => true
            );

            array_push($products_arr["records"], $product_item);
        }

        echo json_encode($products_arr);
    } else {
        throw new Exception('You Not Have Access');
    }
} catch (Exception $ex) {
    header("HTTP/1.1 500 Internal Server Error");
    echo '{"message": "Exception occurred: '.$ex->getMessage().'"}';
}


?>