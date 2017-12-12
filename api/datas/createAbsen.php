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
include_once '../../api/objects/Absen.php';
date_default_timezone_set('Asia/Seoul');

$database = new Database();
$db = $database->getConnection();

//instance Absen
$absen = new Absen($db);


// get posted data
$data =json_decode(file_get_contents("php://input"));
 

// set product property values
$absen->Email = $data->Email;
$absen->Password = md5($data->Password);
$absen->MacAddress=$data->MacAddress;
$absen->TglAbsen= date('Y-m-d');
$absen->JamDatang=date('H:i:s');
$absen->JamPulang=date('H:i:s');
if($data->Keterangan=="Kosong")
    $absen->Keterangan="Hadir";
else
    $absen->Keterangan=$data->Keterangan;


$cek=$absen->readOneMac();
$num=$cek->rowCount();
if($num>0)
{
    while ($row = $cek->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
 
    }
    $absen->Nip=$Nip;

    $cekAbsen=$absen->read();
    $numabsen=$cekAbsen->rowCount();
    while ($rowAbsen = $cekAbsen->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($rowAbsen); 
 
    }

    if($absen->JamDatang<="12:00:00" && $absen->JamDatang>="06:00:00" && $absen->TglAbsen==date('Y-m-d'))
    {
        if($numabsen==0)
        {
            if($absen->create())
            {
                echo '{';
                    echo '"message": "'.$Nama.' Sukses Absen Datang jam '.$absen->JamDatang.'"';
                echo '}';
            }
        }else
        {
            echo '{';
                echo '"message": "'.$Nama.' Anda Sudah Absen Datang jam '.$absen->JamDatang.'"';
            echo '}';
        }
    }elseif($JamPulang=="00:00:00" && $absen->JamPulang>"12:00:00")
    {
        if($absen->update())
        {
            echo '{';
                echo '"message": "'.$Nama.' Anda Sukses Absen Pulang Jam '.$absen->JamPulang.'"';
            echo '}';
        }
        else
        {
            echo '{';
                echo '"message": "'.$Nama.' Anda Sudah Melakukan Absen Pulang sebelumnya Jam '.$num.'"';
            echo '}';
        }
    }
}else
{
    echo '{';
        echo '"message":"Perangkat Yang Anda Gunakan Tidak Terdaftar"';
    echo '}';
}
?>