<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


date_default_timezone_set('Asia/Seoul');
 
// include database and object files
include_once '../../api/config/database.php';
include_once '../../api/objects/Pegawai.php';
include_once '../../api/objects/Bidang.php';
include_once '../../api/objects/Absen.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$pegawai = new Pegawai($db);

$bidang = new Bidang($db);

$absen = new Absen($db);

$data =json_decode(file_get_contents("php://input"));

$absen->DariTanggal=$data->DariTanggal;
$absen->SampaiTanggal=$data->SampaiTanggal;

$stmtBidang= $bidang->read();
$numBidang=$stmtBidang->rowCount();
$DataAbsen=array();
if($numBidang>0)
{
    $pegawai_arr=array();
    $bidang_arr;
    $absen_arr=array();
    //$bidang_arr["Bidang"]=array();
    
    //$bidang_arr["records"]=array();

    while ($rowBidang = $stmtBidang->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($rowBidang);
        

        $bidang_item=array(
            "IdBidang" => $IdBidang,
            "NamaBidang" => $NamaBidang,
            "KepalaBagian" => $KepalaBagian,
            "Pegawai"=>array()
        );

        $pegawai->IdBidang=$IdBidang;
        $stmtPegawai=$pegawai->readByBidang();
        while($rowPegawai=$stmtPegawai->fetch(PDO::FETCH_ASSOC))
        {
            extract($rowPegawai);
            $pegawai_item=array(
                "Nip" => $Nip,
                "Nama" => $Nama,
                "Alamat" =>$Alamat,
                "Kontak" => $Kontak,
                "Sex" => $Sex,
                "IdBidang" => $IdBidang,
                "NamaBidang"=>$NamaBidang,
                "Jabatan" => $Jabatan,
                "Absen"=>array()
            );

            $absen->Nip=$Nip;
            $stmtAbsen=$absen->read();
            while($rowAbsen=$stmtAbsen->fetch(PDO::FETCH_ASSOC))
            {
                extract($rowAbsen);
                $absen_item=array(
                    "IdAbsen"=>$IdAbsen,
                    "Nip"=>$Nip,
                    "TglAbsen"=>$TglAbsen,
                    "JamDatang"=>$JamDatang,
                    "JamPulang"=>$JamPulang,
                    "Keterangan"=>$Keterangan
                );
                array_push($pegawai_item["Absen"], $absen_item);
            }
            array_push($bidang_item["Pegawai"], $pegawai_item);
        }
        array_push($DataAbsen,$bidang_item);
        
        
        
    }
    
    echo json_encode($DataAbsen);

}


 
// query products

 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>