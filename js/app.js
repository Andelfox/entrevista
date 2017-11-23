var myApp = angular.module('myApp', ['ngRoute', 'ngTagsInput']);

myApp.config(function ($routeProvider) {
    $routeProvider
            .when('/', {
                templateUrl: 'partials/home.html',
                controller: 'controllerEntrevista'
            })

});



//------------------------------------------------------------->
myApp.controller('controllerEntrevista', function ($scope, $http) {
    $scope.nombre1 = "Pablo";
    $scope.nombre2 = "Emilio";
    $scope.apellido1 = "Escobar";
    $scope.apellido2 = "Gaviria";
    $scope.etiquetas = [];
    $scope.buscar = function () {

        $scope.cadena = $scope.nombre1 + " " + $scope.nombre2 + " " + $scope.apellido1 + " " + $scope.apellido2;

        $.each($scope.etiquetas, function (i, obj) {
            $scope.cadena += " " + obj.text;
        });
        $("#div_carga").show();
        $http({
            method: "GET",
            url: 'https://www.googleapis.com/customsearch/v1?key=AIzaSyBSb_-AYfxAbD_VvMiDQa7Sj8vGIHEW-68&cx=002430856775248971682:z9pccpc5xje&q=' + $scope.cadena
        }).then(function mySuccess(response) {
            window.console.info(response.data);
            var data = response.data;

            if (data.items != undefined && data.items.length > 3) {

                $scope.names = data.items;
                $scope.generarExcel(data);

            } else {
                alert("Sin alerta, no generara excel");

            }
            $("#div_carga").hide();
        }, function myError(response) {
            $("#div_carga").hide();
        });



    }
    $scope.generarExcel = function (data) {
        $http({
            method: "POST",
            url: 'ajax/ajax_excel.php',
            dataType: "json",
            data: {datos: data},
            headers: {
                'Content-type': 'application/json'
            }
        }).then(function mySuccess(response) {
            window.open(response.data, '_blank');

        }, function myError(response) {
//        $scope.myWelcome = response.statusText;
        });
    };

});

//-------------------Fin

