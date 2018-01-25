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
include_once '../../api/objects/HariLibur.php';
include_once '../../api/objects/StatusAbsen.php';

date_default_timezone_set('Asia/Seoul');
session_start();

$database = new Database();
$db = $database->getConnection();

$harilibur = new HariLibur($db);

$absen = new Absen($db);
$pegawai = new Pegawai($db);
$harilibur = new HariLibur($db);
$statusabsen = new StatusAbsen($db);
$pegawai->Nip=$_SESSION['NipPegawai'];
$stmtPegawai = $pegawai->readOne();

$d= strtotime("15 April 2014 09:00:00");
$jamdatang = date('H:i:s', $d);

$e= strtotime("15 April 2014 14:00:00");
$jampulang = date('H:i:s', $e);

$DariTanggal = $_SESSION['DariTanggal'];
$SampaiTanggal = $_SESSION['SampaiTanggal'];
$arr_pegawai=array();
$arr_pegawai["records"]=array();
while ($rowpegawai = $stmtPegawai->fetch(PDO::FETCH_ASSOC)){
    extract($rowpegawai);
    $pegawai_item=array(
        "Nip" => $Nip,
        "Nama" => $Nama,
        "Alamat" => html_entity_decode($Alamat),
        "Kontak" => $Kontak,
        "Sex" => $Sex,
        "IdBidang" => $IdBidang,
        "Jabatan" => $Jabatan,
        "Pangkat" => $Pangkat,
        "Tanggal"=>array(),
        "Alpa"=> null,
        "Hadir"=>null,
        "JumlahHari"=>null,
        "Ratio"=>null
    );

    $JumlahHari=$harilibur->IntervalDays($DariTanggal,$SampaiTanggal)+1;
    $Alpa=0;
    $Hadir=0;
    $Izin=0;
    $Cuti=0;
    $Sakit=0;
    $DL=0;
    $absen->Nip=$Nip;
    $absen->TglAbsen=$DariTanggal;
    while (strtotime($DariTanggal) <= strtotime($SampaiTanggal)) {
        $stmtharilibut = $harilibur->readByDate($DariTanggal);
        $numabsen = $stmtharilibut->rowCount();
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
                   
                    $datajampulang = "15 April 2014 ".$JamPulang;

                    $dd= strtotime($datajampulang);
                    $DataJamPulang = date('H:i:s', $dd);

                    $datajamdatang = "15 April 2014 ".$JamDatang;
                            

                    $ee= strtotime($datajamdatang);
                    $DataJamDatang = date('H:i:s', $ee);

                    $statushasir="";
                    $Jamterlambat="";

                    if($DataJamDatang<=$jamdatang && $DataJamPulang>=$jampulang)
                        $statushasir="Hadir";
                    else
                    {
                        if($DataJamDatang>$jamdatang)
                        {
                        $jamdataAwal = strtotime($DariTanggal.$DataJamDatang);
                        $jamdataAkhir=strtotime($DariTanggal.$jamdatang);
                        $JamTerlambat=$jamdataAwal-$jamdataAkhir;
                        $jumlahjam= floor($JamTerlambat/3600);
                        $jumlahmenit=floor(($JamTerlambat-$jumlahjam*(60*60))/60);
                        $Jamterlambat = $jumlahjam." Jam ". $jumlahmenit . " Menit";
                        }
                        $statushasir="Tidak Tepat Waktu";
                    }
                                
                            
                    $item_tanggal=array(
                        "Tanggal"=>$DariTanggal,
                        "JamDatang"=>$JamDatang,
                        "JamPulang"=>$JamPulang,
                        "Keterangan"=>$statushasir,
                        "Keterlambatan"=>$Jamterlambat
                    );
                    array_push($pegawai_item["Tanggal"], $item_tanggal);
                }
                $Hadir+=1;
            }else
            {
                $stmtStatusabsen = $statusabsen->readByDate($DariTanggal,$Nip);
                $numStatusAbsen = $stmtStatusabsen->rowCount();
                if($numStatusAbsen==0)
                {
                    $item_alpa=array(
                        "Tanggal"=>$DariTanggal,
                        "Keterangan"=>"Alpha"
                    );
                    array_push($pegawai_item["Tanggal"], $item_alpa);
                    $Alpa+=1;
                }else
                {
                    while ($rowStatusabsen = $stmtStatusabsen->fetch(PDO::FETCH_ASSOC)){
                        extract($rowStatusabsen);
                        $item_statusnew=array(
                            "Tanggal"=>$DariTanggal,
                            "Keterangan"=>$Jenis
                        );
                        array_push($pegawai_item["Tanggal"], $item_statusnew);
                        if($Jenis=="Izin")
                        {
                            $Izin+=1;
                        }else if($Jenis=="Cuti")
                        {
                            $Cuti+=1;
                        }else if($Jenis=="Sakit")
                        {
                            $Sakit+=1;
                        }else if($Jenis=="DL")
                            $DL+=1;
                    }
                }

            }
            $JumlahHari-=1;
        }else
        {
            while ($rowharilibur = $stmtharilibut->fetch(PDO::FETCH_ASSOC)){
                extract($rowharilibur);
                $item_absen=array(
                    "Tanggal"=>$DariTanggal,
                    "Keterangan"=>$Keterangan
                );
                array_push($pegawai_item["Tanggal"],$item_absen);
            }
        }
        
        $DariTanggal = date ("Y-m-d", strtotime("+1 day", strtotime($DariTanggal)));
    }
    $Ratio=($Hadir/$JumlahHari)*100;
    $pegawai_item["Alpa"]=$Alpa;
    $pegawai_item["Izin"]=$Izin;
    $pegawai_item["Cuti"]=$Cuti;
    $pegawai_item["Sakit"]=$Sakit;
    $pegawai_item["DL"]=$DL;
    $pegawai_item["Hadir"]=$Hadir;
    $pegawai_item["JumlahHari"]=$JumlahHari+1;
    $pegawai_item["Ratio"]=$Ratio;
    array_push($arr_pegawai["records"], $pegawai_item);


}
echo json_encode($arr_pegawai);




?>