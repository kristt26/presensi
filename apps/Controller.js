angular.module("Ctrl", [])

.controller("MainController", function($scope, $http, SessionService) {
    $scope.Init = function() {
        //Auth
        var Urlauth = "api/datas/auth.php";
        $http({
                method: "get",
                url: Urlauth,
            })
            .then(function(response) {
                if (response.data.Session == false) {
                    window.location.href = 'login.html';
                } else
                    $rootScope.Session = response.data.Session;
            }, function(error) {
                alert(error.message);
            })
    }
})


.controller("LogoutController", function($scope, $http) {
    var Urlauth = "api/datas/logout.php";
    $http({
            method: "get",
            url: Urlauth,
        })
        .then(function(response) {
            if (response.data.message == true) {
                window.location.href = 'login.html';
            }
        }, function(error) {
            alert(error.message);
        })
})

.controller("pegawaiController", function($scope, $http, $rootScope, SessionService) {
    //$rootScope.Session = {};
    $scope.DatasPegawai = [];
    $scope.DataInputPegawai = {};
    $scope.DatasBidang = [];
    $scope.SelectedItemBidang = {};
    $scope.SelectedItemPegawai = {};
    $scope.Pangkat = [
        { 'gol': 'I/a' },
        { 'gol': 'I/b' },
        { 'gol': 'I/c' },
        { 'gol': 'I/d' },
        { 'gol': 'II/a' },
        { 'gol': 'II/b' },
        { 'gol': 'II/c' },
        { 'gol': 'II/d' },
        { 'gol': 'III/a' },
        { 'gol': 'III/b' },
        { 'gol': 'III/c' },
        { 'gol': 'III/d' },
        { 'gol': 'IV/a' },
        { 'gol': 'IV/b' },
        { 'gol': 'IV/c' },
        { 'gol': 'IV/d' },
        { 'gol': 'IV/e' }
    ];
    $scope.SelectedPangkat = {};
    $scope.Init = function() {
        //Auth
        var Urlauth = "api/datas/auth.php";
        $http({
                method: "get",
                url: Urlauth,
            })
            .then(function(response) {
                if (response.data.Session == false) {
                    window.location.href = 'login.html';
                } else
                    $rootScope.Session = response.data.Session;
            }, function(error) {
                alert(error.message);
            })


        //Get Bidang
        var UrlBidang = "api/datas/readBidang.php";
        $http({
                method: "get",
                url: UrlBidang
            })
            .then(function(response) {
                $scope.DatasBidang = response.data.records;
            }, function(error) {
                alert(error.message);
            })


        //Get Data Pegawai
        var UrlPegawai = "api/datas/readPegawai.php";
        $http({
                method: "get",
                url: UrlPegawai
            })
            .then(function(response) {
                $scope.DatasPegawai = response.data.records;
            }, function(error) {
                alert(error.message);
            })

    }

    //Proses Insert Data Pegawai
    $scope.InsertPegawai = function() {
        $scope.DataInputPegawai.IdBidang = $scope.SelectedItemBidang.IdBidang;
        $scope.DataInputPegawai.NamaBidang = $scope.SelectedItemBidang.NamaBidang;
        $scope.DataInputPegawai.Pangkat = $scope.SelectedPangkat.gol;
        var Data = $scope.DataInputPegawai;
        var InsertDataPegawai = "api/datas/createPegawai.php";

        $http({
                method: "post",
                url: InsertDataPegawai,
                data: Data
            })
            .then(function(response) {
                if (response.data.message == "Product was created") {
                    $scope.DatasPegawai.push(angular.copy(Data));
                } else
                    alert("Data Gagal disimpan");
            }, function(error) {
                alert(error.message);
            })
            //$scope.DataInputPegawai = {};
    }

    //Selected Item City
    $scope.Selected = function(item) {
        angular.forEach($scope.DatasBidang, function(value, key) {
            if (value.IdBidang == item.IdBidang) {
                $scope.SelectedItemBidang = value;
            }
        });
        $scope.SelectedItemPegawai = item;
        $scope.SelectedPangkat.gol = $scope.SelectedItemPegawai.Pangkat;
    }

    //Update Data City
    $scope.UpdateDataPegawai = function() {
        $scope.SelectedItemPegawai.IdBidang = $scope.SelectedItemBidang.IdBidang;
        $scope.SelectedItemPegawai.NamaBidang = $scope.SelectedItemBidang.NamaBidang;
        var Data = $scope.SelectedItemPegawai;
        var UrlUpdatePegawai = "api/datas/updatePegawai.php";
        $http({
                method: "post",
                url: UrlUpdatePegawai,
                data: Data
            })
            .then(function(response) {
                if (response.data.message == "Product was updated") {
                    angular.forEach($scope.DatasPegawai, function(value, key) {
                        if (value.Nip == Data.Nip) {
                            value.Nama = Data.Nama;
                            value.Alamat = Data.Alamat;
                            value.Kontak = Data.Kontak;
                            value.Sex = Data.Sex;
                            value.IdBidang = Data.IdBidang;
                            value.NamaBidang = Data.NamaBidang;
                            value.Jabatan = Data.Jabatan;
                        }
                    })
                } else
                    alert(response.data.message);
            }, function(error) {
                alert(error.message);
            })
    }

    //Delete Pegawai
    $scope.Delete = function(item) {
        $scope.SelectedItemPegawai = item;
        var Data = $scope.SelectedItemPegawai;
        var UrlDeletePegawai = "api/datas/deletePegawai.php";
        $http({
                method: "post",
                url: UrlDeletePegawai,
                data: Data
            })
            .then(function(response) {
                if (response.data.message == "Product was deleted") {
                    $scope.DatasPegawai.splice(Data, 1);
                    alert(response.data.message);
                } else
                    alert("Data Tidak Terhapus");
            }, function(error) {
                alert(error.message);
            })
    }


})

