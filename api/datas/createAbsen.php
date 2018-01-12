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
date_default_timezone_set('Asia/Jayapura');

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
$d= strtotime("15 April 2014 09:00:00");
$jam = date('H:i:s', $d);
if($data->Keterangan=="Kosong")
{
    if($absen->JamDatang<=$jam)
    {
        $absen->Keterangan="Hadir";
    }else
    $absen->Keterangan="Terlambat";
    
}
    
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
        $absen->Nip=$Nip; 
 
    }
    //$absen->Nip=$Nip;

    $cekAbsen=$absen->readOne();
    $numabsen=$cekAbsen->rowCount();
    while ($rowAbsen = $cekAbsen->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($rowAbsen); 
        $absen->JamAbsen=$JamDatang;
        $absen->JamAbsenPulang=$JamPulang;
 
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
                echo '"message": "'.$Nama.' Anda Sudah Absen Datang Sebelumnya jam '.$absen->JamAbsen.'"';
            echo '}';
        }
    }elseif($absen->JamDatang>="12:00:00")
    {
        if($numabsen>0)
        {
            if($JamPulang=="00:00:00")
            {
                if($absen->update())
                {
                    echo '{';
                        echo '"message": "'.$Nama.' Anda Sukses Absen Pulang Jam '.$absen->JamPulang.'"';
                    echo '}';
                }
            }
            else
            {
                echo '{';
                    echo '"message": "'.$Nama.' Anda Sudah Melakukan Absen Pulang sebelumnya Jam '.$absen->JamAbsenPulang.'"';
                echo '}';
            }
        }else
        {
            echo '{';
                echo '"message": "'.$Nama.' Anda Tidak Diperkenankan Absen Pulang karena anda tidak absen pagi"';
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