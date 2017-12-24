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
include_once '../../api/objects/Pegawai.php';
include_once '../../api/objects/Absen.php';

date_default_timezone_set('Asia/Seoul');
session_start();

$database = new Database();
$db = $database->getConnection();

$harilibur = new HariLibur($db);

$absen = new Absen($db);
$pegawai = new Pegawai($db);
$stmtPegawai = $pegawai->read();

$DariTanggal = $_SESSION['DariTanggal'];
$SampaiTanggal = $_SESSION['SampaiTanggal'];






$JumlahHari;
$arr_item=array();
$arr_HariKerja=array();
$arr_HariKerja["records"]=array();
$arr_item["records"]=array();
$arr_item["JumHari"]=array();
while ($rowpegawai = $stmtPegawai->fetch(PDO::FETCH_ASSOC)){
    extract($rowpegawai);
    $item_Pegawai=array(
        "Nip" => $Nip,
        "Nama" => $Nama,
        "Alamat" => html_entity_decode($Alamat),
        "Kontak" => $Kontak,
        "Sex" => $Sex,
        "IdBidang" => $IdBidang,
        "NamaBidang"=>$NamaBidang,
        "Jabatan" => $Jabatan,
        "Pangkat" => $Pangkat,
        "Absen"=>array(),
        "Alpa"=> null,
        "Hadir"=>null,
        "JumlahHari"=>null,
        "Ratio"=>null
    );
    $DariTanggal=$_SESSION['DariTanggal'];
    $JumlahHari=$harilibur->IntervalDays($DariTanggal,$SampaiTanggal)+1;
    $Alpa=0;
    $Hadir=0;
    while (strtotime($DariTanggal) <= strtotime($SampaiTanggal)) {
        $stmt = $harilibur->readByDate($DariTanggal);
        $numabsen = $stmt->rowCount();
        if($numabsen==0)
        {
            $absen->Nip=$Nip;
            $absen->TglAbsen=$DariTanggal;
            $stmtabsen = $absen->readOne();
            $numhadir = $stmtabsen->rowCount();
            if($numhadir==1)
            {
                while ($rowabsen = $stmtabsen->fetch(PDO::FETCH_ASSOC)){
                    extract($rowabsen);
                    $item_absen=array(
                        "IdAbsen"=>$IdAbsen,
                        "TglAbsen"=>$TglAbsen,
                        "JamDatang"=>$JamDatang,
                        "JamPulang"=>$JamPulang,
                        "Keterangan"=>$Keterangan
                    );
                    array_push($item_Pegawai["Absen"], $item_absen);
                }
                $Hadir+=1;
            }else
            {
                $Alpa+=1;
            }
            $JumlahHari-=1;
        }else
        {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $item_absen=array(
                    "Tanggal"=>$DariTanggal,
                    "Status"=>$Keterangan
                );
                array_push($arr_HariKerja["records"],$item_absen);
            }
        }
        
        $DariTanggal = date ("Y-m-d", strtotime("+1 day", strtotime($DariTanggal)));
    }
    $Ratio=($Hadir/$JumlahHari)*100;
    $item_Pegawai["Alpa"]=$Alpa;
    $item_Pegawai["Hadir"]=$Hadir;
    $item_Pegawai["JumlahHari"]=$JumlahHari+1;
    $item_Pegawai["Ratio"]=$Ratio;
    array_push($arr_item["records"],$item_Pegawai);
}

/*echo '{';
    echo '"message": "'.$JumlahHari.'"';
echo '}';*/

echo json_encode($arr_item);
?>