.controller("BidangController", function($scope, $http, $rootScope, SessionService) {
    $scope.DatasBidang = [];
    //$rootScope.Session = {};
    $scope.DataInputBidang = {};
    $scope.DataSelected = {};
    $scope.InputUser = {};

    $scope.Init = function() {
        //Auth
        var Urlauth = "api/datas/auth.php";
        $http({
                method: "get",
                url: Urlauth,
            })
            .then(function(response) {
                if (response.data.Session == false) {
                    window.location.href = 'login.html';
                } else
                    $rootScope.Session = response.data.Session;
            }, function(error) {
                alert(error.message);
            })



        var UrlBidang = "api/datas/readBidang.php";
        $http({
                method: "get",
                url: UrlBidang
            })
            .then(function(response) {
                $scope.DatasBidang = response.data.records;
            }, function(error) {
                alert(error.message);
            })
    }

    //Insert Data Bidang
    $scope.InsertBidang = function() {
        var Data = $scope.DataInputBidang;
        var UrlInsertBidang = "api/datas/createBidang.php";
        $http({
                method: "post",
                url: UrlInsertBidang,
                data: Data
            })
            .then(function(response) {
                if (response.data.message != "0") {
                    Data.Id = response.data;
                    $scope.DatasPegawai.push(angular.copy(Data));
                } else
                    alert("Data Gagal disimpan");
            }, function(error) {
                alert(error.message);
            })

    }


    $scope.Selected = function(item) {
        $scope.DataSelected = item;
    }

    //Funsi Update Bidang
    $scope.UpdateDataBidang = function() {
        var Data = $scope.DataSelected;
        var UrlUpdateBidang = "api/datas/updateBidang.php";
        $http({
                method: "post",
                url: UrlUpdateBidang,
                data: Data
            })
            .then(function(response) {
                if (response.data.message == "Bidang was updated") {
                    angular.forEach($scope.DatasBidang, function(value, key) {
                        if (value.IdBidang == Data.IdBidang) {
                            value.NamaBidang = Data.NamaBidang;
                            value.KepalaBagian = Data.KepalaBagian;
                            alert(response.data.message);
                        }
                    })
                } else
                    alert(response.data.message);
            }, function(error) {
                alert(error.message);
            })
    }

})

