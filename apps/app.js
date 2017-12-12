angular.module("app", ["ngRoute", "Ctrl"])
    .config(function($routeProvider) {
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

        .when("/Prices", {
            templateUrl: "apps/Views/Prices.html",
            controller: "PricesController"
        })

        .when("/Collies", {
            templateUrl: "apps/Views/Collies.html",
            controller: "ColliesController"
        })

        .otherwise({ redirectTo: '/' });
    });