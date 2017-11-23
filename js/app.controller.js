
//------------------------------------------------------------->
myApp.controller('controllerEntrevista', function ($scope, $http, ServiceTest,$rootScope) {
    $scope.nombre1 = "Pablo";
    $scope.nombre2 = "Emilio";
    $scope.apellido1 = "Escobar";
    $scope.apellido2 = "Gaviria";
    $scope.etiquetas = [];
    
    $scope.buscar = function () {
        $scope.cadena = $scope.nombre1 + " " + $scope.nombre2 + " " + $scope.apellido1 + " " + $scope.apellido2;
        angular.forEach($scope.etiquetas, function (obj, i) {
            $scope.cadena += " " + obj.text;
        });
        $rootScope.showLoading=true;
        ServiceTest.searchGoogle($scope.cadena).then(
            function(resolve){
                var data=resolve;
                if (data.items != undefined && data.items.length > 3) {       
                    $scope.names = data.items;
                    $scope.generarExcel(data);
                } else {
                alert("Sin alerta, no generara excel");
                }
                $rootScope.showLoading=false;
            },
            function(error){
                console.log(error);
                $rootScope.showLoading=false;
            });
    }
    $scope.generarExcel = function (data) {
        ServiceTest.generarExcel(data).then(
            function(response){
                window.open(response, '_blank');
            },
            function(error){
                console.log(error);
            });
    }
});

//-------------------Fin

