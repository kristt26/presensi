var app = angular.module("app", ["ngRoute", "Ctrl"]);
app.config(function($routeProvider) {  
    $routeProvider   
        .when("/Main", {
            templateUrl: "apps/Views/main.html",
            controller: "MainController"
        })

    .when("/Pegawai", {
        templateUrl: "apps/Views/pegawai.html",
        controller: "pegawaiController"
    })

    .when("/Bidang", {
        templateUrl: "apps/Views/Bidang.html",
        controller: "BidangController"
    })

    .when("/Logout", {
        templateUrl: "apps/Views/Bidang.html",
        controller: "LogoutController"
    })

    .when("/login", {
        templateUrl: "apps/Views/login.html",
        controller: "LoginController"
    })

    .when("/login", {
        templateUrl: "apps/Views/login.html",
        controller: "LoginController"
    })

    .when("/DaftarAbsen", {
        templateUrl: "apps/Views/daftarabsen.html",
        controller: "DaftarAbsenController"
    })

    .when("/ViewAbsen", {
        templateUrl: "apps/Views/ViewAbsen.html",
        controller: "ViewAbsenController"
    })

    .when("/HariLibur", {
        templateUrl: "apps/Views/HariLibur.html",
        controller: "HariLiburController"
    })

    .when("/Perangkat", {
        templateUrl: "apps/Views/Perangkat.html",
        controller: "PerangkatController"
    })

    .when("/StatusAbsen", {
        templateUrl: "apps/Views/StatusAbsen.html",
        controller: "StatusAbsenController"
    })

    .when("/Collies", {
        templateUrl: "apps/Views/Collies.html",
        controller: "ColliesController"
    })

    .otherwise({ redirectTo: '/Main' })

})


.factory("SessionService", function($http, $rootScope) {
    var service = {};
    $rootScope.Session = {};
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


    return service;
})

;