.controller("PerangkatController", function($scope, $http, $rootScope, SessionService) {
    $scope.DatasPerangkat = [];
    $rootScope.Session = {};
    $scope.DatasPegawai = [];
    $scope.DataInputPerangkat = {};
    $scope.SelectedItemPegawai = {};
    $scope.DataSelected = {};

    $scope.Init = function() {
        //Auth
        var Urlauth = "api/datas/auth.php";
        $http({
                method: "get",
                url: Urlauth,
            })
            .then(function(response) {
                if (response.data.Session == false) {
                    window.location.href = 'login.html';
                } else
                    $rootScope.Session = response.data.Session;
            }, function(error) {
                alert(error.message);
            })

        var UrlPerangkat = "api/datas/readPerangkat.php";
        $http({
                method: "get",
                url: UrlPerangkat
            })
            .then(function(response) {
                $scope.DatasPerangkat = response.data.records;
            }, function(error) {
                alert(error.message);
            })

        //Get Data Pegawai
        var UrlPegawai = "api/datas/readPegawai.php";
        $http({
                method: "get",
                url: UrlPegawai
            })
            .then(function(response) {
                $scope.DatasPegawai = response.data.records;
            }, function(error) {
                alert(error.message);
            })
    }


    //Insert Data Perangkat
    $scope.InsertPerangkat = function() {
        $scope.DataInputPerangkat.Nip = $scope.SelectedItemPegawai.Nip;
        $scope.DataInputPerangkat.Nama = $scope.SelectedItemPegawai.Nama;
        var Data = $scope.DataInputPerangkat;
        var UrlInsertPerangkat = "api/datas/createPerangkat.php";
        $http({
                method: "post",
                url: UrlInsertPerangkat,
                data: Data
            })
            .then(function(response) {
                if (response.data.message == "Data Tersimpan") {
                    Data.IdPerangkat = response.data.IdPerangkat;
                    $scope.DatasPerangkat.push(angular.copy(Data));
                    alert(response.data.message);
                    $scope.DataInputPerangkat = {};
                    $scope.SelectedItemPegawai = {};
                } else
                    alert("Data Gagal disimpan");
            }, function(error) {
                alert(error.message);
            })
    }


    $scope.Selected = function(item) {
        $scope.DataSelected = item;
    }

    //Funsi Update Bidang
    $scope.UpdateDataPerangkat = function() {
        var Data = $scope.DataSelected;
        var UrlUpdatePerangkat = "api/datas/updatePerangkat.php";
        $http({
                method: "post",
                url: UrlUpdatePerangkat,
                data: Data
            })
            .then(function(response) {
                if (response.data.message == "Perangkat was updated") {
                    angular.forEach($scope.DatasPerangkat, function(value, key) {
                        if (value.IdPerangkat == Data.IdPerangkat) {
                            value.MacAddress = Data.MacAddress;
                            alert(response.data.message);
                        }
                    })
                } else
                    alert(response.data.message);
            }, function(error) {
                alert(error.message);
            })
    }

    //Delete Perangkat
    $scope.Delete = function(item) {
        $scope.DataSelected = item;
        var Data = $scope.DataSelected;
        var UrlDeletePerangkat = "api/datas/deletePerangkat.php";
        $http({
                method: "post",
                url: UrlDeletePerangkat,
                data: Data
            })
            .then(function(response) {
                if (response.data.message == "Perangkat Berhasil Di Hapus") {
                    $scope.DatasPerangkat.splice(Data, 1);
                    alert(response.data.message);
                } else
                    alert("Data Tidak Terhapus");
            }, function(error) {
                alert(error.message);
            })
    }

})


