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
include_once '../../api/objects/HariLibur.php';
include_once '../../api/objects/StatusAbsen.php';
session_start();
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$pegawai = new Pegawai($db);

$bidang = new Bidang($db);

$absen = new Absen($db);

$statusabsen = new StatusAbsen($db);

$harilibur = new HariLibur($db);

$data =json_decode(file_get_contents("php://input"));

$a = new DateTime($data->DariTanggal);
$aa=str_replace('-', '/', $a->format('Y-m-d'));
$aaa = date('Y-m-d',strtotime($aa . "+1 days"));
$b = new DateTime($data->SampaiTanggal);
$bb=str_replace('-', '/', $b->format('Y-m-d'));
$bbb = date('Y-m-d',strtotime($bb . "+1 days"));

$date1 = $aaa;
$date2 = $bbb;

$absen->DariTanggal=$date1;
$absen->SampaiTanggal=$date2;

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

            $DariTanggal=$date1;
            $SampaiTanggal=$date2;
            $pegawai_item=array(
                "Nip" => $Nip,
                "Nama" => $Nama,
                "Alamat" =>$Alamat,
                "Kontak" => $Kontak,
                "Sex" => $Sex,
                "IdBidang" => $IdBidang,
                "NamaBidang"=>$NamaBidang,
                "Jabatan" => $Jabatan,
                "Absen"=>array(),
                "Alpa"=> null,
                "Izin"=> null,
                "Cuti"=> null,
                "Sakit"=> null,
                "DL"=> null,
                "Tanggal"=>array(),
                "Hadir"=>null,
                "JumlahHari"=>null,
                "Ratio"=>null,
                "StartDate"=>$DariTanggal,
                "endDate"=>$SampaiTanggal
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
                            
                            $item_tanggal=array(
                                "Tanggal"=>$DariTanggal,
                                "JamDatang"=>$JamDatang,
                                "JamPulang"=>$JamPulang,
                                "Keterangan"=>$Keterangan
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
            array_push($bidang_item["Pegawai"], $pegawai_item);
            $pegawai_item=null;
            /*

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
            */
        }
        array_push($DataAbsen,$bidang_item);
        $bidang_item=null;
        
        
        
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