.controller("DaftarAbsenController", function($scope, $http, $rootScope, SessionService) {
    $scope.DataTanggal = {};
    $scope.DatasAbsenPegawai = [];
    //$rootScope.Session = {};
    $scope.Init = function() {
        //Auth
        var Urlauth = "api/datas/auth.php";
        $http({
                method: "get",
                url: Urlauth,
            })
            .then(function(response) {
                if (response.data.Session == false) {
                    window.location.href = 'login.html';
                } else
                    $rootScope.Session = response.data.Session;
            }, function(error) {
                alert(error.message);
            })

        var UrlPrices = "api/Prices.php?action=GetPrices";
        $http({
                method: "get",
                url: UrlPrices
            })
            .then(function(response) {
                $scope.DataPrices = response.data;
            }, function(error) {
                alert(err.Massage);
            })
    }

    $scope.Cari = function() {
        var Data = $scope.DataTanggal;
        var UrlAbsen = "api/datas/readAbsenPegawai.php";
        $http({
                method: "post",
                url: UrlAbsen,
                data: Data
            })
            .then(function(response) {
                $scope.DatasAbsenPegawai = response.data.records[0];
            }, function(error) {
                alert(error.message);
            })

    }
})

.controller("ViewAbsenController", function($scope, $http, $rootScope, SessionService) {
    //$rootScope.Session = {};
    $scope.DatasAbsen = [];
    $scope.DataTanggal = {};
    $scope.DataPegawai = {};

    $scope.Init = function() {
        //Auth
        var Urlauth = "api/datas/auth.php";
        $http({
                method: "get",
                url: Urlauth,
            })
            .then(function(response) {
                if (response.data.Session == false) {
                    window.location.href = 'login.html';
                } else
                    $rootScope.Session = response.data.Session;
            }, function(error) {
                alert(error.message);
            })

    }
    $scope.Cari = function() {
        var Data = $scope.DataTanggal;
        var UrlAbsen = "api/datas/readAbsen.php";
        $http({
                method: "post",
                url: UrlAbsen,
                data: Data
            })
            .then(function(response) {
                $scope.DatasAbsen = response.data;
            }, function(error) {
                alert(error.message);
            })
    }

    $scope.Cetak = function() {
        var Data = $scope.DataTanggal;
        var date = $scope.DataTanggal;

        //Convert Dtate  Tostring
        startDate = date.Year + " " + date.Month + " " + date.Day;



        //$scope.DataTanggal.DTanggal = $filter('date')($scope.DataTanggal.DariTanggal, "yyyy-MM-dd");
        var UrlAbsen = "api/datas/dataTanggal.php";
        $http({
                method: "post",
                url: UrlAbsen,
                data: Data
            })
            .then(function(response) {
                if (response.data.message == true)
                    window.open('apps/laporan/LaporanAbsen.html', '_blank')
            }, function(error) {
                alert(error.message);
            })
    }

    $scope.CetakPegawai = function(item) {
        $scope.DataPegawai = item;
        var Data = $scope.DataPegawai;
        var UrlDataPegawai = "api/datas/setTanggal.php";
        $http({
                method: "post",
                url: UrlDataPegawai,
                data: Data
            })
            .then(function(response) {
                if (response.data.message == true)
                    window.open('apps/laporan/LaporanPegawai.html', '_blank')
            }, function(error) {
                alert(error.message);
            })

    }

})

.controller("HariLiburController", function($scope, $http, $rootScope, SessionService) {
    $scope.DatasHariLibur = [];
    //$rootScope.Session = {};
    $scope.DataInputHariLibur = {};
    $scope.Init = function() {
        //Auth
        var Urlauth = "api/datas/auth.php";
        $http({
                method: "get",
                url: Urlauth,
            })
            .then(function(response) {
                if (response.data.Session == false) {
                    window.location.href = 'login.html';
                } else
                    $rootScope.Session = response.data.Session;
            }, function(error) {
                alert(error.message);
            })

        //Get Hari Libur
        var UrlAbsen = "api/datas/readHariLibur.php";
        $http({
                method: "get",
                url: UrlAbsen,
            })
            .then(function(response) {
                if (response.data.message != "No Hari Libur found")
                    $scope.DatasHariLibur = response.data.records;
                else
                    alert(response.data.message);
            }, function(error) {
                alert(error.message);
            })
    }

    //insert Hari Libur
    $scope.InsertHariLibur = function() {
        var Data = $scope.DataInputHariLibur;
        var UrlInsertHariLibur = "api/datas/createHariLibur.php";
        $http({
                method: "post",
                url: UrlInsertHariLibur,
                data: Data
            })
            .then(function(response) {
                if (response.data.message != "0") {
                    Data.IdHari = response.data.message;
                    $scope.DatasHariLibur.push(angular.copy(Data));
                } else
                    alert("Data Gagal disimpan");
            }, function(error) {
                alert(error.message);
            })
    }

    $scope.Selected = function(item) {
        $scope.DataSelected = item;
    }

    $scope.UpdateDataHariLibur = function() {
        var Data = $scope.DataSelected;
        var UrlUpdateHariLibur = "api/datas/updateHariLibur.php";
        $http({
                method: "post",
                url: UrlUpdateHariLibur,
                data: Data
            })
            .then(function(response) {
                if (response.data.message == "Bidang was updated") {
                    angular.forEach($scope.DatasBidang, function(value, key) {
                        if (value.IdBidang == Data.IdBidang) {
                            value.NamaBidang = Data.NamaBidang;
                            value.KepalaBagian = Data.KepalaBagian;
                            alert(response.data.message);
                        }
                    })
                } else
                    alert(response.data.message);
            }, function(error) {
                alert(error.message);
            })
    }



})

.controller("StatusAbsenController", function($scope, $http) {
    $scope.DatasStatusAbsen = [];
    $scope.DatasPegawai = [];
    $scope.DataJenis = [{ 'jenis': 'Izin' }, { 'jenis': 'Cuti' }, { 'jenis': 'Sakit' }, { 'jenis': 'DL' }];
    $scope.DataInput = {};
    $scope.SelectedItemPegawai = {};
    $scope.SelectedJenis = {};
    $scope.Init = function() {
        //Get Data Pegawai
        var UrlPegawai = "api/datas/readPegawai.php";
        $http({
                method: "get",
                url: UrlPegawai
            })
            .then(function(response) {
                $scope.DatasPegawai = response.data.records;
            }, function(error) {
                alert(error.message);
            })

        //Get Data Status
        var UrldataStatus = "api/datas/readStatusAbsen.php";
        $http({
                method: "get",
                url: UrldataStatus
            })
            .then(function(response) {
                $scope.DatasStatusAbsen = response.data.records;
            }, function(error) {
                alert(error.message);
            })

    }

    $scope.InsertStatusAbsen = function() {
        $scope.DataInput.Nip = $scope.SelectedItemPegawai.Nip;
        $scope.DataInput.Nama = $scope.SelectedItemPegawai.Nama;
        $scope.DataInput.Jenis = $scope.SelectedJenis.jenis;
        var Data = $scope.DataInput;
        var UrlStatus = "api/datas/createStatusAbsen.php";
        $http({
                method: "post",
                url: UrlStatus,
                data: Data
            })
            .then(function(response) {
                if (response.data.message > 1) {
                    Data.Id = response.data.message;
                    $scope.DatasStatusAbsen.push(Data);
                }
            }, function(error) {
                alert(error.message);
            })

        $scope.SelectedItemPegawai = {};
        $scope.SelectedJenis = {};
    }

});